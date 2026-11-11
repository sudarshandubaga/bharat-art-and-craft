<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'The Harmony Collection',
                'description' => 'Where nature meets design. A perfect balance of organic solid wood, artisanal comfort, and intentional living.',
                'image' => 'fur_hero_harmony_sofa.png',
                'excerpt' => 'NEW COLLECTION',
            ],
            [
                'title' => 'Masterpieces in Solid Wood & Iron',
                'description' => 'Exquisite live-edge dining slabs, storage credenzas, and bespoke architectural furniture handcrafted by master artisans in Jodhpur.',
                'image' => 'fur_hero_dark.png',
                'excerpt' => 'HERITAGE ARTISAN',
            ],
            [
                'title' => 'Modern Minimalist Living',
                'description' => 'Clean architectural lines, tactile natural cane weaving, and sustainably seasoned Acacia & Sheesham hardwood.',
                'image' => 'fur_hero_light.png',
                'excerpt' => 'TIMELESS SPACES',
            ],
            [
                'title' => 'Global Furniture Export Quality',
                'description' => 'Direct manufacturer & exporter supplying premier boutique hotels, architects, and luxury showrooms worldwide.',
                'image' => 'fur_hero_oak.png',
                'excerpt' => 'DIRECT ATELIER',
            ],
        ];

        foreach ($sliders as $s) {
            Slider::updateOrCreate(
                ['title' => $s['title']],
                $s
            );
        }
    }
}

