<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Finish;
use App\Models\Wood;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catLounge = Category::where('slug', 'lounge')->first();
        $catDining = Category::where('slug', 'dining')->first();
        $catTables = Category::where('slug', 'tables')->first();
        $catStorage = Category::where('slug', 'storage')->first();
        $catBedroom = Category::where('slug', 'bedroom')->first();
        $catOffice = Category::where('slug', 'office')->first();
        $catLighting = Category::where('slug', 'lighting')->first();
        $catDecor = Category::where('slug', 'decor')->first();

        $products = [
            // --- Lounge & Sofas ---
            [
                'title' => 'Luna Lounge Chair',
                'slug' => 'luna-lounge-chair',
                'category_id' => $catLounge?->id,
                'price' => 499.00,
                'material' => 'White Bouclé & Solid Oak',
                'code' => 'BAC-LC-001',
                'cbm' => '0.51',
                'quantity' => 12,
                'featured_product' => 'Y',
                'image' => 'fur_chair_boucle.png',
                'excerpt' => 'Indulge in organic comfort with solid white oak framework and luxurious bouclé upholstery.',
                'description' => 'The Luna Lounge Chair features an organic silhouette inspired by mid-century Nordic retreats. Supported by a kiln-dried solid European white oak frame with hand-sanded curves and upholstered in plush Italian bouclé fabric. Designed to bring understated elegance and serene warmth to private reading corners or living rooms.',
            ],
            [
                'title' => 'Woven Cane Club Chair',
                'slug' => 'woven-cane-club-chair',
                'category_id' => $catLounge?->id,
                'price' => 590.00,
                'material' => 'Teak & Natural Cane',
                'code' => 'BAC-CC-002',
                'cbm' => '0.60',
                'quantity' => 8,
                'featured_product' => 'Y',
                'image' => 'fur_chair_oak.png',
                'excerpt' => 'Geometric Chandigarh-inspired heritage club chair with hand-woven octagonal rattan cane panels.',
                'description' => 'Meticulously crafted from sustainably seasoned solid Teakwood, this club chair features hand-caned geometric seat and back panels woven in the traditional octagonal mesh pattern. Its distinctive architectural V-legs and ergonomic slope offer timeless aesthetic balance and effortless sitting comfort.',
            ],
            [
                'title' => 'Haven Modular 3-Piece Sectional Sofa',
                'slug' => 'haven-modular-sofa',
                'category_id' => $catLounge?->id,
                'price' => 2450.00,
                'material' => 'Heavy Belgian Linen & Teak',
                'code' => 'BAC-SF-003',
                'cbm' => '1.85',
                'quantity' => 4,
                'featured_product' => 'Y',
                'image' => 'fur_sofa_linen.png',
                'excerpt' => 'Deep-seated modular lounge sofa wrapped in tactile Belgian linen with low-profile timber plinth.',
                'description' => 'Designed for intentional slow living. The Haven Modular Sectional is built around a heavy-duty corner-blocked hardwood frame with down-blend cushions for deep, inviting softness. Removable slipcovers woven from pure washed Belgian linen allow easy dry-cleaning and a relaxed, lived-in drape.',
            ],
            [
                'title' => 'Aura Bouclé Curvature Sofa',
                'slug' => 'aura-boucle-sofa',
                'category_id' => $catLounge?->id,
                'price' => 1890.00,
                'material' => 'Ivory Bouclé Wool',
                'code' => 'BAC-SF-004',
                'cbm' => '1.50',
                'quantity' => 6,
                'featured_product' => 'Y',
                'image' => 'fur_sofa_boucle.png',
                'excerpt' => 'Graceful curved sectional designed to soften rectangular rooms and encourage effortless conversation.',
                'description' => 'A sculptural statement piece with sweeping asymmetrical curves. The Aura sofa transforms living spaces into artistic salons. Dense high-resilience foam core retains its architectural profile, while the tactile wool-blend bouclé upholstery feels comforting to the touch in all seasons.',
            ],
            [
                'title' => 'Verona Saddle Leather Armchair',
                'slug' => 'verona-saddle-leather-armchair',
                'category_id' => $catLounge?->id,
                'price' => 780.00,
                'material' => 'Cognac Aniline Leather & Walnut',
                'code' => 'BAC-LC-005',
                'cbm' => '0.55',
                'quantity' => 7,
                'featured_product' => 'N',
                'image' => 'fur_chair_leather_lounge.png',
                'excerpt' => 'Full-grain vegetable-tanned Italian saddle leather draped over a sculpted American walnut frame.',
                'description' => 'Rich, buttery full-grain leather is sling-mounted with solid brass buckles to an oiled American Walnut frame. Over time, the leather develops a distinguished, rich patina unique to its owner, creating a heirloom lounge chair for modern interiors.',
            ],

            // --- Dining & Stools ---
            [
                'title' => 'Live Edge Acacia Dining Table',
                'slug' => 'live-edge-acacia-dining-table',
                'category_id' => $catDining?->id,
                'price' => 1450.00,
                'material' => 'Solid Acacia Hardwood & Matte Iron',
                'code' => 'BAC-DT-101',
                'cbm' => '0.68',
                'quantity' => 10,
                'featured_product' => 'Y',
                'image' => 'dining-table-liveedge-crossed-leg137.jpg',
                'excerpt' => 'Dramatic organic live-edge timber dining slab supported by heavy architectural matte black crossed iron legs.',
                'description' => 'Each slab is kiln-seasoned for 45 days in our Jodhpur kilns down to 9% moisture content, preserving the natural undulating tree bark contours. Hand-finished with organic beeswax and food-safe matte sealant, seating 8 guests in magnificent natural splendor.',
            ],
            [
                'title' => 'Round Solid Wood Pedestal Dining Table',
                'slug' => 'round-solid-wood-pedestal-dining-table',
                'category_id' => $catDining?->id,
                'price' => 1150.00,
                'material' => 'Seasoned Sheesham Wood',
                'code' => 'BAC-RDT-102',
                'cbm' => '0.58',
                'quantity' => 8,
                'featured_product' => 'Y',
                'image' => 'dining-table-with-round-base123.jpg',
                'excerpt' => 'Circular dining table with central carved fluted column base, seating 6 comfortably with warm satin finish.',
                'description' => 'The circular dining format fosters intimate dinner party dialogue. Hand-turned from sustainably farmed Sheesham wood with subtle quarter-sawn grain patterns and beveled underside edge detail.',
            ],
            [
                'title' => 'Artisan Hand-Carved Dining Chair Set',
                'slug' => 'artisan-hand-carved-dining-chair',
                'category_id' => $catDining?->id,
                'price' => 290.00,
                'material' => 'Solid Oak & Natural Rattan',
                'code' => 'BAC-DC-103',
                'cbm' => '0.24',
                'quantity' => 24,
                'featured_product' => 'N',
                'image' => 'dining-chair-7187.jpg',
                'excerpt' => 'Ergonomically contoured solid wood dining chair featuring high spindle backrest and reinforced joinery.',
                'description' => 'Carved by our master woodworkers with curved back slats designed to support the lower spine through long dinner conversations. Finished with smooth matte lacquer and silent felt floor glides.',
            ],

            // --- Tables & Coffee Tables ---
            [
                'title' => 'Monolith Travertine Low Coffee Table',
                'slug' => 'monolith-travertine-coffee-table',
                'category_id' => $catTables?->id,
                'price' => 890.00,
                'material' => 'Roman Travertine Stone & Oak',
                'code' => 'BAC-CT-201',
                'cbm' => '0.42',
                'quantity' => 9,
                'featured_product' => 'Y',
                'image' => 'fp_table_coffee_travertine.png',
                'excerpt' => 'Substantial honed travertine marble tabletop resting quietly on grounded solid oak cube plinths.',
                'description' => 'Unfilled natural fissures and warm cream striations make each travertine slab truly one-of-a-kind. Polished to a soft satin tactile touch with stain-resistant protective nano-sealant.',
            ],
            [
                'title' => 'Saw-Mark Industrial Live Edge Center Table',
                'slug' => 'saw-mark-industrial-center-table',
                'category_id' => $catTables?->id,
                'price' => 640.00,
                'material' => 'Reclaimed Timber & Iron',
                'code' => 'BAC-CT-202',
                'cbm' => '0.38',
                'quantity' => 11,
                'featured_product' => 'N',
                'image' => 'dining-table-saw-marks-with-iron-legs157.jpg',
                'excerpt' => 'Distressed authentic saw-mark timber table paired with minimal industrial metal base.',
                'description' => 'Celebrating the marks of the sawmill and the natural seasoning checks of historic timber. Hand-rubbed with dark walnut oil to accentuate depth and vintage provenance.',
            ],

            // --- Consoles & Storage ---
            [
                'title' => 'Handcrafted Parquetry 4-Door Sideboard',
                'slug' => 'handcrafted-parquetry-sideboard',
                'category_id' => $catStorage?->id,
                'price' => 1650.00,
                'material' => 'Multi-Tone Hardwood Inlay',
                'code' => 'BAC-SB-301',
                'cbm' => '0.78',
                'quantity' => 5,
                'featured_product' => 'Y',
                'image' => 'parquetry-side-board172.jpg',
                'excerpt' => 'Artisanal geometric parquetry wood inlay credenza featuring four soft-close push doors.',
                'description' => 'Hundreds of individually cut solid timber tiles arranged in a stunning chevron parquetry pattern. Interior features modular adjustable shelves and cable management slots for media equipment.',
            ],
            [
                'title' => 'Fluted Glass Minimalist Storage Credenza',
                'slug' => 'fluted-glass-storage-credenza',
                'category_id' => $catStorage?->id,
                'price' => 1350.00,
                'material' => 'Fluted Glass & Sheesham Wood',
                'code' => 'BAC-SB-302',
                'cbm' => '0.72',
                'quantity' => 7,
                'featured_product' => 'Y',
                'image' => 'glass-side-board102.jpg',
                'excerpt' => 'Reed fluted glass panels diffuse interior contents while antique brass pulls complete the silhouette.',
                'description' => 'A seamless dialogue of transparent lightness and dark solid hardwood mass. Ideal as a dining room buffet, living room display credenza, or entryway console.',
            ],
            [
                'title' => 'Rustic Media & Plasma TV Credenza Cabinet',
                'slug' => 'rustic-media-plasma-cabinet',
                'category_id' => $catStorage?->id,
                'price' => 1120.00,
                'material' => 'Solid Acacia Hardwood',
                'code' => 'BAC-SB-303',
                'cbm' => '0.65',
                'quantity' => 8,
                'featured_product' => 'N',
                'image' => 'plasma-cabinet-1162.jpg',
                'excerpt' => 'Low-profile media entertainment console with cable management ports and soft-closing storage.',
                'description' => 'Engineered for modern high-definition living rooms. Offers ventilated back access panels for soundbars and electronics, complemented by warm rustic honey wood grain.',
            ],

            // --- Solid Wood Beds ---
            [
                'title' => 'Nordic Spindle Solid Oak Bed Frame',
                'slug' => 'nordic-spindle-solid-oak-bed',
                'category_id' => $catBedroom?->id,
                'price' => 1550.00,
                'material' => 'European White Oak',
                'code' => 'BAC-BD-401',
                'cbm' => '0.95',
                'quantity' => 6,
                'featured_product' => 'Y',
                'image' => 'fur_prod_bed_oak.png',
                'excerpt' => 'Minimalist platform bed frame with rhythmic turned spindle headboard and floating base.',
                'description' => 'Precision mortise and tenon joinery ensures total silence and structural rigidity for decades. The floating perimeter base gives the bed an airy, cloud-like presence in light-filled master suites.',
            ],
            [
                'title' => 'Floating Cantilever Bedside Nightstand',
                'slug' => 'floating-bedside-nightstand',
                'category_id' => $catBedroom?->id,
                'price' => 320.00,
                'material' => 'White Oak & Soft-Close Hardware',
                'code' => 'BAC-NS-402',
                'cbm' => '0.15',
                'quantity' => 14,
                'featured_product' => 'N',
                'image' => 'fur_prod_nightstand.png',
                'excerpt' => 'Clean floating nightstand with concealed finger-pull drawer for bedside essentials.',
                'description' => 'Wall-mount or floor-stand cantilever design with seamless 45-degree mitered edges and velvet-lined drawer base.',
            ],

            // --- Office Chairs & Desks ---
            [
                'title' => 'Architectural Executive Writing Desk',
                'slug' => 'architectural-executive-desk',
                'category_id' => $catOffice?->id,
                'price' => 1290.00,
                'material' => 'Solid American Walnut & Leather Inlay',
                'code' => 'BAC-DK-501',
                'cbm' => '0.75',
                'quantity' => 5,
                'featured_product' => 'Y',
                'image' => 'fur_prod_desk.png',
                'excerpt' => 'Commanding workspace centerpiece with integrated leather blotter and concealed cable raceways.',
                'description' => 'Designed for deep work. Offers two wide stationery drawers lined in green baize cloth, brass grommets for discrete laptop power management, and warm walnut touch surfaces.',
            ],
            [
                'title' => 'Mid-Century Teak Open Display Bookshelf',
                'slug' => 'mid-century-teak-display-bookshelf',
                'category_id' => $catOffice?->id,
                'price' => 980.00,
                'material' => 'Solid Teak Hardwood',
                'code' => 'BAC-BS-502',
                'cbm' => '0.80',
                'quantity' => 7,
                'featured_product' => 'N',
                'image' => 'bookshelf188.jpg',
                'excerpt' => 'Asymmetrical multi-tier open shelving unit designed for books, art objects, and studio displays.',
                'description' => 'Solid vertical stiles support varied horizontal bays, creating rhythmic visual interest for home libraries, design offices, and boutique showrooms.',
            ],

            // --- Designer Lighting ---
            [
                'title' => 'Japandi Rice Paper Pendant Lantern',
                'slug' => 'japandi-rice-paper-lantern',
                'category_id' => $catLighting?->id,
                'price' => 189.00,
                'material' => 'Handmade Washi Paper & Bamboo',
                'code' => 'BAC-LT-601',
                'cbm' => '0.12',
                'quantity' => 20,
                'featured_product' => 'Y',
                'image' => 'fur_new_lantern.png',
                'excerpt' => 'A harmonious blend of Japanese minimalism and warm diffused ambient illumination.',
                'description' => 'Hand-folded from artisanal Mulberry washi paper stretched over a steam-bent bamboo skeleton. Emits a soft, non-glare halo of warm light that elevates dining and lounge atmospheres.',
            ],
            [
                'title' => 'Hand-Thrown Ceramic Sculptural Table Lamp',
                'slug' => 'hand-thrown-ceramic-table-lamp',
                'category_id' => $catLighting?->id,
                'price' => 129.00,
                'material' => 'Unglazed Terracotta & Linen Shade',
                'code' => 'BAC-LT-602',
                'cbm' => '0.09',
                'quantity' => 18,
                'featured_product' => 'Y',
                'image' => 'fur_new_lamp.png',
                'excerpt' => 'Textured chalky ceramic stoneware base paired with a textured oatmeal linen drum shade.',
                'description' => 'Handcrafted on the potter\'s wheel in small batches with organic tactile texture. Fitted with a twisted jute electrical cord and inline dimmer switch.',
            ],

            // --- Aesthetic Decor ---
            [
                'title' => 'Woven Accent Vases & Vessel Duo',
                'slug' => 'woven-accent-vases-duo',
                'category_id' => $catDecor?->id,
                'price' => 79.00,
                'material' => 'Natural Seagrass & Matte Ceramic',
                'code' => 'BAC-DC-701',
                'cbm' => '0.05',
                'quantity' => 30,
                'featured_product' => 'Y',
                'image' => 'fur_new_vases.png',
                'excerpt' => 'Pair of tactile tabletop vessels combining raw unglazed stoneware with woven fibers.',
                'description' => 'Ideal for dried botanicals, pampas grass, or standing alone as sculptural mantelpiece silhouettes.',
            ],
            [
                'title' => 'Sculpted Solid Stone Specimen Bowl',
                'slug' => 'sculpted-stone-specimen-bowl',
                'category_id' => $catDecor?->id,
                'price' => 145.00,
                'material' => 'Honed Sandstone',
                'code' => 'BAC-DC-702',
                'cbm' => '0.04',
                'quantity' => 15,
                'featured_product' => 'N',
                'image' => 'fur_prod_vase.png',
                'excerpt' => 'Heavy carved stone centerpiece bowl celebrating geological strata and raw textures.',
                'description' => 'Chiseled by heritage stone artisans from local Rajasthan sandstone quarries, perfect as a coffee table focal point or entryway catch-all.',
            ],
        ];

        $finishes = Finish::all();
        $woods = Wood::all();

        foreach ($products as $idx => $p) {
            $product = Product::updateOrCreate(
                ['slug' => $p['slug']],
                $p
            );

            if ($finishes->isNotEmpty()) {
                $product->finish_id = $finishes[$idx % $finishes->count()]->id;
            }
            if ($woods->isNotEmpty()) {
                $product->wood_id = $woods[$idx % $woods->count()]->id;
            }
            $product->save();

            if ($product->images()->count() === 0 && !empty($product->image)) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $product->image,
                    'sort_order' => 1,
                ]);

                $secondaryImages = ['fur_chair_oak.png', 'fur_chair_boucle.png', 'fp_table_oak_round.png', 'fur_new_sideboard.png', 'fur_sofa_linen.png'];
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $secondaryImages[$idx % count($secondaryImages)],
                    'sort_order' => 2,
                ]);
            }
        }
    }
}

