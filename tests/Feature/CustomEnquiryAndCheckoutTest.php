<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Finish;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wood;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomEnquiryAndCheckoutTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * Test customized enquiry submission with the 6 fields and image upload converted to WebP.
     */
    public function test_customized_enquiry_form_submission_with_6_fields_and_webp_image(): void
    {
        Storage::fake('public');

        // Create a fake test image (PNG)
        $image = UploadedFile::fake()->image('custom_table_sketch.png', 800, 600);

        $payload = [
            'name' => 'Aditya Sharma',
            'email' => 'aditya@example.com',
            'phone' => '+91 98765 43210',
            'dimension' => '72"L x 36"W x 30"H',
            'specification' => 'Custom solid teak dining table with natural beeswax finish and fluted cylindrical legs.',
            'design_file' => $image,
        ];

        $response = $this->postJson('/consultation-submit', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('orders', [
            'name' => 'Aditya Sharma',
            'email' => 'aditya@example.com',
            'phone' => '+91 98765 43210',
        ]);

        $order = Order::where('email', 'aditya@example.com')->latest()->first();
        $this->assertNotNull($order);
        $this->assertStringContainsString('72"L x 36"W x 30"H', $order->message);
        $this->assertStringContainsString('fluted cylindrical legs', $order->message);
        // Design file should be converted/saved as WebP
        $this->assertStringContainsString('.webp', $order->message);
    }

    /**
     * Test customized enquiry with base64 encoded image (client-side canvas WebP).
     */
    public function test_customized_enquiry_with_base64_webp(): void
    {
        // 1x1 transparent PNG base64
        $base64Png = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';

        $payload = [
            'name' => 'Priya Sen',
            'email' => 'priya@example.com',
            'phone' => '+91 91234 56789',
            'dimension' => 'King Bed (78" x 72")',
            'specification' => 'Bespoke Sheesham wood bed with cane headboard.',
            'design_image_base64' => $base64Png,
        ];

        $response = $this->postJson('/consultation-submit', $payload);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $order = Order::where('email', 'priya@example.com')->latest()->first();
        $this->assertNotNull($order);
        $this->assertStringContainsString('King Bed (78" x 72")', $order->message);
        $this->assertStringContainsString('.webp', $order->message);
    }

    /**
     * Test checkout page renders left side with 9 fields and right side with cart items.
     */
    public function test_checkout_page_renders_with_9_fields_and_cart_items(): void
    {
        $product = Product::first();
        if (!$product) {
            $product = new Product();
            $product->title = 'Artisan Credenza';
            $product->slug = 'artisan-credenza';
            $product->code = 'BAC-CRD-01';
            $product->price = 1250;
            $product->cbm = '0.85';
            $product->status = 'active';
            $product->save();
        }

        // Place item in session quote_cart
        $cart = [
            $product->id => [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'code' => $product->code ?: 'BAC-CODE-99',
                'price' => 1250,
                'cbm' => '0.85',
                'quantity' => 2,
                'wood' => 'Solid Teak',
                'finish' => 'Natural Honey',
                'image' => '/assets/img/fur_new_sideboard.png',
            ]
        ];

        $response = $this->withSession(['quote_cart' => $cart])->get('/checkout');
        $response->assertStatus(200);

        // Verify the 9 fields are present
        $response->assertSee('name="name"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="phone"', false);
        $response->assertSee('name="company"', false);
        $response->assertSee('name="address"', false);
        $response->assertSee('name="city"', false);
        $response->assertSee('name="state"', false);
        $response->assertSee('name="pincode"', false);
        $response->assertSee('name="country"', false);

        // Verify cart piece details in right side
        $response->assertSee($product->title);
        $response->assertSee('Solid Teak');
        $response->assertSee('Natural Honey');
        $response->assertSee('Qty: 2');
        $response->assertSee('1.7 CBM');
    }

    /**
     * Test checkout submission saves order with the 9 fields and cart details, and clears session cart.
     */
    public function test_checkout_submission_creates_order_and_clears_cart(): void
    {
        $cart = [
            101 => [
                'id' => 101,
                'title' => 'Heritage Mandir Temple',
                'code' => 'BAC-TMP-01',
                'price' => 2400,
                'cbm' => '1.20',
                'quantity' => 1,
                'wood' => 'Solid Teak',
                'finish' => 'Aged Honey Wax',
            ]
        ];

        $payload = [
            'name' => 'Vikram Singhania',
            'email' => 'vikram@singhania.com',
            'phone' => '+91 99887 76655',
            'company' => 'Singhania Heritage Homes',
            'address' => 'Villa 14, Royal Palm Estates, Jodhpur Bypass',
            'city' => 'Jodhpur',
            'state' => 'Rajasthan',
            'pincode' => '342001',
            'country' => 'India',
        ];

        $response = $this->withSession(['quote_cart' => $cart])
                         ->postJson('/checkout-submit', $payload);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('orders', [
            'name' => 'Vikram Singhania',
            'email' => 'vikram@singhania.com',
            'phone' => '+91 99887 76655',
        ]);

        $order = Order::where('email', 'vikram@singhania.com')->latest()->first();
        $this->assertNotNull($order);
        $this->assertStringContainsString('Singhania Heritage Homes', $order->message);
        $this->assertStringContainsString('Villa 14, Royal Palm Estates', $order->message);
        $this->assertStringContainsString('Jodhpur', $order->message);
        $this->assertStringContainsString('Rajasthan', $order->message);
        $this->assertStringContainsString('342001', $order->message);
        $this->assertStringContainsString('India', $order->message);
        $this->assertStringContainsString('Heritage Mandir Temple', $order->message);
        $this->assertStringContainsString('BAC-TMP-01', $order->message);
        $this->assertStringContainsString('1.2 CBM', $order->message);

        // Verify session cart was cleared
        $this->assertEmpty(session('quote_cart', []));
    }
}
