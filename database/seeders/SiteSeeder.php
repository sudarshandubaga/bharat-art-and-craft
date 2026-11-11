<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        Site::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Bharat Art & Craft',
                'tagline' => 'Handcrafted Excellence in Wood & Metal',
                'email' => 'info@bharatartandcraft.com',
                'phone' => '+91-9876543210',
                'whatsapp' => '+919876543210',
                'domain' => 'bharatartandcraft.com',
                'address' => 'Industrial Area, Jodhpur, Rajasthan, India',
                'social_links' => [
                    'facebook' => 'https://facebook.com/bharatartcraft',
                    'instagram' => 'https://instagram.com/bharatartcraft',
                    'twitter' => null,
                    'linked' => null,
                    'youtube' => null,
                ],
            ]
        );
    }
}

