<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'The Silent Geometry of Japandi Interiors',
                'slug' => 'the-silent-geometry-of-japandi-interiors',
                'excerpt' => 'How the dialogue between Japanese simplicity and Danish hygge warmth transforms cold residential boxes into healing spatial sanctuaries.',
                'description' => 'Japandi is not simply a decorative trend; it is a philosophy of reduction and materiality. In this essay, we examine how raw timber joints, uncluttered sightlines, and tactile natural textiles work together to create calming spaces that foster mindfulness and daily tranquility. Learn how to balance light-toned timbers like European White Oak and warm honey Sheesham with unglazed pottery and woven linen fabrics.',
                'image' => 'fur_room_living.png',
                'meta_title' => 'The Silent Geometry of Japandi Interiors | Bharat Art & Craft Journal',
                'meta_keywords' => 'japandi, japanese minimalism, wabi sabi furniture, wooden interiors',
                'meta_description' => 'Explore the principles of Japandi style and how natural solid wood furniture brings calm balance into modern homes.',
            ],
            [
                'title' => 'Honouring the Forest: Sustainable Wood Sourcing in Rajasthan',
                'slug' => 'sustainable-wood-sourcing-and-artisan-traditions',
                'excerpt' => 'How centuries-old joinery traditions meet certified plantation timber to create eco-friendly handcrafted luxury furniture.',
                'description' => 'The craft traditions of Jodhpur date back to royal palace workshops where master joiners crafted ornate jharokhas, carved thrones, and storage chests. Today, Bharat Art & Craft bridges that generational heritage with certified sustainable plantation forestry. Every timber log is sourced from legal government-approved agricultural farm lands, supporting local farming communities and preserving natural forest reserves.',
                'image' => 'fur_journal_sustain.png',
                'meta_title' => 'Sustainable Wood Sourcing in Rajasthan | Bharat Art & Craft',
                'meta_keywords' => 'sustainable timber, FSC wood, acacia furniture, sheesham wood jodhpur',
                'meta_description' => 'A deep dive into our ethical forestry and wood seasoning kiln methods in Jodhpur, India.',
            ],
            [
                'title' => 'Making Small Spaces Breathe: 5 Architectural Layout Rules',
                'slug' => 'making-small-spaces-breathe-5-layout-rules',
                'excerpt' => 'How scale planning, floating leg systems, and metric furniture heights avoid visual clutter and layout confinement.',
                'description' => 'Living in compact urban apartments does not mean sacrificing aesthetic grandeur or ergonomic ease. By lifting sofas on slender wooden stiles, choosing round pedestal dining tables that eliminate restrictive corners, and selecting floating consoles, natural daylight can flow unobstructed beneath furniture, tricking the eye into perceiving expanded floor space.',
                'image' => 'fur_room_office.png',
                'meta_title' => '5 Layout Rules to Make Small Spaces Breathe | Design Guide',
                'meta_keywords' => 'small space furniture, apartment layout ideas, minimalist interior planning',
                'meta_description' => 'Interior architect tips on choosing furniture dimensions and leg clearances for airy small-space living.',
            ],
            [
                'title' => 'The Tactile Beauty of Imperfect Materials: Wabi-Sabi Aesthetics',
                'slug' => 'the-beauty-of-imperfect-materials-wabi-sabi',
                'excerpt' => 'Celebrating natural wood knots, mineral streaks, and raw stone fissures in modern architectural living.',
                'description' => 'Perfection is often sterile. True character lives in the organic growth rings of hundred-year-old trees, the chisel marks of a master sculptor, and the porous cavities of Roman travertine. Discover why tactile, raw-touch textures ground human emotion and create spaces that grow more beautiful with every passing year.',
                'image' => 'fur_journal_craft.png',
                'meta_title' => 'Wabi-Sabi & The Beauty of Imperfect Materials | Bharat Art & Craft',
                'meta_keywords' => 'wabi sabi, natural materials, organic modern furniture, travertine stone',
                'meta_description' => 'Why living with organic, hand-finished solid materials enriches daily human well-being.',
            ],
        ];

        foreach ($blogs as $b) {
            Blog::updateOrCreate(
                ['slug' => $b['slug']],
                $b
            );
        }
    }
}

