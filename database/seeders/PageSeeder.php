<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Bharat Art & Craft',
                'slug' => 'about-us',
                'excerpt' => 'Bharat Art & Craft is a premier manufacturer and exporter of handcrafted solid wood, industrial iron, and bespoke architectural furniture based in the historic craft hub of Jodhpur, Rajasthan (India). Founded with a passion for celebrating organic timber beauty and generations-old artisan joinery, we serve esteemed wholesalers, design houses, boutique hotels, and retail brands worldwide. Our manufacturing facility in Jodhpur spans specialized seasoning kilns, automated precision wood-machining units, hand-carving artisan pavilions, and advanced dust-free finishing booths.',
                'meta_title' => 'About Bharat Art & Craft Atelier | Heritage Woodcrafting',
                'meta_description' => 'Discover our Jodhpur artisan woodworking atelier, sustainable forestry principles, and bespoke furniture craft.',
                'image' => 'fur_room_living.png',
            ],
            [
                'title' => 'Terms of Use & Commercial Policy',
                'slug' => 'terms-of-use',
                'excerpt' => '1. Minimum Order Quantity (MOQ): Standard wholesale orders require minimum 20ft Full Container Load (FCL). Mixed item assortments are welcomed. 2. Production Lead Time: 45 to 60 days from commercial invoice approval and deposit receipt. 3. Payment Terms: 30% advance deposit via T/T bank wire, with remaining 70% balance payable upon submission of Bill of Lading (B/L) copy. Irrevocable Letter of Credit (L/C) accepted for high-volume contracts. 4. Inspection & Quality: Third-party quality inspection agencies (SGS, Intertek, Bureau Veritas) are welcomed prior to container loading.',
                'meta_title' => 'Terms & Conditions of Export | Bharat Art & Craft',
                'meta_description' => 'Terms of service, custom ordering, and export trade regulations for Bharat Art & Craft.',
            ],
            [
                'title' => 'Privacy Policy & Data Security',
                'slug' => 'privacy-policy',
                'excerpt' => 'Bharat Art & Craft respects the confidential nature of client relationships. All custom OEM drawings, proprietary design specifications, private label branding, and commercial pricing agreements remain strictly confidential and will never be shared with third parties or competitors. We comply with international data security standards and GDPR guidelines.',
                'meta_title' => 'Privacy Policy | Bharat Art & Craft',
                'meta_description' => 'How Bharat Art & Craft handles client data, intellectual property, and trade drawings with confidentiality.',
            ],
            [
                'title' => 'Frequently Asked Questions (FAQ)',
                'slug' => 'faq',
                'excerpt' => 'Comprehensive guidance regarding our sustainably seasoned Indian hardwoods, custom CAD manufacturing, transit packaging, international sea-freight logistics, and long-term timber maintenance.',
                'meta_title' => 'Frequently Asked Questions | Bharat Art & Craft',
                'meta_description' => 'Find answers about our timbers, bespoke customizations, packaging standards, and warranties.',
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(
                ['slug' => $p['slug']],
                $p
            );
        }
    }
}

