<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Finish;
use App\Models\Wood;
use App\Models\ProductImage;
use App\Http\Requests\ProductRequest;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if (!empty($request->search_by_keyword)) {
            $keyword = $request->search_by_keyword;
            $products->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%');
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $products->onlyTrashed();
        }

        $products = $products->latest()->paginate(10);

        return view('admin.pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id');
        $finishes = Finish::orderBy('name')->pluck('name', 'id');
        $woods = Wood::orderBy('name')->pluck('name', 'id');
        return view('admin.pages.product.create', compact('categories', 'finishes', 'woods'));
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->slug = $request->slug ?: Str::slug($request->title);
        $product->category_id = $request->category_id;
        $product->finish_id = $request->finish_id;
        $product->wood_id = $request->wood_id;
        $product->featured_product = $request->featured_product ?? 'N';
        $product->quantity = $request->quantity ?? 1;
        $product->price = $request->price;
        $product->material = $request->material;
        $product->excerpt = $request->excerpt;
        $product->code = $request->code;
        $product->cbm = $request->cbm;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/products/'),
                (string)$product->id,
                800,
                800,
                public_path('images/products/thumbnail/'),
                128,
                128,
                85
            );

            if ($filename) {
                $product->image = $filename;
                $product->save();
            }
        }

        // Multiple gallery images (files or base64 data URLs)
        $galleryItems = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryFile) {
                if ($galleryFile && $galleryFile->isValid()) {
                    $galleryItems[] = $galleryFile;
                }
            }
        }
        if ($request->has('gallery_images_base64') && is_array($request->input('gallery_images_base64'))) {
            foreach ($request->input('gallery_images_base64') as $b64) {
                if (!empty($b64) && is_string($b64)) {
                    $galleryItems[] = $b64;
                }
            }
        }

        if (!empty($galleryItems)) {
            $galleryDir = public_path('images/products/gallery/');
            if (!file_exists($galleryDir)) {
                @mkdir($galleryDir, 0755, true);
            }
            foreach ($galleryItems as $idx => $gallerySource) {
                $prefix = $product->id . '_' . time() . '_' . Str::random(6);
                $filename = ImageOptimizer::processAndSave(
                    $gallerySource,
                    $galleryDir,
                    $prefix,
                    800,
                    800,
                    null,
                    0,
                    0,
                    85
                );
                if ($filename) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $filename,
                        'sort_order' => $idx + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product has been created successfully.');
    }

    public function edit(Request $request, Product $product)
    {
        $categories = Category::pluck('title', 'id');
        $finishes = Finish::orderBy('name')->pluck('name', 'id');
        $woods = Wood::orderBy('name')->pluck('name', 'id');
        $galleryImages = $product->images;
        return view('admin.pages.product.edit', compact('product', 'categories', 'finishes', 'woods', 'galleryImages'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->title = $request->title;
        $product->slug = $request->slug ?: Str::slug($request->title);
        $product->category_id = $request->category_id;
        $product->finish_id = $request->finish_id;
        $product->wood_id = $request->wood_id;
        $product->featured_product = $request->featured_product ?? 'N';
        $product->quantity = $request->quantity ?? 1;
        $product->price = $request->price;
        $product->material = $request->material;
        $product->excerpt = $request->excerpt;
        $product->code = $request->code;
        $product->cbm = $request->cbm;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/products/'),
                (string)$product->id,
                800,
                800,
                public_path('images/products/thumbnail/'),
                128,
                128,
                85
            );

            if ($filename) {
                $product->image = $filename;
                $product->save();
            }
        }

        // Multiple gallery images (files or base64 data URLs)
        $galleryItems = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryFile) {
                if ($galleryFile && $galleryFile->isValid()) {
                    $galleryItems[] = $galleryFile;
                }
            }
        }
        if ($request->has('gallery_images_base64') && is_array($request->input('gallery_images_base64'))) {
            foreach ($request->input('gallery_images_base64') as $b64) {
                if (!empty($b64) && is_string($b64)) {
                    $galleryItems[] = $b64;
                }
            }
        }

        if (!empty($galleryItems)) {
            $galleryDir = public_path('images/products/gallery/');
            if (!file_exists($galleryDir)) {
                @mkdir($galleryDir, 0755, true);
            }
            $currentMaxOrder = $product->images()->max('sort_order') ?? 0;
            foreach ($galleryItems as $idx => $gallerySource) {
                $prefix = $product->id . '_' . time() . '_' . Str::random(6);
                $filename = ImageOptimizer::processAndSave(
                    $gallerySource,
                    $galleryDir,
                    $prefix,
                    800,
                    800,
                    null,
                    0,
                    0,
                    85
                );
                if ($filename) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $filename,
                        'sort_order' => $currentMaxOrder + $idx + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product has been updated successfully.');
    }

    public function deleteGalleryImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $filePath = public_path('images/products/gallery/' . $image->image);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        $image->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Gallery image deleted.']);
        }
        return redirect()->back()->with('success', 'Gallery image deleted successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $product->restore();
                    return redirect()->route('admin.product.index')->with('success', 'Product restored.');
                case 'permanent-delete':
                    ImageOptimizer::cleanOldFiles(public_path('images/products/'), (string)$product->id);
                    ImageOptimizer::cleanOldFiles(public_path('images/products/thumbnail/'), (string)$product->id);
                    $product->forceDelete();
                    return redirect()->route('admin.product.index')->with('success', 'Product permanently deleted.');
            }
        } else {
            $product->delete();
            return redirect()->back()->with('success', 'Product moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $productId) {
                $product = Product::withTrashed()->find($productId);
                if ($product) {
                    if ($request->action === 'permanent-delete') {
                        ImageOptimizer::cleanOldFiles(public_path('images/products/'), (string)$product->id);
                        ImageOptimizer::cleanOldFiles(public_path('images/products/thumbnail/'), (string)$product->id);
                        $product->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $product->restore();
                    } else {
                        $product->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected products updated.');
        }

        return redirect()->back()->with('error', 'No products selected.');
    }
}

