@extends('layouts.app')

@section('title', 'Complete Room Shop — Bharat Art & Craft')
@section('meta_description', 'Shop entire curated designer room packages in a single click. Browse coordinated setups like our Organic Living Room set.')

@section('content')
<h1 class="sr-only">Complete Rooms — Bharat Art & Craft Atelier</h1>

      <!-- SCROLLED STICKY HEADER -->
      <header class="fur-header">
        <div class="fur-header__scrolled-brand">
          <button class="fur-header__scrolled-toggle" id="fur-scrolled-menu-toggle" aria-expanded="false" aria-label="Toggle Menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fur-icon"><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="18" x2="20" y2="18"></line></svg>
          </button>
          <a href="{{ route('home') }}" class="fur-header__scrolled-logo" aria-label="Kave Home">
            <span class="tft-kave-logo">Kav<span class="tft-kave-logo__accent">e</span></span>
          </a>
          <nav class="fur-header__scrolled-nav">
            <a href="{{ route('shop') }}" class="fur-header__scrolled-nav-link">Shop</a>
            <a href="{{ route('home') }}" class="fur-header__scrolled-nav-link">Rooms</a>
            <a href="{{ route('home') }}#wp-block-fur-promo-slider" class="fur-header__scrolled-nav-link">Styles</a>
            <a href="{{ route('blog') }}" class="fur-header__scrolled-nav-link">Journal</a>
            <a href="{{ route('about') }}" class="fur-header__scrolled-nav-link">About</a>
            
          </nav>
        </div>

        <div class="fur-header__ticker">
          <div class="fur-header__tag">Material Sourcing</div>
          <div class="fur-header__ticker-wrap">
            <span class="fur-header__ticker-text">Honoring raw natural textures, quiet architectural proportions, and generation-lasting craftsmanship.</span>
          </div>
        </div>
      </header>

      <!-- ===== POST HERO SECTION ===== -->
      <!-- wp:section -->
      <section class="tft-post-hero" id="wp-block-complete-room-hero-banner">
        <img class="tft-post-hero__img" src="{{ asset('assets/img/fur_room_living.png') }}" alt="Complete Room set preview" width="1920" height="700" loading="eager">
        <div class="tft-post-hero__overlay"></div>
        <div class="tft-post-hero__content">
          <div class="tft-post-hero__breadcrumb">
            <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp; 
            <a href="{{ route('shop') }}">Shop</a> &nbsp;&rarr;&nbsp; 
            <span>Complete Room</span>
          </div>
          <span class="tft-post-hero__tag">READY-TO-BUY BUNDLES</span>
          <h2 class="tft-post-hero__title">Complete Rooms</h2>
          <p class="tft-post-hero__desc">Explore our pre-styled, coordinated room setups curated by our lead designers to elevate your living spaces effortlessly.</p>
        </div>
      </section>
      <!-- /wp:section -->

      <!-- SECTION: SPLIT BUNDLE PANEL -->
      <section class="tft-cpt-hero" id="wp-block-complete-room-hero">
        <div class="tft-cpt-hero__container">
          <div class="tft-cpt-hero__layout">
            
            <!-- Left Info Panel -->
            <div class="tft-cpt-hero__info">
              <a href="{{ route('shop') }}" class="tft-cpt-hero__back-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                <span>BACK TO SHOP</span>
              </a>

              <h2 class="tft-cpt-hero__title">Organic Living Room</h2>
              
              <div class="tft-cpt-hero__price-row">
                <span class="tft-cpt-hero__price-val">3.85 CBM</span>
                <span class="tft-cpt-hero__price-label">Total Set Volume (6 items)</span>
              </div>

              <p class="tft-cpt-hero__desc">
                A warm, tactile living room package curated by our senior styling directors. Harmonizing European oak, raw unfilled travertine, and high-abrasion Belgian boucle to create a quiet sanctuary.
              </p>

              <div class="tft-cpt-hero__includes">
                <span class="tft-cpt-hero__includes-title">WHAT'S INCLUDED:</span>
                <ul class="tft-cpt-hero__includes-list">
                  <li><strong>Como Modular Sofa</strong> (Belgian Flax Linen)</li>
                  <li><strong>Rondo Coffee Table</strong> (Honed Cream Travertine)</li>
                  <li><strong>Calma Lounge Chair</strong> (Aniline Saddle Leather)</li>
                  <li><strong>Nara Credenza Sideboard</strong> (Solid Oak & Slate Wood)</li>
                  <li><strong>Kyoto Lantern Table Lamp</strong> (Rice Paper & Washi)</li>
                  <li><strong>Naima Flatweave Jute Rug</strong> (Handwoven Natural Fibers)</li>
                </ul>
              </div>

              <div class="tft-cpt-hero__cta-wrapper">
                <button type="button" class="tft-cpt-hero__add-btn" id="tft-cpt-add-all-trigger">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                  <span>ADD ENTIRE ROOM TO CART</span>
                </button>
              </div>

              <!-- USPs -->
              <div class="tft-cpt-hero__usps">
                <div class="tft-cpt-hero__usp">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--fur-primary)" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"/></svg>
                  <span>Curated by Designers</span>
                </div>
                <div class="tft-cpt-hero__usp">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--fur-primary)" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                  <span>Save 10% on Packages</span>
                </div>
                <div class="tft-cpt-hero__usp">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--fur-primary)" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                  <span>Free White-Glove Delivery</span>
                </div>
              </div>
            </div>

            <!-- Right Image Panel -->
            <div class="tft-cpt-hero__visual">
              <img class="tft-cpt-hero__img" src="{{ asset('assets/img/fur_room_living.png') }}" alt="Curated organic living room bundle preview" width="800" height="600" loading="eager">
            </div>

          </div>
        </div>
      </section>

      <!-- SECTION: ITEM SPLIT DETAIL GRID -->
      <section class="tft-cpt-grid-sec" id="wp-block-complete-room-items">
        <div class="tft-cpt-grid-sec__container">
          <h2 class="tft-cpt-grid-sec__title">Individual Package Elements</h2>
          <p class="tft-cpt-grid-sec__desc">Explore specifications and adjust quantities of the items inside this collection.</p>

          <div class="tft-cpt-products">

            <!-- Item 1: Como Modular Sofa -->
            <article class="tft-cpt-product-card">
              <div class="tft-cpt-product-card__img-wrap">
                <img class="tft-cpt-product-card__img" src="{{ asset('assets/img/fur_sofa_linen.png') }}" alt="Como Sofa" width="300" height="220" loading="lazy">
              </div>
              <div class="tft-cpt-product-card__body">
                <h3 class="tft-cpt-product-card__title">Como Modular Sofa</h3>
                <span class="tft-cpt-product-card__material">Belgian Flax Linen</span>
                <span class="tft-cpt-product-card__price">1.85 CBM</span>
                <button type="button" class="tft-cpt-product-card__add-btn" data-tft-click="add-room-item" data-tft-id="com-sofa" data-tft-title="Como Modular Sofa" data-tft-cbm="1.85" data-tft-image="assets/img/fur_sofa_linen.png">Add to Quote</button>
              </div>
            </article>

            <!-- Item 2: Rondo Coffee Table -->
            <article class="tft-cpt-product-card">
              <div class="tft-cpt-product-card__img-wrap">
                <img class="tft-cpt-product-card__img" src="{{ asset('assets/img/fp_table_coffee_travertine.png') }}" alt="Rondo Coffee Table" width="300" height="220" loading="lazy">
              </div>
              <div class="tft-cpt-product-card__body">
                <h3 class="tft-cpt-product-card__title">Rondo Coffee Table</h3>
                <span class="tft-cpt-product-card__material">Honed Italian Travertine</span>
                <span class="tft-cpt-product-card__price">0.45 CBM</span>
                <button type="button" class="tft-cpt-product-card__add-btn" data-tft-click="add-room-item" data-tft-id="ron-table" data-tft-title="Rondo Coffee Table" data-tft-cbm="0.45" data-tft-image="assets/img/fp_table_coffee_travertine.png">Add to Quote</button>
              </div>
            </article>

            <!-- Item 3: Calma Lounge Chair -->
            <article class="tft-cpt-product-card">
              <div class="tft-cpt-product-card__img-wrap">
                <img class="tft-cpt-product-card__img" src="{{ asset('assets/img/fur_chair_leather_lounge.png') }}" alt="Calma Lounge Chair" width="300" height="220" loading="lazy">
              </div>
              <div class="tft-cpt-product-card__body">
                <h3 class="tft-cpt-product-card__title">Calma Lounge Chair</h3>
                <span class="tft-cpt-product-card__material">Aniline Saddle Leather</span>
                <span class="tft-cpt-product-card__price">0.55 CBM</span>
                <button type="button" class="tft-cpt-product-card__add-btn" data-tft-click="add-room-item" data-tft-id="cal-chair" data-tft-title="Calma Lounge Chair" data-tft-cbm="0.55" data-tft-image="assets/img/fur_chair_leather_lounge.png">Add to Quote</button>
              </div>
            </article>

            <!-- Item 4: Nara Credenza Sideboard -->
            <article class="tft-cpt-product-card">
              <div class="tft-cpt-product-card__img-wrap">
                <img class="tft-cpt-product-card__img" src="{{ asset('assets/img/fur_prod_sideboard_dark.png') }}" alt="Nara Credenza Sideboard" width="300" height="220" loading="lazy">
              </div>
              <div class="tft-cpt-product-card__body">
                <h3 class="tft-cpt-product-card__title">Nara Credenza Sideboard</h3>
                <span class="tft-cpt-product-card__material">Solid Oak & Slate</span>
                <span class="tft-cpt-product-card__price">0.72 CBM</span>
                <button type="button" class="tft-cpt-product-card__add-btn" data-tft-click="add-room-item" data-tft-id="nar-side" data-tft-title="Nara Credenza Sideboard" data-tft-cbm="0.72" data-tft-image="assets/img/fur_prod_sideboard_dark.png">Add to Quote</button>
              </div>
            </article>

            <!-- Item 5: Kyoto Table Lamp -->
            <article class="tft-cpt-product-card">
              <div class="tft-cpt-product-card__img-wrap">
                <img class="tft-cpt-product-card__img" src="{{ asset('assets/img/fur_prod_floor_lamp.png') }}" alt="Kyoto Table Lamp" width="300" height="220" loading="lazy">
              </div>
              <div class="tft-cpt-product-card__body">
                <h3 class="tft-cpt-product-card__title">Kyoto Table Lamp</h3>
                <span class="tft-cpt-product-card__material">Rice Paper & White Oak</span>
                <span class="tft-cpt-product-card__price">0.15 CBM</span>
                <button type="button" class="tft-cpt-product-card__add-btn" data-tft-click="add-room-item" data-tft-id="kyo-lamp" data-tft-title="Kyoto Table Lamp" data-tft-cbm="0.15" data-tft-image="assets/img/fur_prod_floor_lamp.png">Add to Quote</button>
              </div>
            </article>

            <!-- Item 6: Naima Jute Rug -->
            <article class="tft-cpt-product-card">
              <div class="tft-cpt-product-card__img-wrap">
                <img class="tft-cpt-product-card__img" src="{{ asset('assets/img/fur_prod_rug.png') }}" alt="Naima Jute Rug" width="300" height="220" loading="lazy">
              </div>
              <div class="tft-cpt-product-card__body">
                <h3 class="tft-cpt-product-card__title">Naima Jute Rug</h3>
                <span class="tft-cpt-product-card__material">Handwoven Natural Jute</span>
                <span class="tft-cpt-product-card__price">0.13 CBM</span>
                <button type="button" class="tft-cpt-product-card__add-btn" data-tft-click="add-room-item" data-tft-id="nai-rug" data-tft-title="Naima Jute Rug" data-tft-cbm="0.13" data-tft-image="assets/img/fur_prod_rug.png">Add to Quote</button>
              </div>
            </article>

          </div>
        </div>
      </section>

      <!-- SYSTEM LEVEL: FOOTER -->
@endsection
