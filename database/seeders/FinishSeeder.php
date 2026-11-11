<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finish;

class FinishSeeder extends Seeder
{
    public function run(): void
    {
        $finishes = [
            ['name' => 'Natural Wax Finish', 'slug' => 'natural-wax-finish'],
            ['name' => 'Warm Honey Teak Finish', 'slug' => 'warm-honey-teak-finish'],
            ['name' => 'Dark Walnut Stain', 'slug' => 'dark-walnut-stain'],
            ['name' => 'Rustic Distress Finish', 'slug' => 'rustic-distress-finish'],
            ['name' => 'Smoked Ash Matte Finish', 'slug' => 'smoked-ash-matte-finish'],
            ['name' => 'Bleached Nordic Finish', 'slug' => 'bleached-nordic-finish'],
            ['name' => 'Antique Rosewood Polish', 'slug' => 'antique-rosewood-polish'],
        ];

        foreach ($finishes as $f) {
            Finish::updateOrCreate(['slug' => $f['slug']], [
                'name' => $f['name'],
                'status' => 'active',
            ]);
        }
    }
}
