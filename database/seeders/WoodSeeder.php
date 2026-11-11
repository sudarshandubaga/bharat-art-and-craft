<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wood;

class WoodSeeder extends Seeder
{
    public function run(): void
    {
        $woods = [
            ['name' => 'Sheesham Wood (Indian Rosewood)', 'slug' => 'sheesham-wood'],
            ['name' => 'CP Teak Wood (Sagwan)', 'slug' => 'cp-teak-wood'],
            ['name' => 'Acacia Hardwood (Babool)', 'slug' => 'acacia-hardwood'],
            ['name' => 'Seasoned Mango Wood', 'slug' => 'seasoned-mango-wood'],
            ['name' => 'Solid White Oak', 'slug' => 'solid-white-oak'],
            ['name' => 'Reclaimed Architectural Timber', 'slug' => 'reclaimed-timber'],
        ];

        foreach ($woods as $w) {
            Wood::updateOrCreate(['slug' => $w['slug']], [
                'name' => $w['name'],
                'status' => 'active',
            ]);
        }
    }
}
