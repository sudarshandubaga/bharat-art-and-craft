<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Lounge & Sofas',
                'slug' => 'lounge',
                'image' => 'fur_chair_boucle.png',
            ],
            [
                'title' => 'Dining & Stools',
                'slug' => 'dining',
                'image' => 'fp_table_oak_round.png',
            ],
            [
                'title' => 'Tables & Coffee Tables',
                'slug' => 'tables',
                'image' => 'fp_table_coffee_travertine.png',
            ],
            [
                'title' => 'Consoles & Storage',
                'slug' => 'storage',
                'image' => 'fur_new_sideboard.png',
            ],
            [
                'title' => 'Solid Wood Beds',
                'slug' => 'bedroom',
                'image' => 'fur_prod_bed_oak.png',
            ],
            [
                'title' => 'Office Chairs & Desks',
                'slug' => 'office',
                'image' => 'fur_prod_desk.png',
            ],
            [
                'title' => 'Designer Lighting',
                'slug' => 'lighting',
                'image' => 'fur_new_lantern.png',
            ],
            [
                'title' => 'Aesthetic Decor',
                'slug' => 'decor',
                'image' => 'fur_new_vases.png',
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'image' => $data['image'] ?? null,
                    'category_id' => null,
                    'description' => 'Explore our bespoke, handcrafted ' . $data['title'] . ' collection. Hand-carved from seasoned Indian hardwoods with traditional mortise-and-tenon joints for international hospitality and architectural projects.',
                    'seo_title' => $data['title'] . ' | Handcrafted Solid Wood Collections | Bharat Art & Craft',
                    'seo_keywords' => strtolower($data['title']) . ', handcrafted furniture, jodhpur handicrafts, solid wood export, bespoke furniture india',
                    'seo_description' => 'Discover artisan-crafted ' . $data['title'] . ' from Bharat Art & Craft. Seasoned timber, custom dimensions, export-grade packaging, and wholesale trade pricing.',
                ]
            );
        }
    }
}
