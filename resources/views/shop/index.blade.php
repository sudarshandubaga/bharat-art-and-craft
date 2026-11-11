@extends('layouts.app')

@section('title', (isset($currentCategory) ? $currentCategory->title . ' — ' : '') . 'Bharat Art & Craft Shop — Modern & Timeless Furniture Collection')
@section('meta_description', (isset($currentCategory) ? 'Explore our handcrafted ' . $currentCategory->title . ' collection. ' : '') . 'Explore our premium collection of handcrafted sofas, dining tables, lounge chairs, and modular layout spaces. Made for intentional and modern living.')

@section('content')
  <h1 class="sr-only">The Catalog — Bharat Art & Craft Atelier</h1>

  <!-- STICKY HEADER -->
  <header class="fur-header">
    <div class="fur-header__scrolled-brand">
      <button class="fur-header__scrolled-toggle" id="fur-scrolled-menu-toggle" aria-expanded="false"
        aria-label="Toggle Menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
          <line x1="4" y1="12" x2="20" y2="12"></line>
          <line x1="4" y1="6" x2="20" y2="6"></line>
          <line x1="4" y1="18" x2="20" y2="18"></line>
        </svg>
      </button>
      <a href="{{ route('home') }}" class="fur-header__scrolled-logo" aria-label="Bharat Art &amp; Craft">
        <span class="tft-kave-logo">Bharat Art &amp; Craft</span>
      </a>
      <nav class="fur-header__scrolled-nav">
        <a href="{{ route('shop') }}" class="fur-header__scrolled-nav-link">Shop</a>
        <a href="{{ route('consultation') }}" class="fur-header__scrolled-nav-link">Customized Enquiry</a>
        <a href="{{ route('blog') }}" class="fur-header__scrolled-nav-link">Journal</a>
        <a href="{{ route('about') }}" class="fur-header__scrolled-nav-link">About</a>
      </nav>
    </div>

    <div class="fur-header__ticker">
      <div class="fur-header__tag">Material Sourcing</div>
      <div class="fur-header__ticker-wrap">
        <span class="fur-header__ticker-text">Honoring raw natural textures, quiet architectural proportions, and
          generation-lasting craftsmanship.</span>
      </div>
    </div>
  </header>

  <!-- SHOP CATALOG MODULE -->
  <section id="wp-block-shop-catalog" class="tft-shop-catalog">
    <h2 class="sr-only">Shop catalog</h2>
    <!-- POST HERO SECTION -->
    <section class="tft-post-hero" id="wp-block-shop-hero">
      <img class="tft-post-hero__img" src="{{ asset('assets/img/fur_room_living.png') }}" alt="Handicraft Furniture Catalog"
        width="1920" height="700" loading="eager">
      <div class="tft-post-hero__overlay"></div>
      <div class="tft-post-hero__content">
        <div class="tft-post-hero__breadcrumb">
          <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp;
          <a href="{{ route('shop') }}" style="color: inherit; text-decoration: none;">Shop</a>
          @if(isset($currentCategory))
            &nbsp;&rarr;&nbsp;
            <span>{{ $currentCategory->title }}</span>
          @endif
        </div>
        <span class="tft-post-hero__tag">{{ isset($currentCategory) ? $currentCategory->title : 'Handcrafted Furniture' }}</span>
        <h2 class="tft-post-hero__title">{{ isset($currentCategory) ? $currentCategory->title : 'The Catalog' }}</h2>
        <p class="tft-post-hero__desc">{{ isset($currentCategory) ? ($currentCategory->description ?: 'Bespoke solid wood ' . strtolower($currentCategory->title) . ' pieces handcrafted in Jodhpur.') : 'Filter by categories, wood finishes, premium materials, and export volume metrics.' }}</p>
      </div>
    </section>


    <div class="tft-shop-catalog__layout">

      <!-- SIDEBAR FILTERS -->
      <aside class="tft-shop-filters" id="tft-shop-filters">
        <!-- Mobile Filters Toggle -->
        <button class="tft-shop-filters__toggle-close" id="tft-shop-close-filters" aria-label="Close filters">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>

        <div class="tft-shop-filters__group">
          <h2 class="tft-shop-filters__title">Search</h2>
          <div class="tft-shop-filters__search-wrap" style="position: relative;">
            <input type="text" id="tft-shop-search" class="tft-shop-filters__search" autocomplete="off" placeholder="Type to search..."
              aria-label="Search catalog">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              class="tft-shop-filters__search-icon">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </div>
        </div>

        <div class="tft-shop-filters__group">
          <h2 class="tft-shop-filters__title">Sort By</h2>
          <select id="tft-shop-sort" class="tft-shop-filters__select" aria-label="Sort products">
            <option value="default">Default Sorting</option>
            <option value="name-asc">Name: A to Z</option>
            <option value="name-desc">Name: Z to A</option>
            <option value="cbm-asc">Volume: Low to High (CBM)</option>
            <option value="cbm-desc">Volume: High to Low (CBM)</option>
          </select>
        </div>

        @php
          $activeCat = request('category');
        @endphp
        <div class="tft-shop-filters__group">
          <h2 class="tft-shop-filters__title">Categories</h2>
          <ul class="tft-shop-filters__list">
            @forelse($categories as $cat)
              <li style="display: flex; align-items: center; justify-content: space-between;">
                <label class="tft-shop-filters__checkbox-label" style="flex-grow: 1;">
                  <input type="checkbox" name="category" value="{{ $cat->slug }}" {{ ((isset($currentCategory) && $currentCategory->slug === $cat->slug) || (!$activeCat && !isset($currentCategory)) || $activeCat === $cat->slug) ? 'checked' : '' }}>
                  <a href="{{ route('category.show', $cat->slug) }}" style="color: inherit; text-decoration: none;">{{ $cat->name }}</a>
                </label>
                <span style="font-size: 0.75rem; color: var(--fur-text-muted, #8c827a); opacity: 0.75;">{{ $cat->products_count }}</span>
              </li>
            @empty
              <li>
                <label class="tft-shop-filters__checkbox-label">
                  <input type="checkbox" name="category" value="lounge" checked>
                  <a href="{{ route('category.show', 'lounge') }}" style="color: inherit; text-decoration: none;">Lounge &amp; Sofas</a>
                </label>
              </li>
            @endforelse
          </ul>
        </div>

        <div class="tft-shop-filters__group">
          <h2 class="tft-shop-filters__title">Availability</h2>
          <ul class="tft-shop-filters__list">
            <li>
              <label class="tft-shop-filters__checkbox-label">
                <input type="checkbox" name="availability" value="in-stock" checked>
                <span>In Stock Only</span>
              </label>
            </li>
            <li>
              <label class="tft-shop-filters__checkbox-label">
                <input type="checkbox" name="availability" value="custom-order" checked>
                <span>Custom Crafting</span>
              </label>
            </li>
          </ul>
        </div>

        <div class="tft-shop-filters__group">
          <h2 class="tft-shop-filters__title">Wood & Materials</h2>
          <div class="tft-shop-filters__swatches">
            <button class="tft-shop-filters__swatch tft-shop-filters__swatch--active" data-material="all"
              title="All Materials">All</button>
            <button class="tft-shop-filters__swatch" data-material="oak" title="White Oak">Oak</button>
            <button class="tft-shop-filters__swatch" data-material="boucle" title="Ivory Bouclé">Bouclé</button>
            <button class="tft-shop-filters__swatch" data-material="leather" title="Aniline Leather">Leather</button>
            <button class="tft-shop-filters__swatch" data-material="travertine" title="Travertine Marble">Stone</button>
            <button class="tft-shop-filters__swatch" data-material="brass" title="Brushed Brass">Brass</button>
          </div>
        </div>

        <div class="tft-shop-filters__group">
          <h2 class="tft-shop-filters__title">Max Volume (CBM)</h2>
          <div class="tft-shop-filters__price-wrap">
            <input type="range" id="tft-shop-price-slider" min="0.1" max="4.0" step="0.1" value="4.0"
              aria-label="Max volume CBM slider">
            <div class="tft-shop-filters__price-labels">
              <span>0.1 m³</span>
              <strong id="tft-shop-price-val">4.0 CBM</strong>
            </div>
          </div>
        </div>

        <div class="tft-shop-filters__group" style="margin-block-start: 12px;">
          <button id="tft-shop-clear-filters" class="tft-shop-filters__clear-btn">Clear All Filters</button>
        </div>
      </aside>

      <!-- CATALOG CONTENT PANE -->
      <div class="tft-shop-catalog__content">

        <!-- Controls Bar -->
        <div class="tft-shop-controls">
          <button class="tft-shop-controls__filter-toggle" id="tft-shop-open-filters" aria-label="Open Filters">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
            </svg>
            <span>Filter</span>
          </button>
          <div class="tft-shop-controls__count" id="tft-shop-item-count">Showing 35 products</div>
          <div class="tft-shop-controls__modes">
            <button class="tft-shop-controls__mode-btn tft-shop-controls__mode-btn--active" id="tft-btn-grid4"
              aria-label="4-column layout">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
              </svg>
            </button>
            <button class="tft-shop-controls__mode-btn" id="tft-btn-grid2" aria-label="2-column layout">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="18" />
                <rect x="14" y="3" width="7" height="18" />
              </svg>
            </button>
          </div>
        </div>

        <!-- GRID CONTAINER -->
        <div class="tft-shop-grid tft-shop-grid--4col" id="tft-shop-grid-container">
          <!-- Rendered Dynamically via main.js from window.TFT_Products -->
          <noscript>
            @foreach($products as $prod)
              <article class="tft-product-card" data-prod-id="{{ $prod->id }}" data-id="{{ $prod->id }}">
                <div class="tft-product-card__img-wrap">
                  <a href="{{ route('product.single', $prod->slug) }}" class="tft-product-card__img-link">
                    <img class="tft-product-card__img" src="{{ $prod->image_url }}" alt="{{ $prod->title }}" width="280" height="280" loading="lazy">
                  </a>
                </div>
                <div class="tft-product-card__content">
                  <span class="tft-product-card__category">{{ $prod->category?->name ?? 'Furniture' }}</span>
                  <h3 class="tft-product-card__title"><a href="{{ route('product.single', $prod->slug) }}">{{ $prod->title }}</a></h3>
                  <div class="tft-product-card__footer">
                    <span class="tft-product-card__cbm"><i class="bi bi-box-seam me-1"></i>{{ $prod->cbm ? $prod->cbm . ' CBM' : '0.45 CBM' }}</span>
                    <button class="tft-product-card__add-to-cart" data-prod-id="{{ $prod->id }}" onclick="event.stopPropagation(); if(window.FUR_Theme) window.FUR_Theme.addToCart({{ $prod->id }})" aria-label="Add to Quote" title="Add to Quote">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </button>
                  </div>
                </div>
              </article>
            @endforeach
          </noscript>
        </div>
      </div>

    </div>

    <!-- PREMIUM MATERIAL SWATCH SHOWCASE -->
    <section id="wp-block-material-showcase" class="tft-materials-sec">
      <h2 class="tft-materials-sec__title">Our Tactile Material Palette</h2>
      <div class="tft-materials-grid">
        <article class="tft-materials-card">
          <div class="tft-materials-card__img-wrap">
            <img class="tft-materials-card__img" src="{{ asset('assets/img/fur_mat_oak.png') }}"
              alt="European White Oak wood grain close-up" width="400" height="250" loading="lazy">
          </div>
          <div class="tft-materials-card__body">
            <span class="tft-materials-card__tag">FSC Solid Timber</span>
            <h3 class="tft-materials-card__title">Solid European White Oak</h3>
            <p class="tft-materials-card__desc">Harvested from certified forests in central Denmark. Features tight growth
              rings, sanded down to a silky raw finish and protected by a natural matte oil coating.</p>
          </div>
        </article>

        <article class="tft-materials-card">
          <div class="tft-materials-card__img-wrap">
            <img class="tft-materials-card__img" src="{{ asset('assets/img/fur_mat_boucle.png') }}"
              alt="Textured ivory boucle wool fabric" width="400" height="250" loading="lazy">
          </div>
          <div class="tft-materials-card__body">
            <span class="tft-materials-card__tag">Belgian Textile</span>
            <h3 class="tft-materials-card__title">Ivory Wool Bouclé</h3>
            <p class="tft-materials-card__desc">Woven with recycled premium wool fibers. Offers a cozy, multi-dimensional
              texture with high abrasion resistance, creating an organic sensory statement.</p>
          </div>
        </article>

        <article class="tft-materials-card">
          <div class="tft-materials-card__img-wrap">
            <img class="tft-materials-card__img" src="{{ asset('assets/img/fur_mat_marble.png') }}"
              alt="Polished travertine marble stone texture" width="400" height="250" loading="lazy">
          </div>
          <div class="tft-materials-card__body">
            <span class="tft-materials-card__tag">Natural Stone</span>
            <h3 class="tft-materials-card__title">Honed Cream Travertine</h3>
            <p class="tft-materials-card__desc">Sourced from historic quarries in Italy. Unfilled pits preserve the
              natural geologic character, with a matte honed finish that radiates warm luxury.</p>
          </div>
        </article>
      </div>
    </section>

  </section>

  <!-- DYNAMIC FOOTER -->
  <!-- DYNAMIC FOOTER -->
  <!-- SYSTEM LEVEL: FOOTER (PREMIUM REBUILD) -->
@endsection