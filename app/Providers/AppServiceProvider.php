<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Site;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('sites')) {
                    $site = Site::first() ?? new Site([
                        'title' => 'Bharat Art & Craft',
                        'tagline' => 'Handcrafted Solid Wood & Industrial Furniture Exporters',
                        'email' => 'info@bharatartandcraft.com',
                        'phone' => '+91-9876543210',
                        'whatsapp' => '+919876543210',
                        'address' => 'Industrial Area, Jodhpur, Rajasthan, India',
                    ]);
                    $view->with('site', $site);
                }

                if (Schema::hasTable('categories')) {
                    $globalCategories = Category::withCount('products')
                        ->orderBy('title')
                        ->get();
                    $view->with('globalCategories', $globalCategories);
                }

                if (Schema::hasTable('products')) {
                    if (!$view->offsetExists('frontendProducts')) {
                        $frontendProducts = Product::with('category')
                            ->latest()
                            ->take(40)
                            ->get()
                            ->map(fn($p) => $p->toFrontendArray())
                            ->values();
                        $view->with('frontendProducts', $frontendProducts);
                    }
                }
            } catch (\Throwable $e) {
                // Fail gracefully during migrations or setups
            }
        });
    }
}
