<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuotationModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->admin = Admin::where('email', 'admin@admin.com')->first();
        if (!$this->admin) {
            $this->admin = Admin::create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin1234'),
            ]);
        }
    }

    /**
     * Test admin can access quotation index and create pages.
     */
    public function test_admin_can_access_quotation_index_and_create(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get('/admin/quotation');
        $response->assertStatus(200);
        $response->assertSee('Quotations Management');
        $response->assertSee('Create Quotation');

        $createResponse = $this->actingAs($this->admin, 'admin')->get('/admin/quotation/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Customer Selection');
        $createResponse->assertSee('Select Registered User');
        $createResponse->assertSee('New Customer');
        $createResponse->assertSee('Selected Quotation Products');
    }

    /**
     * Test admin can create quotation with multiple products and auto-fetched fields.
     */
    public function test_admin_can_create_quotation_with_multiple_products(): void
    {
        $user = User::first();
        $product1 = Product::first();
        $product2 = Product::skip(1)->first() ?? $product1;

        $payload = [
            'quotation_no' => 'QT-2026-TEST01',
            'user_id' => $user ? $user->id : null,
            'customer_name' => 'Lord Harrison Finch',
            'customer_email' => 'harrison@finchinteriors.co.uk',
            'customer_phone' => '+44 20 7946 0912',
            'customer_company' => 'Finch Architectural Interiors',
            'customer_address' => '42 Kensington High St, London W8 4SG, United Kingdom',
            'date' => '2026-11-07',
            'valid_until' => '2026-12-07',
            'title' => 'Luxury Villa Bespoke Furniture Quotation',
            'company_name' => 'Bharat Art & Craft',
            'status' => 'draft',
            'currency' => 'USD',
            'items' => [
                [
                    'product_id' => $product1->id,
                    'product_name' => $product1->title,
                    'product_code' => $product1->code ?? 'BAC-001',
                    'material' => 'Solid Teak Wood (Sagwan)',
                    'dimension' => '200 x 100 x 78 cm',
                    'finish' => 'Natural Honey Matte Wax',
                    'moq' => 10,
                    'price_usd' => 550.00,
                    'cbm' => 0.520,
                    'loadability' => "130 pcs / 40' HC",
                ],
                [
                    'product_id' => $product2->id,
                    'product_name' => $product2->title,
                    'product_code' => $product2->code ?? 'BAC-002',
                    'material' => 'Indian Rosewood (Sheesham)',
                    'dimension' => '160 x 45 x 85 cm',
                    'finish' => 'Dark Walnut Oil Polish',
                    'moq' => 5,
                    'price_usd' => 780.00,
                    'cbm' => 0.650,
                    'loadability' => "104 pcs / 40' HC",
                ],
            ],
        ];

        $response = $this->actingAs($this->admin, 'admin')->post('/admin/quotation', $payload);

        $quotation = Quotation::where('quotation_no', 'QT-2026-TEST01')->first();
        $this->assertNotNull($quotation);
        $response->assertRedirect(route('admin.quotation.show', $quotation->id));

        $this->assertEquals('Lord Harrison Finch', $quotation->customer_name);
        $this->assertEquals('Finch Architectural Interiors', $quotation->customer_company);
        $this->assertEquals(2, $quotation->items()->count());

        // Check calculated total amount: (10 * 550) + (5 * 780) = 5500 + 3900 = 9400
        $this->assertEquals(9400.00, (float)$quotation->total_amount);
        // Check calculated total CBM: (10 * 0.520) + (5 * 0.650) = 5.2 + 3.25 = 8.45 CBM
        $this->assertEquals(8.45, (float)$quotation->total_cbm);
    }

    /**
     * Test quotation print format meets exact specifications:
     * - Page 1: Title & Company
     * - Multiple Product Pages (1 page for 1 product): Left Side Main Image, Right Side Product Name & Details Table
     */
    public function test_quotation_print_format_renders_correctly(): void
    {
        $product = Product::first();

        $quotation = Quotation::create([
            'quotation_no' => 'QT-PRINT-001',
            'customer_name' => 'Evelyn Montgomery',
            'customer_email' => 'evelyn@montgomery.com',
            'customer_company' => 'Montgomery Living Inc.',
            'title' => 'Bespoke Solid Wood Catalog Presentation',
            'company_name' => 'Bharat Art & Craft',
            'date' => '2026-11-07',
            'valid_until' => '2026-12-07',
            'status' => 'draft',
            'currency' => 'USD',
        ]);

        $item1 = $quotation->items()->create([
            'product_id' => $product->id,
            'product_name' => 'Royal Carved Sideboard',
            'product_code' => 'BAC-SB-09',
            'material' => 'Solid Teak Wood',
            'dimension' => '180 x 48 x 90 cm',
            'finish' => 'Aged Honey Wax',
            'moq' => 8,
            'price_usd' => 890.00,
            'cbm' => 0.780,
            'loadability' => "87 pcs / 40' HC",
        ]);

        $item2 = $quotation->items()->create([
            'product_id' => $product->id,
            'product_name' => 'Nordic Oval Coffee Table',
            'product_code' => 'BAC-CT-12',
            'material' => 'European White Oak',
            'dimension' => '120 x 60 x 42 cm',
            'finish' => 'Raw Matte Natural Oil',
            'moq' => 15,
            'price_usd' => 320.00,
            'cbm' => 0.310,
            'loadability' => "219 pcs / 40' HC",
        ]);

        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.quotation.print', $quotation->id));
        $response->assertStatus(200);

        // Landscape orientation assertions
        $response->assertSee('size: A4 landscape', false);
        $response->assertSee('A4 Landscape');

        // Page 1 Cover Page enhancements assertions
        $response->assertSee('Bharat Art &amp; Craft', false);
        $response->assertSee('Bespoke Solid Wood Catalog Presentation', false);
        $response->assertSee('Handcrafted Heritage Export Proposal');
        $response->assertSee('QT-PRINT-001');
        $response->assertSee('Evelyn Montgomery');
        $response->assertSee('Montgomery Living Inc.');

        // Product specification table solid dark column border assertions
        $response->assertSee('border-right: 2px solid #24201c', false);
        $response->assertSee('border: 2px solid #24201c', false);

        // Product pages assertions (1 page for 1 product with details table)
        $response->assertSee('Royal Carved Sideboard');
        $response->assertSee('BAC-SB-09');
        $response->assertSee('Solid Teak Wood');
        $response->assertSee('180 x 48 x 90 cm');
        $response->assertSee('Aged Honey Wax');
        $response->assertSee('8 pcs');
        $response->assertSee('$890.00 / pc');
        $response->assertSee('0.780 m³');
        $response->assertSee("87 pcs / 40' HC");

        // Second product on its own page
        $response->assertSee('Nordic Oval Coffee Table');
        $response->assertSee('BAC-CT-12');
        $response->assertSee('European White Oak');
        $response->assertSee('120 x 60 x 42 cm');
        $response->assertSee('219 pcs');

        // Last page: Thank you page assertions
        $response->assertSee('Thank You');
        $response->assertSee('Contact Us');
        $response->assertSee('exports@bharatartandcraft.com');
        $response->assertSee('+91 98290 12345');
        $response->assertSee('Industrial Area, Phase II, Basni, Jodhpur, Rajasthan, India - 342005');
        // Total 4 pages (1 cover, 2 products, 1 thank you)
        $response->assertSee('Page 4 of 4');
    }

    /**
     * Test order row button to create quotation pre-fills order details.
     */
    public function test_order_row_button_links_and_prefills_quotation(): void
    {
        $order = Order::create([
            'name' => 'Vikram Singhania',
            'email' => 'vikram@singhania.com',
            'phone' => '+91 99887 76655',
            'message' => "=== CATALOG FURNITURE ENQUIRY ===\n\nName: Vikram Singhania\nCompany Name: Singhania Heritage\nAddress: 12 Palace Road, Jodhpur",
        ]);

        // Verify order index has the Quote button
        $indexResponse = $this->actingAs($this->admin, 'admin')->get(route('admin.order.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee(route('admin.quotation.create', ['order_id' => $order->id]));
        $indexResponse->assertSee('Quote');

        // Verify clicking create quotation pre-fills customer information
        $createResponse = $this->actingAs($this->admin, 'admin')->get(route('admin.quotation.create', ['order_id' => $order->id]));
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Vikram Singhania');
        $createResponse->assertSee('vikram@singhania.com');
        $createResponse->assertSee('+91 99887 76655');
        $createResponse->assertSee('Singhania Heritage');
    }
}
