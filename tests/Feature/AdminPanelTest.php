<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Bharat Art & Craft', false);
        $response->assertSee('Sign In', false);
    }

    public function test_unauthenticated_admin_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_login_with_valid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin1234',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated('admin');
    }

    public function test_authenticated_admin_can_access_all_panel_sections(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();
        $this->assertNotNull($admin);

        $sections = [
            '/admin',
            '/admin/product',
            '/admin/product/create',
            '/admin/category',
            '/admin/category/create',
            '/admin/finish',
            '/admin/finish/create',
            '/admin/wood',
            '/admin/wood/create',
            '/admin/slider',
            '/admin/slider/create',
            '/admin/blog',
            '/admin/blog/create',
            '/admin/page',
            '/admin/page/create',
            '/admin/user',
            '/admin/user/create',
            '/admin/faq',
            '/admin/faq/create',
            '/admin/testimonial',
            '/admin/testimonial/create',
            '/admin/newsletter',
            '/admin/order',
            '/admin/site/1/edit',
            '/admin/changepassword',
        ];

        foreach ($sections as $section) {
            $response = $this->actingAs($admin, 'admin')->get($section);
            $response->assertStatus(200);
            $response->assertSee('Bharat Art & Craft', false);
        }
    }

    public function test_admin_aliases_redirect(): void
    {
        $response = $this->get('/stage-admin');
        $response->assertRedirect(route('admin.dashboard'));

        $response = $this->get('/bharat-admin');
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_logout(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();
        $response = $this->actingAs($admin, 'admin')->get('/admin/logout');
        $response->assertRedirect(route('admin.login'));
        $this->assertGuest('admin');
    }

    public function test_productdetail_and_legacy_admin_routes_exist(): void
    {
        $this->assertNotEmpty(route('productdetail', ['luna-lounge-chair']));
        $this->assertNotEmpty(route('product', ['lounge']));

        $response = $this->get(route('productdetail', ['luna-lounge-chair']));
        $response->assertStatus(200);

        $catResponse = $this->get(route('product', ['lounge']));
        $catResponse->assertStatus(200);
        $catResponse->assertSee('Lounge', false);
    }

    public function test_finish_crud(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();

        // 1. Create Finish
        $createRes = $this->actingAs($admin, 'admin')->post('/admin/finish', [
            'name' => 'Antique Charcoal Wax',
        ]);
        $createRes->assertRedirect(route('admin.finish.index'));
        $this->assertDatabaseHas('finishes', ['name' => 'Antique Charcoal Wax']);

        $finish = \App\Models\Finish::where('name', 'Antique Charcoal Wax')->first();
        $this->assertNotNull($finish);

        // 2. Edit Finish
        $updateRes = $this->actingAs($admin, 'admin')->put('/admin/finish/' . $finish->id, [
            'name' => 'Antique Charcoal Wax Updated',
        ]);
        $updateRes->assertRedirect(route('admin.finish.index'));
        $this->assertDatabaseHas('finishes', ['name' => 'Antique Charcoal Wax Updated']);

        // 3. Delete Finish (Soft delete)
        $delRes = $this->actingAs($admin, 'admin')->delete('/admin/finish/' . $finish->id);
        $this->assertSoftDeleted('finishes', ['id' => $finish->id]);
    }

    public function test_wood_crud(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();

        // 1. Create Wood
        $createRes = $this->actingAs($admin, 'admin')->post('/admin/wood', [
            'name' => 'Royal Jodhpur Teak',
        ]);
        $createRes->assertRedirect(route('admin.wood.index'));
        $this->assertDatabaseHas('woods', ['name' => 'Royal Jodhpur Teak']);

        $wood = \App\Models\Wood::where('name', 'Royal Jodhpur Teak')->first();
        $this->assertNotNull($wood);

        // 2. Edit Wood
        $updateRes = $this->actingAs($admin, 'admin')->put('/admin/wood/' . $wood->id, [
            'name' => 'Royal Jodhpur Teak Seasoned',
        ]);
        $updateRes->assertRedirect(route('admin.wood.index'));
        $this->assertDatabaseHas('woods', ['name' => 'Royal Jodhpur Teak Seasoned']);

        // 3. Delete Wood
        $delRes = $this->actingAs($admin, 'admin')->delete('/admin/wood/' . $wood->id);
        $this->assertSoftDeleted('woods', ['id' => $wood->id]);
    }

    public function test_category_seo_and_description_saving(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();

        $response = $this->actingAs($admin, 'admin')->post('/admin/category', [
            'title' => 'Carved Architectural Screens',
            'description' => 'Traditional handcrafted jali panels and architectural room dividers.',
            'seo_title' => 'Handcrafted Carved Screens & Jali Dividers | Bharat Art & Craft',
            'seo_keywords' => 'carved screens, jali dividers, solid wood partitions, jodhpur handicrafts',
            'seo_description' => 'Explore authentic hand-carved solid wood architectural screens from Bharat Art & Craft.',
        ]);

        $response->assertRedirect(route('admin.category.index'));
        $this->assertDatabaseHas('categories', [
            'title' => 'Carved Architectural Screens',
            'seo_title' => 'Handcrafted Carved Screens & Jali Dividers | Bharat Art & Craft',
        ]);
    }

    public function test_product_with_wood_finish_and_gallery_images(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();
        $wood = \App\Models\Wood::first();
        $finish = \App\Models\Finish::first();
        $category = \App\Models\Category::first();

        // 1. Create product with wood_id and finish_id
        $response = $this->actingAs($admin, 'admin')->post('/admin/product', [
            'title' => 'Heritage Royal Carved Armchair',
            'category_id' => $category->id,
            'wood_id' => $wood->id,
            'finish_id' => $finish->id,
            'code' => 'BAC-HER-099',
            'cbm' => '0.65',
            'price' => 850.00,
            'material' => $wood->name,
            'description' => 'Exquisite heritage armchair handcrafted in solid timber.',
        ]);

        $response->assertRedirect(route('admin.product.index'));
        $this->assertDatabaseHas('products', [
            'title' => 'Heritage Royal Carved Armchair',
            'wood_id' => $wood->id,
            'finish_id' => $finish->id,
            'cbm' => '0.65',
            'price' => 850.00,
        ]);

        $product = \App\Models\Product::where('code', 'BAC-HER-099')->first();
        $this->assertNotNull($product);

        // 2. Attach a gallery image
        $galleryImage = \App\Models\ProductImage::create([
            'product_id' => $product->id,
            'image' => 'fur_chair_oak.png',
            'sort_order' => 1,
        ]);

        $this->assertDatabaseHas('product_images', [
            'id' => $galleryImage->id,
            'product_id' => $product->id,
        ]);

        // 3. Delete gallery image endpoint
        $delGalleryRes = $this->actingAs($admin, 'admin')->delete('/admin/product/gallery-image/' . $galleryImage->id);
        $this->assertDatabaseMissing('product_images', ['id' => $galleryImage->id]);
    }

    public function test_product_creation_with_cropped_gallery_images_converts_to_webp(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();
        $wood = \App\Models\Wood::first();
        $finish = \App\Models\Finish::first();
        $category = \App\Models\Category::first();

        // 1x1 Red PNG data URL representing cropped client-side image
        $sampleBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==';

        $response = $this->actingAs($admin, 'admin')->post('/admin/product', [
            'title' => 'Sheesham Gallery Test Unit',
            'category_id' => $category->id,
            'wood_id' => $wood->id,
            'finish_id' => $finish->id,
            'code' => 'BAC-GAL-WEBP-01',
            'cbm' => '0.22',
            'price' => 320.00,
            'material' => 'Solid Sheesham',
            'gallery_images_base64' => [
                $sampleBase64,
            ],
        ]);

        $response->assertRedirect(route('admin.product.index'));
        $product = \App\Models\Product::where('code', 'BAC-GAL-WEBP-01')->first();
        $this->assertNotNull($product);

        // Verify ProductImage was created and saved as .webp
        $galleryItem = \App\Models\ProductImage::where('product_id', $product->id)->first();
        $this->assertNotNull($galleryItem);
        $this->assertStringEndsWith('.webp', $galleryItem->image);

        $savedFilePath = public_path('images/products/gallery/' . $galleryItem->image);
        $this->assertFileExists($savedFilePath);

        // Clean up file and product
        if (file_exists($savedFilePath)) {
            @unlink($savedFilePath);
        }
        $galleryItem->delete();
        $product->forceDelete();
    }

    public function test_bulk_delete_and_restore_operations(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();

        // Create 2 test products
        $p1 = \App\Models\Product::create([
            'title' => 'Bulk Test Chair 1',
            'slug' => 'bulk-test-chair-1',
            'code' => 'BULK-01',
            'quantity' => 5,
        ]);
        $p2 = \App\Models\Product::create([
            'title' => 'Bulk Test Chair 2',
            'slug' => 'bulk-test-chair-2',
            'code' => 'BULK-02',
            'quantity' => 10,
        ]);

        // 1. Bulk soft delete
        $response = $this->actingAs($admin, 'admin')->delete(route('admin.product.multiDestroy'), [
            'check' => [$p1->id, $p2->id],
        ]);
        $response->assertRedirect();

        $this->assertSoftDeleted('products', ['id' => $p1->id]);
        $this->assertSoftDeleted('products', ['id' => $p2->id]);

        // 2. Bulk restore
        $restoreRes = $this->actingAs($admin, 'admin')->delete(route('admin.product.multiDestroy'), [
            'check' => [$p1->id, $p2->id],
            'action' => 'restore',
        ]);
        $restoreRes->assertRedirect();

        $this->assertDatabaseHas('products', ['id' => $p1->id, 'deleted_at' => null]);
        $this->assertDatabaseHas('products', ['id' => $p2->id, 'deleted_at' => null]);

        // 3. Bulk permanent delete
        $permRes = $this->actingAs($admin, 'admin')->delete(route('admin.product.multiDestroy'), [
            'check' => [$p1->id, $p2->id],
            'action' => 'permanent-delete',
        ]);
        $permRes->assertRedirect();

        $this->assertDatabaseMissing('products', ['id' => $p1->id]);
        $this->assertDatabaseMissing('products', ['id' => $p2->id]);
    }
}
