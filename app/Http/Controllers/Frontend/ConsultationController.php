<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsultationController extends Controller
{
    public function index()
    {
        return view('consultation');
    }

    public function submit(Request $request)
    {
        $name = $request->input('name') ?: $request->input('client_name');
        $email = $request->input('email') ?: $request->input('client_email');
        $phone = $request->input('phone') ?: $request->input('client_phone');
        $dimension = $request->input('dimension') ?: $request->input('dimensions') ?: $request->input('custom_dimensions');
        $specification = $request->input('specification') ?: $request->input('details') ?: $request->input('message') ?: $request->input('client_notes');

        $request->merge([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'dimension' => $dimension,
            'specification' => $specification,
        ]);

        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'nullable|string|max:50',
            'dimension' => 'nullable|string|max:255',
            'specification' => 'nullable|string',
        ]);

        $fullMessage = "=== BESPOKE CUSTOMIZED ENQUIRY ===\n\n";
        $fullMessage .= "Name: " . $name . "\n";
        $fullMessage .= "Email: " . $email . "\n";
        if (!empty($phone)) {
            $fullMessage .= "Phone: " . $phone . "\n";
        }
        if (!empty($dimension)) {
            $fullMessage .= "Dimension: " . $dimension . "\n";
        }
        if (!empty($specification)) {
            $fullMessage .= "\nSpecification:\n" . $specification . "\n";
        }

        // Backward compatibility for legacy test fields
        $type = $request->input('furniture_type') ?: $request->input('project_type');
        if ($type) {
            $fullMessage .= "Project / Furniture Type: " . $type . "\n";
        }
        $timber = $request->input('timber_type') ?: $request->input('timber_finish') ?: $request->input('wood_species');
        if ($timber) {
            $fullMessage .= "Preferred Timber / Finish: " . $timber . "\n";
        }
        if ($request->filled('finish')) {
            $fullMessage .= "Wood Finish: " . $request->input('finish') . "\n";
        }
        if ($request->filled('quantity')) {
            $fullMessage .= "Quantity: " . $request->input('quantity') . "\n";
        }
        $city = $request->input('client_city') ?: $request->input('city');
        if ($city) {
            $fullMessage .= "Delivery Destination: " . $city . "\n";
        }

        // Directory for consultation uploads
        $uploadDir = public_path('uploads/consultations/');
        $thumbDir = public_path('uploads/consultations/thumbnail/');
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }
        if (!file_exists($thumbDir)) {
            @mkdir($thumbDir, 0755, true);
        }

        $attachedLinks = [];

        // 1. Process client-side converted base64 image (resizing & WebP)
        if ($request->filled('design_image_base64')) {
            $baseName = 'design_' . time() . '_' . uniqid();
            try {
                $savedFile = ImageOptimizer::processAndSave(
                    $request->input('design_image_base64'),
                    $uploadDir,
                    $baseName,
                    1200,
                    1200,
                    $thumbDir,
                    200,
                    200,
                    85
                );
                if ($savedFile) {
                    $attachedLinks[] = asset('uploads/consultations/' . $savedFile);
                }
            } catch (\Exception $e) {
                Log::warning('Consultation base64 image optimization failed: ' . $e->getMessage());
            }
        }

        // 2. Process uploaded file(s)
        $files = [];
        if ($request->hasFile('design_files')) {
            $files = $request->file('design_files');
        } elseif ($request->hasFile('design_file')) {
            $files = [$request->file('design_file')];
        } elseif ($request->hasFile('design_image')) {
            $files = [$request->file('design_image')];
        }

        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $mime = $file->getMimeType() ?? '';
                if (str_starts_with($mime, 'image/')) {
                    $baseName = 'design_' . time() . '_' . uniqid();
                    $savedFile = ImageOptimizer::processAndSave(
                        $file,
                        $uploadDir,
                        $baseName,
                        1200,
                        1200,
                        $thumbDir,
                        200,
                        200,
                        85
                    );
                    if ($savedFile) {
                        $attachedLinks[] = asset('uploads/consultations/' . $savedFile);
                    }
                } else {
                    // Non-image files (such as PDF)
                    $cleanName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                    $file->move($uploadDir, $cleanName);
                    $attachedLinks[] = asset('uploads/consultations/' . $cleanName);
                }
            }
        }

        if (!empty($attachedLinks)) {
            $fullMessage .= "\nAttached Design Files (Optimized):\n";
            foreach ($attachedLinks as $link) {
                $fullMessage .= "- " . $link . "\n";
            }
        }

        $order = Order::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone ?? '',
            'message' => $fullMessage,
        ]);

        $orderRef = 'BAC-CUST-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your customized enquiry has been submitted successfully! Our master craft specialist will review your specifications.',
                'order_id' => $order->id,
                'order_ref' => $orderRef,
            ]);
        }

        return redirect()->back()->with('success', 'Your customized enquiry has been submitted successfully! Our master craft specialist will review your specifications.');
    }
}
