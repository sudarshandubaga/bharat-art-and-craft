<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    /**
     * Cache path for cwebp executable
     *
     * @var string|null
     */
    protected static $cwebpBinary = null;

    /**
     * Cache path for dwebp executable
     *
     * @var string|null
     */
    protected static $dwebpBinary = null;

    /**
     * Cache path for magick executable
     *
     * @var string|null
     */
    protected static $magickBinary = null;

    /**
     * Process, resize, and convert an image to optimized WebP (or JPG).
     * Generates both main image and optional thumbnail.
     *
     * @param UploadedFile|string|null $source The uploaded file, base64 data string, or file path
     * @param string $targetDir Directory to save main image (e.g. public_path('images/products/'))
     * @param string $baseName Base filename without extension (e.g. product id or unique slug)
     * @param int $maxWidth Maximum width for main image
     * @param int $maxHeight Maximum height for main image
     * @param string|null $thumbDir Directory to save thumbnail (e.g. public_path('images/products/thumbnail/'))
     * @param int $thumbWidth Thumbnail width
     * @param int $thumbHeight Thumbnail height
     * @param int $quality WebP compression quality (default 85)
     * @return string|null The saved filename (e.g. "1.webp") or null on failure
     */
    public static function processAndSave(
        $source,
        string $targetDir,
        string $baseName,
        int $maxWidth = 1000,
        int $maxHeight = 1000,
        ?string $thumbDir = null,
        int $thumbWidth = 150,
        int $thumbHeight = 150,
        int $quality = 85
    ): ?string {
        if (empty($source)) {
            return null;
        }

        self::ensureDirectoryExists($targetDir);
        if ($thumbDir) {
            self::ensureDirectoryExists($thumbDir);
        }

        $tempFilesToCleanup = [];

        try {
            $realPath = null;

            // Handle base64 input string
            if (is_string($source) && preg_match('/^data:image\/(\w+);base64,/', $source)) {
                $base64Data = substr($source, strpos($source, ',') + 1);
                $decoded = base64_decode($base64Data);
                if ($decoded === false) {
                    throw new Exception('Invalid base64 image data.');
                }
                $tempPath = sys_get_temp_dir() . '/upload_' . uniqid() . '.tmp';
                file_put_contents($tempPath, $decoded);
                $tempFilesToCleanup[] = $tempPath;
                $realPath = $tempPath;
            } elseif ($source instanceof UploadedFile) {
                $realPath = $source->getRealPath();
            } elseif (is_string($source) && file_exists($source)) {
                $realPath = $source;
            } else {
                throw new Exception('Unrecognized image source.');
            }

            // If source is WebP and GD cannot read WebP directly, decode using dwebp or magick
            if (self::isWebpFile($realPath) && !function_exists('imagecreatefromwebp')) {
                $decodedPath = self::decodeWebpToPng($realPath);
                if ($decodedPath) {
                    $tempFilesToCleanup[] = $decodedPath;
                    $realPath = $decodedPath;
                }
            }

            // Load GD image resource
            $gdImage = self::createGdImageFromPath($realPath);
            if (!$gdImage) {
                throw new Exception('Failed to create GD image resource from: ' . $realPath);
            }

            $origWidth = imagesx($gdImage);
            $origHeight = imagesy($gdImage);

            // Clean up any previously existing files with matching base name (e.g., old .jpg, .png, .webp)
            self::cleanOldFiles($targetDir, $baseName);
            if ($thumbDir) {
                self::cleanOldFiles($thumbDir, $baseName);
            }

            $extension = self::supportsWebp() ? 'webp' : 'jpg';
            $finalFilename = $baseName . '.' . $extension;

            // 1. Process Main Image: resize with aspect ratio (no upscaling)
            $mainGd = self::resizeAspect($gdImage, $origWidth, $origHeight, $maxWidth, $maxHeight);
            $mainTargetPath = rtrim($targetDir, '/') . '/' . $finalFilename;
            self::saveGdImage($mainGd, $mainTargetPath, $extension, $quality, $tempFilesToCleanup);
            if ($mainGd !== $gdImage) {
                imagedestroy($mainGd);
            }

            // 2. Process Thumbnail: fit/center crop
            if ($thumbDir) {
                $thumbGd = self::cropFit($gdImage, $origWidth, $origHeight, $thumbWidth, $thumbHeight);
                $thumbTargetPath = rtrim($thumbDir, '/') . '/' . $finalFilename;
                self::saveGdImage($thumbGd, $thumbTargetPath, $extension, $quality, $tempFilesToCleanup);
                imagedestroy($thumbGd);
            }

            imagedestroy($gdImage);

            return $finalFilename;

        } catch (Exception $e) {
            Log::error('ImageOptimizer failed: ' . $e->getMessage(), [
                'baseName' => $baseName,
                'targetDir' => $targetDir,
            ]);
            return null;
        } finally {
            foreach ($tempFilesToCleanup as $tmp) {
                if (file_exists($tmp)) {
                    @unlink($tmp);
                }
            }
        }
    }

    /**
     * Create GD resource from file path supporting JPEG, PNG, GIF, BMP, WEBP
     */
    protected static function createGdImageFromPath(string $path)
    {
        $info = @getimagesize($path);
        if (!$info) {
            // Try imagecreatefromstring
            $data = @file_get_contents($path);
            if ($data !== false) {
                return @imagecreatefromstring($data);
            }
            return null;
        }

        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                return @imagecreatefromjpeg($path);
            case IMAGETYPE_PNG:
                return @imagecreatefrompng($path);
            case IMAGETYPE_GIF:
                return @imagecreatefromgif($path);
            case IMAGETYPE_BMP:
                return function_exists('imagecreatefrombmp') ? @imagecreatefrombmp($path) : null;
            case IMAGETYPE_WEBP:
                return function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null;
            default:
                $data = @file_get_contents($path);
                return $data !== false ? @imagecreatefromstring($data) : null;
        }
    }

    /**
     * Resize image maintaining aspect ratio without upscaling
     */
    protected static function resizeAspect($src, int $srcW, int $srcH, int $maxW, int $maxH)
    {
        if ($srcW <= $maxW && $srcH <= $maxH) {
            return $src;
        }

        $ratio = min($maxW / $srcW, $maxH / $srcH);
        $newW = (int)round($srcW * $ratio);
        $newH = (int)round($srcH * $ratio);

        $dst = imagecreatetruecolor($newW, $newH);
        // Preserve transparency for PNG/WebP
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
        imagefilledrectangle($dst, 0, 0, $newW, $newH, $transparent);

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
        return $dst;
    }

    /**
     * Center crop / fit to exact width & height
     */
    protected static function cropFit($src, int $srcW, int $srcH, int $targetW, int $targetH)
    {
        $srcRatio = $srcW / $srcH;
        $targetRatio = $targetW / $targetH;

        if ($srcRatio >= $targetRatio) {
            $cropH = $srcH;
            $cropW = (int)round($srcH * $targetRatio);
            $cropX = (int)round(($srcW - $cropW) / 2);
            $cropY = 0;
        } else {
            $cropW = $srcW;
            $cropH = (int)round($srcW / $targetRatio);
            $cropX = 0;
            $cropY = (int)round(($srcH - $cropH) / 2);
        }

        $dst = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
        imagefilledrectangle($dst, 0, 0, $targetW, $targetH, $transparent);

        imagecopyresampled($dst, $src, 0, 0, $cropX, $cropY, $targetW, $targetH, $cropW, $cropH);
        return $dst;
    }

    /**
     * Save GD resource as WebP (or JPG) using native functions or cwebp / magick CLI
     */
    protected static function saveGdImage($gdImage, string $targetPath, string $extension, int $quality, array &$cleanupList): bool
    {
        if ($extension === 'webp') {
            if (function_exists('imagewebp')) {
                return imagewebp($gdImage, $targetPath, $quality);
            }

            // Save intermediate PNG then convert via cwebp or magick
            $tmpPng = sys_get_temp_dir() . '/gd_out_' . uniqid() . '.png';
            imagepng($gdImage, $tmpPng);
            $cleanupList[] = $tmpPng;

            $cwebp = self::getCwebpBinary();
            if ($cwebp) {
                $cmd = escapeshellarg($cwebp) . ' -q ' . (int)$quality . ' ' . escapeshellarg($tmpPng) . ' -o ' . escapeshellarg($targetPath) . ' 2>&1';
                exec($cmd, $out, $ret);
                if ($ret === 0 && file_exists($targetPath)) {
                    return true;
                }
            }

            $magick = self::getMagickBinary();
            if ($magick) {
                $cmd = escapeshellarg($magick) . ' ' . escapeshellarg($tmpPng) . ' -quality ' . (int)$quality . ' ' . escapeshellarg($targetPath) . ' 2>&1';
                exec($cmd, $out, $ret);
                if ($ret === 0 && file_exists($targetPath)) {
                    return true;
                }
            }

            // Fallback to saving as JPG if CLI conversion fails
            $targetPathJpg = preg_replace('/\.webp$/i', '.jpg', $targetPath);
            return imagejpeg($gdImage, $targetPathJpg, $quality);
        }

        if ($extension === 'png') {
            return imagepng($gdImage, $targetPath, 8);
        }

        return imagejpeg($gdImage, $targetPath, $quality);
    }

    /**
     * Check if WebP output can be generated
     */
    public static function supportsWebp(): bool
    {
        if (function_exists('imagewebp')) {
            return true;
        }
        if (self::getCwebpBinary() !== null) {
            return true;
        }
        if (self::getMagickBinary() !== null) {
            return true;
        }
        return false;
    }

    protected static function getCwebpBinary(): ?string
    {
        if (self::$cwebpBinary !== null) {
            return self::$cwebpBinary !== '' ? self::$cwebpBinary : null;
        }

        $commonPaths = [
            '/opt/homebrew/bin/cwebp',
            '/usr/local/bin/cwebp',
            '/usr/bin/cwebp',
            '/bin/cwebp',
        ];

        foreach ($commonPaths as $path) {
            if (file_exists($path) && is_executable($path)) {
                self::$cwebpBinary = $path;
                return $path;
            }
        }

        exec('which cwebp 2>&1', $out, $ret);
        if ($ret === 0 && !empty($out[0]) && file_exists($out[0])) {
            self::$cwebpBinary = trim($out[0]);
            return self::$cwebpBinary;
        }

        self::$cwebpBinary = '';
        return null;
    }

    protected static function getDwebpBinary(): ?string
    {
        if (self::$dwebpBinary !== null) {
            return self::$dwebpBinary !== '' ? self::$dwebpBinary : null;
        }

        $commonPaths = [
            '/opt/homebrew/bin/dwebp',
            '/usr/local/bin/dwebp',
            '/usr/bin/dwebp',
            '/bin/dwebp',
        ];

        foreach ($commonPaths as $path) {
            if (file_exists($path) && is_executable($path)) {
                self::$dwebpBinary = $path;
                return $path;
            }
        }

        exec('which dwebp 2>&1', $out, $ret);
        if ($ret === 0 && !empty($out[0]) && file_exists($out[0])) {
            self::$dwebpBinary = trim($out[0]);
            return self::$dwebpBinary;
        }

        self::$dwebpBinary = '';
        return null;
    }

    protected static function getMagickBinary(): ?string
    {
        if (self::$magickBinary !== null) {
            return self::$magickBinary !== '' ? self::$magickBinary : null;
        }

        $commonPaths = [
            '/opt/homebrew/bin/magick',
            '/usr/local/bin/magick',
            '/opt/homebrew/bin/convert',
            '/usr/local/bin/convert',
            '/usr/bin/convert',
        ];

        foreach ($commonPaths as $path) {
            if (file_exists($path) && is_executable($path)) {
                self::$magickBinary = $path;
                return $path;
            }
        }

        self::$magickBinary = '';
        return null;
    }

    protected static function isWebpFile(string $path): bool
    {
        if (!file_exists($path)) {
            return false;
        }

        $handle = @fopen($path, 'rb');
        if (!$handle) {
            return false;
        }

        $header = fread($handle, 12);
        fclose($handle);

        if (strlen($header) >= 12) {
            if (substr($header, 0, 4) === 'RIFF' && substr($header, 8, 4) === 'WEBP') {
                return true;
            }
        }

        return false;
    }

    protected static function decodeWebpToPng(string $webpPath): ?string
    {
        $targetPng = sys_get_temp_dir() . '/dwebp_' . uniqid() . '.png';

        $dwebp = self::getDwebpBinary();
        if ($dwebp) {
            $command = escapeshellarg($dwebp) . ' ' . escapeshellarg($webpPath) . ' -o ' . escapeshellarg($targetPng) . ' 2>&1';
            exec($command, $output, $code);
            if ($code === 0 && file_exists($targetPng)) {
                return $targetPng;
            }
        }

        $magick = self::getMagickBinary();
        if ($magick) {
            $command = escapeshellarg($magick) . ' ' . escapeshellarg($webpPath) . ' ' . escapeshellarg($targetPng) . ' 2>&1';
            exec($command, $output, $code);
            if ($code === 0 && file_exists($targetPng)) {
                return $targetPng;
            }
        }

        return null;
    }

    public static function ensureDirectoryExists(string $dir): void
    {
        if (!is_dir($dir) && !file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    public static function cleanOldFiles(string $dir, string $baseName): void
    {
        if (!is_dir($dir)) {
            return;
        }

        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'];
        foreach ($extensions as $ext) {
            $filePath = rtrim($dir, '/') . '/' . $baseName . '.' . $ext;
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }
    }

    public static function deleteImage(?string $filename, string $targetDir, ?string $thumbDir = null): void
    {
        if (empty($filename)) {
            return;
        }

        $mainPath = rtrim($targetDir, '/') . '/' . $filename;
        if (file_exists($mainPath)) {
            @unlink($mainPath);
        }

        if ($thumbDir) {
            $thumbPath = rtrim($thumbDir, '/') . '/' . $filename;
            if (file_exists($thumbPath)) {
                @unlink($thumbPath);
            }
        }
    }
}

