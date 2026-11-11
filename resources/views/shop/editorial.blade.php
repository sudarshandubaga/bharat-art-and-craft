@extends('layouts.app')

@section('title', 'Editorial Shop — Bharat Art & Craft')
@section('meta_description', 'Explore our seasonal collections through curated editorial layouts. Discover the harmony of sustainable oak, travertine stone, and bouclé fabrics.')

@section('content')
  <h1 class="sr-only">Editorial Shop — Bharat Art & Craft Atelier</h1>

  <!-- SYSTEM SCROLLED/STICKY HEADER -->
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

  <!-- ===== POST HERO SECTION ===== -->
  <!-- wp:section -->
  <section class="tft-post-hero" id="wp-block-editorial-hero-banner">
    <img class="tft-post-hero__img" src="{{ asset('assets/img/fur_consultation_hero.png') }}" alt="Editorial Shop Banner"
      width="1920" height="700" loading="eager">
    <div class="tft-post-hero__overlay"></div>
    <div class="tft-post-hero__content">
      <div class="tft-post-hero__breadcrumb">
        <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp;
        <a href="{{ route('shop') }}">Shop</a> &nbsp;&rarr;&nbsp;
        <span>Editorial Shop</span>
      </div>
      <span class="tft-post-hero__tag">VISUAL STORIES</span>
      <h2 class="tft-post-hero__title">Editorial Shop</h2>
      <p class="tft-post-hero__desc">Shop the look of our professionally styled organic interior scenes, bringing quiet
        luxury and sustainable design into focus.</p>
    </div>
  </section>
  <!-- /wp:section -->

  <!-- WP-BLOCK: 02. EDITORIAL SHOP HERO -->
  <section class="tft-eds-hero" id="wp-block-editorial-hero">
    <div class="tft-eds-hero__container">
      <div class="tft-eds-hero__grid">
        <!-- Left Editorial Text -->
        <div class="tft-eds-hero__content">
          <span class="tft-eds-hero__eyebrow">THE SPRING COLLECTION</span>
          <h1 class="tft-eds-hero__title">Inspired by nature.<br>Designed for living beautifully.</h1>
          <p class="tft-eds-hero__desc">A curated edit of FSC-certified European oak, raw Tuscan travertine, and
            double-loop bouclé textures. Every curve honors material truth and structural silence.</p>
          <div class="tft-eds-hero__actions">
            <a href="#wp-block-calm-details" class="tft-eds-hero__btn tft-eds-hero__btn--primary">
              <span>EXPLORE COLLECTION</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </a>
          </div>
        </div>
        <!-- Right Lifestyle Photo -->
        <div class="tft-eds-hero__media">
          <div class="tft-eds-hero__img-wrapper">
            <img class="tft-eds-hero__img" src="{{ asset('assets/img/fur_editorial_hero.png') }}"
              alt="Minimalist Japandi living room setting with sustainable oak lounge chair and raw travertine side table"
              width="760" height="540" loading="eager">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- WP-BLOCK: CALM IN EVERY DETAIL (LIVING ROOM EDITORIAL) -->
  <section class="tft-eds-section" id="wp-block-calm-details">
    <div class="tft-eds-section__container">
      <div class="tft-eds-section__grid">

        <!-- Left Portrait Image -->
        <div class="tft-eds-section__media">
          <div class="tft-eds-section__img-wrapper">
            <img class="tft-eds-section__img" src="{{ asset('assets/img/fur_living_split.png') }}"
              alt="Stylized cozy living room showcasing raw timber, textured bouclé upholstery and quiet warm afternoon shadows"
              width="550" height="700" loading="lazy">
            <div class="tft-eds-section__img-label">THE LIVING EDIT</div>
          </div>
        </div>

        <!-- Right Content & Scrollable Products -->
        <div class="tft-eds-section__content">
          <span class="tft-eds-section__eyebrow font-uppercase">01 / CALM IN EVERY DETAIL</span>
          <h2 class="tft-eds-section__title">Sculpted curves and quiet textures.</h2>
          <p class="tft-eds-section__desc">Soft curves, tactile natural finishes, and an organic neutral color palette
            designed to bring balance to your living room. Sourced responsibly and crafted for longevity.</p>

          <div class="tft-eds-section__link-wrapper">
            <a href="{{ route('category.show', 'lounge') }}" class="tft-eds-section__link">
              <span>SHOP LIVING ROOM</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </a>
          </div>

          <!-- Product Carousel -->
          <div class="tft-eds-carousel">
            <div class="tft-eds-carousel__header">
              <span class="tft-eds-carousel__count">4 CURATED PIECES</span>
              <div class="tft-eds-carousel__nav-btns">
                <button class="tft-eds-carousel__btn-arrow tft-eds-carousel__btn-arrow--prev"
                  data-tft-click="editorial-scroll" data-tft-carousel="living-carousel" data-tft-dir="prev"
                  aria-label="Scroll left">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                  </svg>
                </button>
                <button class="tft-eds-carousel__btn-arrow tft-eds-carousel__btn-arrow--next"
                  data-tft-click="editorial-scroll" data-tft-carousel="living-carousel" data-tft-dir="next"
                  aria-label="Scroll right">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </button>
              </div>
            </div>

            <div class="tft-eds-carousel__track" id="living-carousel">

              <!-- Card 1 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img" src="{{ asset('assets/img/fur_sofa_boucle.png') }}"
                      alt="Como Cozy Cream Boucle Sofa" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Como Cozy Bouclé Sofa" data-tft-cbm="2400"
                    aria-label="Add Como Cozy Bouclé Sofa to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Como Cozy Bouclé
                      Sofa</a></h3>
                  <span class="tft-eds-product-card__price">$2,400</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #f5f2eb;" title="Cream Bouclé"></span>
                    <span class="tft-eds-product-card__swatch" style="background-color: #d1cbc4;"
                      title="Grey Linen"></span>
                  </div>
                </div>
              </div>

              <!-- Card 2 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img"
                      src="{{ asset('assets/img/fur_pairing_travertine_walnut.png') }}"
                      alt="Travertine Block Coffee Table" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Travertine Block Coffee Table" data-tft-cbm="850"
                    aria-label="Add Travertine Block Coffee Table to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Travertine Block Coffee
                      Table</a></h3>
                  <span class="tft-eds-product-card__price">$850</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #eae5d9;" title="Raw Travertine"></span>
                  </div>
                </div>
              </div>

              <!-- Card 3 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img" src="{{ asset('assets/img/fur_hero_boucle_chair.png') }}"
                      alt="Rondo Oak Accent Chair" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Rondo Oak Accent Chair" data-tft-cbm="650"
                    aria-label="Add Rondo Oak Accent Chair to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Rondo Oak Accent
                      Chair</a></h3>
                  <span class="tft-eds-product-card__price">$650</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #dfd7cb;" title="Oak & Bouclé"></span>
                    <span class="tft-eds-product-card__swatch" style="background-color: #3d3b37;"
                      title="Charcoal & Linen"></span>
                  </div>
                </div>
              </div>

              <!-- Card 4 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img" src="{{ asset('assets/img/fur_prod_floor_lamp.png') }}"
                      alt="Calma Brass Floor Lamp" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Calma Brass Floor Lamp" data-tft-cbm="320"
                    aria-label="Add Calma Brass Floor Lamp to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Calma Brass Floor
                      Lamp</a></h3>
                  <span class="tft-eds-product-card__price">$320</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #d1b46a;" title="Brushed Brass"></span>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- WP-BLOCK: DINING SPACES FOR CONNECTION -->
  <section class="tft-eds-section tft-eds-section--reverse" id="wp-block-dining-spaces">
    <div class="tft-eds-section__container">
      <div class="tft-eds-section__grid">

        <!-- Left Content & Scrollable Products -->
        <div class="tft-eds-section__content">
          <span class="tft-eds-section__eyebrow font-uppercase">02 / DINING SPACES FOR CONNECTION</span>
          <h2 class="tft-eds-section__title">Made for connection.</h2>
          <p class="tft-eds-section__desc">Solid oak wood dining tables, woven paper cord seats, and organic textured
            ceramic centerpieces. Crafted for long gatherings, family dinners, and beautiful quiet mornings.</p>

          <div class="tft-eds-section__link-wrapper">
            <a href="{{ route('category.show', 'dining') }}" class="tft-eds-section__link">
              <span>SHOP DINING ROOM</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </a>
          </div>

          <!-- Product Carousel -->
          <div class="tft-eds-carousel">
            <div class="tft-eds-carousel__header">
              <span class="tft-eds-carousel__count">4 CURATED PIECES</span>
              <div class="tft-eds-carousel__nav-btns">
                <button class="tft-eds-carousel__btn-arrow tft-eds-carousel__btn-arrow--prev"
                  data-tft-click="editorial-scroll" data-tft-carousel="dining-carousel" data-tft-dir="prev"
                  aria-label="Scroll left">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                  </svg>
                </button>
                <button class="tft-eds-carousel__btn-arrow tft-eds-carousel__btn-arrow--next"
                  data-tft-click="editorial-scroll" data-tft-carousel="dining-carousel" data-tft-dir="next"
                  aria-label="Scroll right">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </button>
              </div>
            </div>

            <div class="tft-eds-carousel__track" id="dining-carousel">

              <!-- Card 1 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img" src="{{ asset('assets/img/fur_mat_oak.png') }}"
                      alt="Tevere Solid Oak Dining Table" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Tevere Oak Dining Table" data-tft-cbm="1850"
                    aria-label="Add Tevere Oak Dining Table to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Tevere Oak Dining
                      Table</a></h3>
                  <span class="tft-eds-product-card__price">$1,850</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #dfcaa2;" title="Natural Oak"></span>
                    <span class="tft-eds-product-card__swatch" style="background-color: #614629;"
                      title="Walnut finish"></span>
                  </div>
                </div>
              </div>

              <!-- Card 2 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img" src="{{ asset('assets/img/fur_prod_dining_chair.png') }}"
                      alt="Woven Cord Dining Chair" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Woven Cord Dining Chair" data-tft-cbm="340"
                    aria-label="Add Woven Cord Dining Chair to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Woven Cord Dining
                      Chair</a></h3>
                  <span class="tft-eds-product-card__price">$340</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #d8c29b;" title="Natural Woven"></span>
                    <span class="tft-eds-product-card__swatch" style="background-color: #272624;"
                      title="Black Woven"></span>
                  </div>
                </div>
              </div>

              <!-- Card 3 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img" src="{{ asset('assets/img/fur_prod_vase.png') }}"
                      alt="Organic Stoneware Carafe" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Organic Stoneware Carafe" data-tft-cbm="75"
                    aria-label="Add Organic Stoneware Carafe to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Organic Stoneware
                      Carafe</a></h3>
                  <span class="tft-eds-product-card__price">$75</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #e5dfd5;" title="Chalk White"></span>
                  </div>
                </div>
              </div>

              <!-- Card 4 -->
              <div class="tft-eds-product-card">
                <div class="tft-eds-product-card__img-wrapper">
                  <a href="{{ route('product.single') }}">
                    <img class="tft-eds-product-card__img" src="{{ asset('assets/img/fur_prod_sideboard_dark.png') }}"
                      alt="Arc Oak Sideboard" width="220" height="220" loading="lazy">
                  </a>
                  <button class="tft-eds-product-card__add" data-tft-click="editorial-add-to-cart"
                    data-tft-title="Arc Oak Sideboard" data-tft-cbm="1200"
                    aria-label="Add Arc Oak Sideboard to Cart">+</button>
                </div>
                <div class="tft-eds-product-card__body">
                  <h3 class="tft-eds-product-card__title"><a href="{{ route('product.single') }}">Arc Oak Sideboard</a>
                  </h3>
                  <span class="tft-eds-product-card__price">$1,200</span>
                  <div class="tft-eds-product-card__swatches">
                    <span class="tft-eds-product-card__swatch tft-eds-product-card__swatch--active"
                      style="background-color: #4b3e34;" title="Dark Charcoal Oak"></span>
                    <span class="tft-eds-product-card__swatch" style="background-color: #dccfb0;"
                      title="Natural Sand Oak"></span>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

        <!-- Right Portrait Image -->
        <div class="tft-eds-section__media">
          <div class="tft-eds-section__img-wrapper">
            <img class="tft-eds-section__img" src="{{ asset('assets/img/fur_room_dining.png') }}"
              alt="Light-filled Japandi dining space with a natural timber dining setup and architectural linen curtains"
              width="550" height="700" loading="lazy">
            <div class="tft-eds-section__img-label">THE DINING EDIT</div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- WP-BLOCK: THE MATERIAL EDIT PROMO -->
  <section class="tft-eds-promo" id="wp-block-material-promo">
    <div class="tft-eds-promo__container">
      <div class="tft-eds-promo__content">
        <span class="tft-eds-promo__eyebrow">TACTILE EXPERIENCE</span>
        <h2 class="tft-eds-promo__title">The Savoré Swatch Lab.</h2>
        <p class="tft-eds-promo__desc">We believe the textures you surround yourself with should be felt. Order a
          complimentary sample kit containing solid European oak blocks, raw Italian travertine, and hand-woven bouclé
          specimens to experience Savoré quality firsthand.</p>
        <div class="tft-eds-promo__actions">
          <a href="{{ route('shop') }}" class="tft-eds-promo__btn">
            <span>ORDER COMPLIMENTARY SWATCHES</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- TRUST BADGES BAR -->
  <div class="tft-prov-badges">
    <div class="tft-prov-badges__container">
      <div class="tft-prov-badges__grid">

        <div class="tft-badge-item">
          <span class="tft-badge-item__icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
          </span>
          <div class="tft-badge-item__content">
            <h3 class="tft-badge-item__title">RESPONSIBLY SOURCED</h3>
            <p class="tft-badge-item__desc">Carefully chosen for people and planet.</p>
          </div>
        </div>

        <div class="tft-badge-item">
          <span class="tft-badge-item__icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M12 8v13" />
              <path d="M12 3a5 5 0 0 0-5 5c0 4 5 10 5 10s5-6 5-10a5 5 0 0 0-5-5z" />
            </svg>
          </span>
          <div class="tft-badge-item__content">
            <h3 class="tft-badge-item__title">TIMELESS QUALITY</h3>
            <p class="tft-badge-item__desc">Made to be cherished for generations.</p>
          </div>
        </div>

        <div class="tft-badge-item">
          <span class="tft-badge-item__icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path
                d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
            </svg>
          </span>
          <div class="tft-badge-item__content">
            <h3 class="tft-badge-item__title">EXPERT CRAFTSMANSHIP</h3>
            <p class="tft-badge-item__desc">Skilled hands, thoughtful design.</p>
          </div>
        </div>

        <div class="tft-badge-item">
          <span class="tft-badge-item__icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            </svg>
          </span>
          <div class="tft-badge-item__content">
            <h3 class="tft-badge-item__title">DESIGNED TO BELONG</h3>
            <p class="tft-badge-item__desc">Pieces that make a house feel like home.</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- SYSTEM LEVEL: FOOTER -->
@endsection