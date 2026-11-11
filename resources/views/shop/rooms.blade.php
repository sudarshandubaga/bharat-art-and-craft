@extends('layouts.app')

@section('title', 'Shop by Room — Bharat Art & Craft')
@section('meta_description', 'Explore and buy premium handcrafted furniture curated by spatial rooms. Discover living room, bedroom, dining room, home office, and outdoor layouts.')

@section('content')
<h1 class="sr-only">Shop by Room — Bharat Art & Craft Atelier</h1>

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
      <section class="tft-post-hero" id="wp-block-rooms-hero">
        <img class="tft-post-hero__img" src="{{ asset('assets/img/fur_room_living.png') }}" alt="Curated home concepts and room coordinates" width="1920" height="700" loading="eager">
        <div class="tft-post-hero__overlay"></div>
        <div class="tft-post-hero__content">
          <div class="tft-post-hero__breadcrumb">
            <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp; 
            <a href="{{ route('shop') }}">Shop</a> &nbsp;&rarr;&nbsp; 
            <span>Shop by Room</span>
          </div>
          <span class="tft-post-hero__tag">CURATED SPACES</span>
          <h2 class="tft-post-hero__title">Shop by Room</h2>
          <p class="tft-post-hero__desc">Browse and coordinate our premium handcrafted designs, grouped systematically to help you complete and refine every space in your home.</p>
        </div>
      </section>
      <!-- /wp:section -->

      <!-- SECTION: ROOMS GRID -->
      <section class="tft-rms-grid-sec" id="wp-block-rooms-catalog">
        <h2 class="sr-only">Rooms catalog</h2>
        <div class="tft-rms-grid-sec__container">
          <div class="tft-rms-grid">
            
            <!-- Living Room (Wide full-width block) -->
            <article class="tft-rms-card tft-rms-card--wide">
              <div class="tft-rms-card__bg-wrap">
                <img class="tft-rms-card__bg" src="{{ asset('assets/img/fur_room_living.png') }}" alt="Living Room curated setup" width="1400" height="500" loading="eager">
                <div class="tft-rms-card__overlay"></div>
              </div>
              <div class="tft-rms-card__content">
                <span class="tft-rms-card__count">120+ Items</span>
                <h2 class="tft-rms-card__title">Living Room</h2>
                <p class="tft-rms-card__desc">Architectural sofas, raw stone coffee tables, and textured lounge pairings.</p>
                <a href="{{ route('category.show', 'lounge') }}" class="tft-rms-card__link">
                  <span>EXPLORE COLLECTION</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
              </div>
            </article>

            <!-- Row 2: Bedroom & Dining Room -->
            <article class="tft-rms-card">
              <div class="tft-rms-card__bg-wrap">
                <img class="tft-rms-card__bg" src="{{ asset('assets/img/fur_room_bedroom.png') }}" alt="Minimal bedroom setup with white oak platform bed" width="680" height="420" loading="lazy">
                <div class="tft-rms-card__overlay"></div>
              </div>
              <div class="tft-rms-card__content">
                <span class="tft-rms-card__count">48 Items</span>
                <h2 class="tft-rms-card__title">Bedroom</h2>
                <p class="tft-rms-card__desc">Solid white oak bed platforms, bedside dressers, and organic linen bedding.</p>
                <a href="{{ route('category.show', 'bedroom') }}" class="tft-rms-card__link">
                  <span>EXPLORE COLLECTION</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
              </div>
            </article>

            <article class="tft-rms-card">
              <div class="tft-rms-card__bg-wrap">
                <img class="tft-rms-card__bg" src="{{ asset('assets/img/fur_room_dining.png') }}" alt="Dining room setup with round oak table" width="680" height="420" loading="lazy">
                <div class="tft-rms-card__overlay"></div>
              </div>
              <div class="tft-rms-card__content">
                <span class="tft-rms-card__count">65 Items</span>
                <h2 class="tft-rms-card__title">Dining Room</h2>
                <p class="tft-rms-card__desc">FSC solid oak tables, woven cord seating, and stone accent cabinets.</p>
                <a href="{{ route('category.show', 'dining') }}" class="tft-rms-card__link">
                  <span>EXPLORE COLLECTION</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
              </div>
            </article>

            <!-- Row 3: Home Office & Outdoor -->
            <article class="tft-rms-card">
              <div class="tft-rms-card__bg-wrap">
                <img class="tft-rms-card__bg" src="{{ asset('assets/img/fur_room_office.png') }}" alt="Home office desk setup" width="680" height="420" loading="lazy">
                <div class="tft-rms-card__overlay"></div>
              </div>
              <div class="tft-rms-card__content">
                <span class="tft-rms-card__count">32 Items</span>
                <h2 class="tft-rms-card__title">Home Office</h2>
                <p class="tft-rms-card__desc">Intentionally sized solid timber writing desks and supportive ergonomic chairs.</p>
                <a href="{{ route('category.show', 'office') }}" class="tft-rms-card__link">
                  <span>EXPLORE COLLECTION</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
              </div>
            </article>

            <article class="tft-rms-card">
              <div class="tft-rms-card__bg-wrap">
                <img class="tft-rms-card__bg" src="{{ asset('assets/img/fur_outdoor_space.png') }}" alt="Patio setup with solid wood sunlounger" width="680" height="420" loading="lazy">
                <div class="tft-rms-card__overlay"></div>
              </div>
              <div class="tft-rms-card__content">
                <span class="tft-rms-card__count">25 Items</span>
                <h2 class="tft-rms-card__title">Outdoor</h2>
                <p class="tft-rms-card__desc">Weather-resistant teak armchairs, modular sofas, and concrete coffee stones.</p>
                <a href="{{ route('category.show', 'tables') }}" class="tft-rms-card__link">
                  <span>EXPLORE COLLECTION</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
              </div>
            </article>

          </div>
        </div>
      </section>

      <!-- SYSTEM LEVEL: FOOTER -->
@endsection
