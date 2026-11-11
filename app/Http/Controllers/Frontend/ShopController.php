<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wood;
use App\Models\Finish;
use App\Models\Faq;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, ?Category $currentCategory = null)
    {
        $categories = Category::withCount('products')
            ->orderBy('title')
            ->get();

        $query = Product::with('category');

        // Apply category filter if browsing a specific category
        if ($currentCategory) {
            $query->where('category_id', $currentCategory->id);
        } elseif ($request->filled('category')) {
            $catSlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        // Search query (supports ?search=, ?s=, or ?q=)
        $s = $request->input('search') ?: $request->input('s') ?: $request->input('q');
        if (!empty($s)) {
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                    ->orWhere('code', 'like', "%{$s}%")
                    ->orWhere('material', 'like', "%{$s}%")
                    ->orWhere('description', 'like', "%{$s}%");
            });
        }

        // Material filter
        if ($request->filled('material') && $request->input('material') !== 'all') {
            $mat = $request->input('material');
            $query->where('material', 'like', "%{$mat}%");
        }

        // Price filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float)$request->input('max_price'));
        }

        // Sorting
        $sortBy = $request->input('sort', 'default');
        match ($sortBy) {
            'price-asc' => $query->orderBy('price', 'asc'),
            'price-desc' => $query->orderBy('price', 'desc'),
            'name-asc' => $query->orderBy('title', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(16)->withQueryString();

        $allProductsQuery = Product::with('category');
        if ($currentCategory) {
            $allProductsQuery->where('category_id', $currentCategory->id);
        }
        $allProducts = $allProductsQuery->latest()->get();
        $frontendProducts = $allProducts->map(fn($p) => $p->toFrontendArray())->values();

        return view('shop.index', compact('categories', 'products', 'frontendProducts', 'currentCategory'));
    }

    /**
     * Dedicated SEO-Friendly Category Page: /category/{slug}
     */
    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            // Check by ID or case-insensitive
            $category = Category::where('id', $slug)->orWhereRaw('LOWER(title) = ?', [strtolower(str_replace('-', ' ', $slug))])->firstOrFail();
            return redirect()->route('category.show', ['slug' => $category->slug], 301);
        }

        return $this->index($request, $category);
    }

    /**
     * Dedicated SEO-Friendly Product Page: /product/{slug}
     */
    public function product($slug = null)
    {
        $product = null;
        if (!empty($slug)) {
            // Find by slug first
            $product = Product::with(['category', 'wood', 'finish', 'images'])
                ->where('slug', $slug)
                ->first();

            // If not found by slug, try by ID and 301 redirect to slug URL
            if (!$product && is_numeric($slug)) {
                $product = Product::with(['category', 'wood', 'finish', 'images'])->find($slug);
                if ($product && $product->slug) {
                    return redirect()->route('product.single', ['slug' => $product->slug], 301);
                }
            }
        }

        if (!$product) {
            $product = Product::with(['category', 'wood', 'finish', 'images'])->latest()->first();
        }

        $relatedProducts = collect();
        if ($product) {
            $relatedProducts = Product::with(['category', 'wood', 'finish'])
                ->where('id', '!=', $product->id)
                ->when($product->category_id, fn($q) => $q->where('category_id', $product->category_id))
                ->take(8)
                ->get();

            if ($relatedProducts->count() < 4) {
                $additional = Product::with(['category', 'wood', 'finish'])
                    ->where('id', '!=', $product->id)
                    ->whereNotIn('id', $relatedProducts->pluck('id'))
                    ->take(8 - $relatedProducts->count())
                    ->get();
                $relatedProducts = $relatedProducts->concat($additional);
            }
        }

        $faqs = Faq::where('status', 'active')->orderBy('sort_order', 'asc')->take(6)->get();

        return view('shop.product', compact('product', 'relatedProducts', 'slug', 'faqs'));
    }

    public function editorial()
    {
        return view('shop.editorial');
    }

    public function materials()
    {
        return view('shop.materials');
    }

    public function completeRoom()
    {
        return view('shop.complete-room');
    }

    public function rooms()
    {
        return view('shop.rooms');
    }

    /**
     * AJAX search autocomplete for products and categories.
     */
    public function autocomplete(Request $request)
    {
        $q = trim($request->input('q') ?: $request->input('search') ?: $request->input('term') ?: $request->input('s') ?: '');

        if (strlen($q) < 1) {
            return response()->json([
                'query' => $q,
                'categories' => [],
                'products' => [],
                'categories_count' => 0,
                'products_count' => 0,
                'total_matches' => 0,
                'has_results' => false,
            ]);
        }

        // Match categories by title
        $categories = Category::withCount('products')
            ->where('title', 'like', "%{$q}%")
            ->take(5)
            ->get()
            ->map(fn($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
                'title' => $cat->title,
                'slug' => $cat->slug,
                'url' => route('category.show', $cat->slug),
                'products_count' => $cat->products_count,
            ]);

        // Match products by title, code, material, description
        $products = Product::with('category')
            ->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('code', 'like', "%{$q}%")
                    ->orWhere('material', 'like', "%{$q}%");
            })
            ->take(8)
            ->get()
            ->map(fn($prod) => [
                'id' => $prod->id,
                'title' => $prod->title,
                'slug' => $prod->slug,
                'url' => route('product.single', $prod->slug),
                'price' => (float)$prod->price,
                'cbm' => $prod->cbm ?: '0.45',
                'formatted_cbm' => ($prod->cbm ? $prod->cbm . ' CBM' : '0.45 CBM'),
                'formatted_price' => ($prod->cbm ? $prod->cbm . ' CBM' : 'Custom CBM'),
                'image' => $prod->image_url,
                'category_name' => $prod->category ? $prod->category->name : 'Furniture',
                'category_slug' => $prod->category ? $prod->category->slug : '',
                'code' => $prod->code,
                'material' => $prod->material,
            ]);

        $categoriesCount = $categories->count();
        $productsCount = $products->count();
        $totalMatches = $categoriesCount + $productsCount;

        return response()->json([
            'query' => $q,
            'categories' => $categories,
            'products' => $products,
            'categories_count' => $categoriesCount,
            'products_count' => $productsCount,
            'total_matches' => $totalMatches,
            'has_results' => $totalMatches > 0,
        ]);
    }
}
