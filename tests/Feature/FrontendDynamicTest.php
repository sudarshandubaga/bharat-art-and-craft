<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FrontendDynamicTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test homepage loads dynamic data from database.
     */
    public function test_homepage_renders_dynamic_data(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Check slider content
        $slider = Slider::latest()->first();
        if ($slider) {
            $response->assertSee($slider->title, false);
        }

        // Check dynamic product from seed
        $product = Product::where('slug', 'luna-lounge-chair')->first();
        $this->assertNotNull($product);
        $response->assertSee('Luna Lounge Chair', false);

        // Check dynamic category from seed
        $category = Category::where('slug', 'lounge')->first();
        $this->assertNotNull($category);
        $response->assertSee('Lounge', false);

        // Check testimonial from seed
        $testimonial = Testimonial::first();
        if ($testimonial) {
            $response->assertSee($testimonial->name, false);
        }

        // Check blog title from seed
        $blog = Blog::first();
        if ($blog) {
            $response->assertSee($blog->title, false);
        }
    }

    /**
     * Test shop page renders dynamic products and category filters.
     */
    public function test_shop_page_renders_dynamic_catalog(): void
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);

        // Categories present in sidebar
        $response->assertSee('Lounge', false);
        $response->assertSee('Dining', false);

        // Filter by category
        $filterResponse = $this->get('/shop?category=lounge');
        $filterResponse->assertStatus(200);
        $filterResponse->assertSee('Luna Lounge Chair', false);

        // Search query
        $searchResponse = $this->get('/shop?search=Boucl');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Luna Lounge Chair', false);
    }

    /**
     * Test product detail page renders dynamic attributes, CBM, and Add to Quote.
     */
    public function test_product_detail_page_renders_dynamic_attributes(): void
    {
        $product = Product::where('slug', 'luna-lounge-chair')->first();
        $this->assertNotNull($product);

        $response = $this->get('/product/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->title, false);
        $response->assertSee($product->code, false);
        $response->assertSee('Add to Quote', false);
        $response->assertSee('CBM', false);
        $response->assertDontSee('₹' . number_format($product->price, 0), false);
    }

    /**
     * Test price is removed from website and CBM is used for quotes.
     */
    public function test_price_removed_from_website_and_cbm_used(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        // Homepage product cards display CBM and Add to Quote
        $homeRes = $this->get('/');
        $homeRes->assertStatus(200);
        $homeRes->assertSee('CBM', false);
        $homeRes->assertSee('Add to Quote', false);
        $homeRes->assertDontSee('₹28,500', false);

        // Shop page displays CBM and Add to Quote
        $shopRes = $this->get('/shop');
        $shopRes->assertStatus(200);
        $shopRes->assertSee('CBM', false);
        $shopRes->assertSee('Add to Quote', false);

        // Product detail page displays CBM and Add to Quote
        $prodRes = $this->get('/product/' . $product->slug);
        $prodRes->assertStatus(200);
        $prodRes->assertSee('CBM', false);
        $prodRes->assertSee('Add to Quote', false);
        $prodRes->assertDontSee('₹' . number_format($product->price, 0), false);
    }

    /**
     * Test blog index and post render dynamic content.
     */
    public function test_blog_renders_dynamic_posts(): void
    {
        $blog = Blog::latest()->first();
        $this->assertNotNull($blog);

        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee($blog->title, false);

        $postResponse = $this->get('/blog/post/' . $blog->slug);
        $postResponse->assertStatus(200);
        $postResponse->assertSee($blog->title, false);
    }

    /**
     * Test FAQ page renders dynamic items and layout.
     */
    public function test_faq_page_renders_dynamic_faqs(): void
    {
        $faq = Faq::first();
        $this->assertNotNull($faq);

        $response = $this->get('/faqs');
        $response->assertStatus(200);
        $response->assertSee($faq->title, false);
        $response->assertSee('fur-header', false);
        $response->assertSee('tft-cnt-page', false);
        $response->assertDontSee('tft-cnt-container', false);
    }

    /**
     * Test website header category dropdown renders single-level flat categories.
     */
    public function test_header_category_dropdown_renders_flat_categories(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('All Furniture Categories', false);
        $response->assertDontSee('Seating &amp; Bed Frames', false);
        $response->assertDontSee('Dining &amp; Surfaces', false);
        $response->assertDontSee('Lighting &amp; Accents', false);
    }

    /**
     * Test contact form submission creates an enquiry order.
     */
    public function test_contact_submission_creates_order(): void
    {
        $data = [
            'name' => 'Aarav Sharma',
            'email' => 'aarav@example.com',
            'phone' => '+91-9876543210',
            'subject' => 'Custom Dining Table Request',
            'message' => 'Interested in bespoke 8-seater dining table with brass inlay.',
        ];

        $response = $this->post('/contact', $data);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'name' => 'Aarav Sharma',
            'email' => 'aarav@example.com',
        ]);
    }

    /**
     * Test consultation form submission creates a detailed custom order.
     */
    public function test_consultation_submission_creates_detailed_order(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('blueprint.pdf', 100);

        $data = [
            'client_name' => 'Meera Patel',
            'client_email' => 'meera@example.com',
            'client_phone' => '+91-9811122233',
            'project_type' => 'Full Villa Custom Furniture',
            'wood_species' => 'Solid Teak',
            'target_completion' => 'Q4 2026',
            'custom_dimensions' => 'Living Room: 24ft x 18ft',
            'client_notes' => 'Need Scandinavian minimalist look with natural wax finish.',
            'design_files' => [$file],
        ];

        $response = $this->post('/consultation', $data);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'name' => 'Meera Patel',
            'email' => 'meera@example.com',
        ]);

        $order = Order::where('email', 'meera@example.com')->first();
        $this->assertStringContainsString('Solid Teak', $order->message);
        $this->assertStringContainsString('Full Villa Custom Furniture', $order->message);
    }

    /**
     * Test newsletter subscription saves subscriber email.
     */
    public function test_newsletter_subscription(): void
    {
        $response = $this->post('/newsletter', [
            'email' => 'subscriber@studio.design',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('newsletters', [
            'email' => 'subscriber@studio.design',
        ]);
    }

    /**
     * Test SEO friendly category URL loads category products with proper title.
     */
    public function test_seo_friendly_category_url(): void
    {
        $response = $this->get('/category/lounge');
        $response->assertStatus(200);
        $response->assertSee('Luna Lounge Chair', false);
        $response->assertSee('Lounge &amp; Sofas', false);

        // Test multi-level legacy category redirect
        $legacyRedirect = $this->get('/category/lounge/chairs');
        $legacyRedirect->assertRedirect('/category/lounge');
    }

    /**
     * Test SEO friendly blog and dynamic CMS pages load cleanly.
     */
    public function test_seo_friendly_blog_and_cms_pages(): void
    {
        $blog = Blog::first();
        $this->assertNotNull($blog);

        // Clean SEO URL /blog/{slug}
        $blogResponse = $this->get('/blog/' . $blog->slug);
        $blogResponse->assertStatus(200);
        $blogResponse->assertSee($blog->title, false);

        // Clean CMS pages /page/{slug}
        $termsResponse = $this->get('/page/terms-of-use');
        $termsResponse->assertStatus(200);
        $termsResponse->assertSee('Terms of Use', false);

        $privacyResponse = $this->get('/page/privacy-policy');
        $privacyResponse->assertStatus(200);
        $privacyResponse->assertSee('Privacy Policy', false);
    }

    /**
     * Test subcategories are removed from database and admin forms.
     */
    public function test_subcategories_removed_from_database_and_admin(): void
    {
        // Database has only parent categories
        $this->assertEquals(8, Category::count());
        $this->assertEquals(0, Category::whereNotNull('category_id')->count());

        // Admin forms do not have subcategory controls
        $admin = \App\Models\Admin::first();
        $this->assertNotNull($admin);

        $catCreate = $this->actingAs($admin, 'admin')->get('/admin/category/create');
        $catCreate->assertStatus(200);
        $catCreate->assertDontSee('Parent Category', false);

        $prodCreate = $this->actingAs($admin, 'admin')->get('/admin/product/create');
        $prodCreate->assertStatus(200);
        $prodCreate->assertDontSee('Subcategory', false);
        $prodCreate->assertDontSee('get-subcategory', false);
    }

    /**
     * Test quote cart AJAX endpoints (add, update, remove, clear, items).
     */
    public function test_quote_cart_ajax_operations(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        // 1. Initially empty cart items
        $itemsResponse = $this->getJson('/quote/items');
        $itemsResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'cart_count' => 0,
                'items' => [],
            ]);

        // 2. Add product to quote cart via AJAX
        $addResponse = $this->postJson('/quote/add', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $addResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'cart_count' => 2,
            ]);

        $this->assertTrue(session()->has('quote_cart'));
        $cart = session()->get('quote_cart');
        $this->assertArrayHasKey($product->id, $cart);
        $this->assertEquals(2, $cart[$product->id]['quantity']);

        // 3. Update quantity via AJAX
        $updateResponse = $this->postJson('/quote/update', [
            'product_id' => $product->id,
            'quantity' => 5,
        ]);

        $updateResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'cart_count' => 5,
            ]);

        // 4. Remove item via AJAX
        $removeResponse = $this->postJson('/quote/remove', [
            'product_id' => $product->id,
        ]);

        $removeResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'cart_count' => 0,
            ]);

        // 5. Clear cart via AJAX
        $this->postJson('/quote/add', ['product_id' => $product->id, 'quantity' => 1]);
        $clearResponse = $this->postJson('/quote/clear');
        $clearResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'cart_count' => 0,
            ]);
    }

    /**
     * Test live search autocomplete API and search filtering on shop catalog.
     */
    public function test_search_autocomplete_and_catalog_filtering(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);
        $category = Category::first();
        $this->assertNotNull($category);

        // 1. Autocomplete query for category/product
        $queryWord = substr($product->title, 0, 4);
        $autocompleteResponse = $this->getJson('/search/autocomplete?q=' . urlencode($queryWord));
        $autocompleteResponse->assertStatus(200)
            ->assertJsonStructure([
                'query',
                'categories',
                'products',
                'categories_count',
                'products_count',
                'has_results',
            ]);

        $this->assertEquals($queryWord, $autocompleteResponse->json('query'));

        // 2. Autocomplete empty query returns empty results
        $emptyQueryResponse = $this->getJson('/search/autocomplete?q=');
        $emptyQueryResponse->assertStatus(200)
            ->assertJson([
                'categories' => [],
                'products' => [],
                'has_results' => false,
            ]);

        // 3. Autocomplete nonexistent query returns empty results
        $noMatchResponse = $this->getJson('/search/autocomplete?q=xyznonexistentterm123');
        $noMatchResponse->assertStatus(200)
            ->assertJson([
                'categories' => [],
                'products' => [],
                'has_results' => false,
            ]);

        // 4. Shop page search filtering with ?s= query parameter
        $shopSearchResponse = $this->get('/shop?s=' . urlencode($product->title));
        $shopSearchResponse->assertStatus(200);
        $shopSearchResponse->assertSee($product->title, false);
    }
}

