<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Sophia Lindqvist — Stockholm, Sweden',
                'remark' => 'The live-edge Acacia dining table from Bharat Art & Craft has completely transformed our Stockholm home. The grain patterns and butterfly joinery are breathtaking. Arrived in immaculate wooden crating with zero scratches.',
                'image' => 'about_artisan_elena.png',
            ],
            [
                'name' => 'Marcus Vance — Principal Architect, London',
                'remark' => 'We specified Bharat Art & Craft custom sideboards and dining chairs for a 12-suite boutique hotel project in the Cotswolds. The craftsmanship, moisture seasoning, and attention to CAD specifications were world-class.',
                'image' => 'designer_marco.png',
            ],
            [
                'name' => 'Elena Rostova — Interior Stylist, Milan',
                'remark' => 'In a world of flat-packed synthetic furniture, Bharat Art & Craft produces pieces with soul. The solid oak spindle bed feels grounded, quiet, and timeless. Truly heirloom quality.',
                'image' => 'designer_ava.png',
            ],
            [
                'name' => 'David & Claire K. — Melbourne, Australia',
                'remark' => 'Ordering a bespoke 10-seater dining table from India felt daring, but their team shared photos at every stage—from timber slab selection to the final wax polish. We could not be happier!',
                'image' => 'designer_sophie.png',
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                $t
            );
        }
    }
}

