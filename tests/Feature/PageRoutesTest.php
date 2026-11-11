<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * Test all primary page routes return 200 OK status.
     */
    public function test_all_primary_pages_render_successfully(): void
    {
        $routes = [
            '/',
            '/about',
            '/faqs',
            '/custom-enquiry',
            '/contact',
            '/consultation',
            '/checkout',
            '/shop',
            '/shop/rooms',
            '/shop/complete-room',
            '/shop/editorial',
            '/shop/materials',
            '/shop/product',
            '/product/oak-dining-table',
            '/blog',
            '/blog/post/the-silent-geometry-of-japandi-interiors',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
            $response->assertSee('Bharat Art & Craft', false);
        }
    }

    /**
     * Test aliases and static html redirects.
     */
    public function test_legacy_html_redirects_and_aliases(): void
    {
        $redirects = [
            '/index.html' => '/',
            '/about.html' => '/about',
            '/shop.html' => '/shop',
            '/shop-rooms.html' => '/shop/rooms',
            '/shop-complete-room.html' => '/shop/complete-room',
            '/shop-editorial.html' => '/shop/editorial',
            '/shop-materials.html' => '/shop/materials',
            '/product-single.html' => '/product',
            '/blog.html' => '/blog',
            '/blog-post.html' => '/blog/post',
            '/contact.html' => '/contact',
            '/consultation.html' => '/consultation',
            '/checkout.html' => '/checkout',
        ];

        foreach ($redirects as $from => $to) {
            $response = $this->get($from);
            $response->assertRedirect($to);
        }
    }

    /**
     * Test query parameters are preserved through redirects.
     */
    public function test_query_params_preserved_on_redirect(): void
    {
        $response = $this->get('/product-single.html?id=sofa-01');
        $response->assertRedirect('/product?id=sofa-01');

        $response = $this->get('/shop.html?wishlist=true');
        $response->assertRedirect('/shop?wishlist=true');
    }
}
