@extends('layouts.app')

@section('title', 'Bharat Art & Craft Journal | Design, Spaces & Materiality')
@section('meta_description', 'Explore stories about Scandinavian craft, Japanese minimalism, and sustainable furniture design principles.')

@section('content')
<h1 class="sr-only">Atelier Journal — Stories for Better Living</h1>

      <!-- ===== POST HERO SECTION ===== -->
      <!-- wp:section -->
      <section class="tft-post-hero" id="wp-block-blog-hero">
        <img class="tft-post-hero__img" src="{{ asset('assets/img/fur_room_living.png') }}" alt="Silent Geometry of Japandi Interiors" width="1920" height="700" loading="eager">
        <div class="tft-post-hero__overlay"></div>
        <div class="tft-post-hero__content">
          <div class="tft-post-hero__breadcrumb">
            <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp; 
            <span>Journal</span>
          </div>
          <span class="tft-post-hero__tag">Bharat Art & Craft Journal</span>
          <h2 class="tft-post-hero__title">Stories for Better Living</h2>
          <p class="tft-post-hero__desc">Ideas, inspiration and guidance to help you create spaces that feel calm, natural and uniquely yours.</p>
        </div>
      </section>
      <!-- /wp:section -->

      <!-- ===== CATEGORY ICON TAB STRIP ===== -->
      <nav class="tft-blg-cats" id="wp-block-blg-cats" aria-label="Blog categories">
        <button class="tft-blg-cats__tab tft-blg-cats__tab--active" data-tag="all" data-tft-click="blog-filter" data-tft-category="all" aria-pressed="true">
          <span class="tft-blg-cats__tab-icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          </span>
          <span class="tft-blg-cats__tab-label">All Stories</span>
          <span class="tft-blg-cats__tab-count">View all</span>
        </button>
        <button class="tft-blg-cats__tab" data-tag="design" data-tft-click="blog-filter" data-tft-category="design" aria-pressed="false">
          <span class="tft-blg-cats__tab-icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
          </span>
          <span class="tft-blg-cats__tab-label">Design Philosophy</span>
          <span class="tft-blg-cats__tab-count">11 articles</span>
        </button>
        <button class="tft-blg-cats__tab" data-tag="sustainability" data-tft-click="blog-filter" data-tft-category="sustainability" aria-pressed="false">
          <span class="tft-blg-cats__tab-icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </span>
          <span class="tft-blg-cats__tab-label">Sourcing &amp; Craft</span>
          <span class="tft-blg-cats__tab-count">12 articles</span>
        </button>
        <button class="tft-blg-cats__tab" data-tag="planning" data-tft-click="blog-filter" data-tft-category="planning" aria-pressed="false">
          <span class="tft-blg-cats__tab-icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          </span>
          <span class="tft-blg-cats__tab-label">Space Planning</span>
          <span class="tft-blg-cats__tab-count">16 articles</span>
        </button>
        <button class="tft-blg-cats__tab" data-tag="materials" data-tft-click="blog-filter" data-tft-category="materials" aria-pressed="false">
          <span class="tft-blg-cats__tab-icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
          </span>
          <span class="tft-blg-cats__tab-label">Sustainability</span>
          <span class="tft-blg-cats__tab-count">10 articles</span>
        </button>
        <button class="tft-blg-cats__tab" data-tag="materials" data-tft-click="blog-filter" data-tft-category="materials" aria-pressed="false">
          <span class="tft-blg-cats__tab-icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
          </span>
          <span class="tft-blg-cats__tab-label">Materials</span>
          <span class="tft-blg-cats__tab-count">10 articles</span>
        </button>
        <button class="tft-blg-cats__tab" data-tag="lifestyle" data-tft-click="blog-filter" data-tft-category="lifestyle" aria-pressed="false">
          <span class="tft-blg-cats__tab-icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </span>
          <span class="tft-blg-cats__tab-label">Lifestyle</span>
          <span class="tft-blg-cats__tab-count">8 articles</span>
        </button>
      </nav>

      <!-- ===== BODY: FEED + SIDEBAR ===== -->
      <div class="tft-post-layout" id="wp-block-blg-body">

        <!-- === LEFT: MAIN FEED === -->
        <div class="tft-blg-feed" id="wp-block-blg-feed">

          <!-- FEATURED POST -->
          @if($featuredBlog)
          <a href="{{ route('blog.single', $featuredBlog->slug) }}" class="tft-blg-featured" id="wp-block-blg-featured" aria-label="Read featured article">
            <div class="tft-blg-featured__img-wrap">
              <img class="tft-blg-featured__img" src="{{ $featuredBlog->image_url }}" alt="{{ $featuredBlog->title }}" width="720" height="460" loading="lazy">
              <span class="tft-blg-featured__badge">Featured</span>
            </div>
            <div class="tft-blg-featured__body">
              <span class="tft-blg-featured__eyebrow">{{ $featuredBlog->category_name ?? 'Design Philosophy' }}</span>
              <h2 class="tft-blg-featured__title">{{ $featuredBlog->title }}</h2>
              <p class="tft-blg-featured__desc">{{ Str::limit(strip_tags($featuredBlog->description ?? $featuredBlog->excerpt), 160) }}</p>
              <div class="tft-blg-featured__meta">
                <img class="tft-blg-featured__avatar" src="{{ asset('assets/img/about_artisan_elena.png') }}" alt="Elena Rostova" width="28" height="28" loading="lazy">
                <span>By <strong>Bharat Art &amp; Craft Studio</strong></span>
                <span class="tft-blg-featured__dot" aria-hidden="true">·</span>
                <time datetime="{{ $featuredBlog->created_at?->toDateString() }}">{{ $featuredBlog->created_at?->format('M d, Y') ?? 'Recent' }}</time>
              </div>
              <span class="tft-blg-featured__cta">Read Full Story &rarr;</span>
            </div>
          </a>
          @endif

          <!-- GRID ROW -->
          <div class="tft-blg-grid" id="tft-blog-posts-grid">

            @forelse($blogs as $blg)
            <a href="{{ route('blog.single', $blg->slug) }}" class="tft-blg-card">
              <div class="tft-blg-card__img-wrap">
                <img class="tft-blg-card__img" src="{{ $blg->image_url }}" alt="{{ $blg->title }}" width="420" height="280" loading="lazy">
                <span class="tft-blg-card__tag">{{ $blg->category_name ?? 'Craft' }}</span>
              </div>
              <div class="tft-blg-card__body">
                <time class="tft-blg-card__date" datetime="{{ $blg->created_at?->toDateString() }}">{{ $blg->created_at?->format('F d, Y') ?? 'Recent' }}</time>
                <h3 class="tft-blg-card__title">{{ $blg->title }}</h3>
                <p class="tft-blg-card__desc">{{ Str::limit(strip_tags($blg->description ?? $blg->excerpt), 120) }}</p>
                <span class="tft-blg-card__read">Read Story &rarr;</span>
              </div>
            </a>
            @empty
            <p>No more articles found.</p>
            @endforelse

          </div>

          <!-- LOAD MORE -->
          <div class="tft-blg-load-more">
            <button class="tft-blg-load-more__btn" type="button" data-tft-click="blog-load-more">
              Load More Articles
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
          </div>

        </div>

        <!-- === RIGHT: SIDEBAR === -->
        <!-- wp:aside -->
        <aside class="tft-post-sidebar" id="wp-block-blog-sidebar" aria-label="Article Sidebar">
          
          <!-- Widget: Meet Elena -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </span>
              <h4 class="tft-widget__title">The Designer</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-author">
                <img class="tft-widget-author__img" src="{{ asset('assets/img/about_artisan_elena.png') }}" alt="Elena Rostova" width="72" height="72" loading="lazy">
                <span class="tft-widget-author__name">Elena Rostova</span>
                <span class="tft-widget-author__role">Lead Architect</span>
                <p class="tft-widget-author__bio">Elena curates our spatial geometries and natural linen textures.</p>
                <a href="{{ route('about') }}" class="tft-widget-author__btn">Meet Elena</a>
              </div>
            </div>
          </div>

          <!-- Widget: Related Stories -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
              </span>
              <h4 class="tft-widget__title">Related Stories</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-related">
                @foreach($recentBlogs as $rb)
                <a href="{{ route('blog.single', $rb->slug) }}" class="tft-widget-related__item">
                  <img class="tft-widget-related__img" src="{{ $rb->image_url }}" alt="{{ $rb->title }}" width="72" height="56" loading="lazy">
                  <div>
                    <h5 class="tft-widget-related__title">{{ $rb->title }}</h5>
                    <div class="tft-widget-related__date">{{ $rb->created_at?->format('M d, Y') ?? 'Recent' }}</div>
                  </div>
                </a>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Widget: Categories -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              </span>
              <h4 class="tft-widget__title">Categories</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-cats">
                <a href="{{ route('blog', ['category' => 'design']) }}" class="tft-widget-cats__item">
                  <span>Design Philosophy</span>
                  <span class="tft-widget-cats__count">8</span>
                </a>
                <a href="{{ route('blog', ['category' => 'sustainability']) }}" class="tft-widget-cats__item">
                  <span>Sourcing &amp; Pledge</span>
                  <span class="tft-widget-cats__count">4</span>
                </a>
                <a href="{{ route('blog', ['category' => 'planning']) }}" class="tft-widget-cats__item">
                  <span>Space Planning</span>
                  <span class="tft-widget-cats__count">5</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Widget: Featured Atelier Piece -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>
              </span>
              <h4 class="tft-widget__title">Featured Design</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-product">
                <img class="tft-widget-product__img" src="{{ asset('assets/img/fp_table_coffee_travertine.png') }}" alt="Travertine Coffee Table" width="280" height="210" loading="lazy">
                <h5 class="tft-widget-product__name">Travertine Coffee Table</h5>
                <p class="tft-widget-product__desc">Italian travertine block coffee table featuring rounded architectural leg structures and a satin finish.</p>
                <div class="tft-widget-product__price">$1,450.00</div>
                <a href="{{ route('product.single') }}" class="tft-widget-product__btn">Explore Piece</a>
              </div>
            </div>
          </div>

          <!-- Widget: Tags Cloud -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
              </span>
              <h4 class="tft-widget__title">Tags</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-tags">
                <a href="#" class="tft-widget-tag">Japandi</a>
                <a href="#" class="tft-widget-tag">Linen</a>
                <a href="#" class="tft-widget-tag">Oak</a>
                <a href="#" class="tft-widget-tag">Ma</a>
                <a href="#" class="tft-widget-tag">FSC Wood</a>
                <a href="#" class="tft-widget-tag">Joinery</a>
              </div>
            </div>
          </div>

        </aside>
        <!-- /wp:aside -->

      </div>




            <!-- DYNAMIC FOOTER -->
      <!-- DYNAMIC FOOTER -->
      <!-- SYSTEM LEVEL: FOOTER (PREMIUM REBUILD) -->
@endsection
