@extends('layouts.app')

@section('title', 'About Bharat Art & Craft — Sustainable Artisan Craftsmanship')
@section('meta_description', 'Read about our design philosophy, creative vision, and commitment to 100% sustainable wood and raw linen materials.')

@section('content')
  <h1 class="sr-only">About Bharat Art &amp; Craft &mdash; Our Story &amp; Atelier</h1>

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

  <!-- ABOUT US SECTION -->
  <section id="wp-block-about-hero" class="tft-shop-catalog">
    <!-- POST HERO SECTION -->
    <section class="tft-post-hero" id="wp-block-about-hero-section">
      <img class="tft-post-hero__img" src="{{ $about?->image_url ?? asset('assets/img/fur_lookbook_kitchen.png') }}"
        alt="{{ $about->title ?? 'Furniture Design Studio Workshop' }}" width="1920" height="700" loading="eager">
      <div class="tft-post-hero__overlay"></div>
      <div class="tft-post-hero__content">
        <div class="tft-post-hero__breadcrumb">
          <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp;
          <span>Our Story</span>
        </div>
        <span class="tft-post-hero__tag">Our Vision</span>
        <h2 class="tft-post-hero__title">{{ $about->title ?? 'Crafting Spaces for Intentional Living' }}</h2>
        <p class="tft-post-hero__desc">{{ $about?->excerpt ?: 'We believe that home is more than a physical space. It is a sanctuary for reflection, clarity, and connection. Our pieces are sculpted to highlight the quiet brilliance of raw nature.' }}</p>
      </div>
    </section>

    <div class="tft-shop-catalog__layout tft-philosophy-layout" style="gap: 60px; margin-block: 60px;">
      <div>
        <span class="tft-shop-catalog__tag">Philosophy</span>
        <h2 class="tft-shop-catalog__title" style="font-size: var(--fur-fs-h2);">Honest Materials, Pure Silhouettes</h2>
        <p class="tft-shop-catalog__subtitle" style="margin-block-start: 16px; line-height: 1.8;">
          Inspired by the dialogue between Japanese simplicity and Scandinavian warmth (Japandi), our designers focus on
          stripping away the unnecessary noise.
          <br><br>
          Every joint is engineered to balance load, and every surface is hand-finished with organic oils. The result is a
          collection of silent sculptures that integrate effortlessly with modern architectural plans.
        </p>
      </div>

      <!-- Philosophy Features with Premium SVG Icons -->
      <div class="tft-about-features">
        <div class="tft-about-features__card">
          <div class="tft-about-features__icon-wrap">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
              <path d="M12 22V12m0 0l-4-4m4 4l4-4m-4-6a4 4 0 0 0-4 4c0 3 4 8 4 8s4-5 4-8a4 4 0 0 0-4-4z" />
            </svg>
          </div>
          <div class="tft-about-features__body">
            <h3 class="tft-about-features__title">100% FSC European Oak</h3>
            <p class="tft-about-features__desc">Every timber beam originates from responsibly managed forests in France
              and Germany, upholding strict biodiversity conservation rules.</p>
          </div>
        </div>

        <div class="tft-about-features__card">
          <div class="tft-about-features__icon-wrap">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
              <path d="M3 10h18M3 14h18M10 3v18M14 3v18M6 3v18M18 3v18" />
            </svg>
          </div>
          <div class="tft-about-features__body">
            <h3 class="tft-about-features__title">Artisan Hand-Stretched Weaves</h3>
            <p class="tft-about-features__desc">Our tactile boucle, linen, and wool fabrics are spun and dyed locally
              using organic natural extracts free of chemicals.</p>
          </div>
        </div>

        <div class="tft-about-features__card">
          <div class="tft-about-features__icon-wrap">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
              <rect x="1" y="3" width="15" height="13" rx="2" />
              <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
              <circle cx="5.5" cy="18.5" r="2.5" />
              <circle cx="18.5" cy="18.5" r="2.5" />
              <path d="M10 9a3 3 0 0 1 3-3" />
            </svg>
          </div>
          <div class="tft-about-features__body">
            <h3 class="tft-about-features__title">Carbon-Neutral Delivery</h3>
            <p class="tft-about-features__desc">We offset all delivery miles and utilize flat-packed component systems
              where appropriate to minimize layout footprint.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- CORE VALUES GRID -->
    <div class="tft-shop-catalog__header" style="margin-top: 100px; text-align: center;">
      <span class="tft-shop-catalog__tag">Our Values</span>
      <h2 class="tft-shop-catalog__title">How We Design</h2>
    </div>

    <!-- Premium Value Cards with Unique Icons -->
    <div class="tft-values-grid" style="margin-block-end: 60px;">
      <article class="tft-value-card">
        <div class="tft-value-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <circle cx="12" cy="12" r="10" />
            <rect x="8" y="8" width="8" height="8" />
          </svg>
        </div>
        <h3 class="tft-value-card__title">Design Purity</h3>
        <p class="tft-value-card__desc">Functional, minimal shapes designed to breathe space and light into modern
          apartment layouts.</p>
      </article>

      <article class="tft-value-card">
        <div class="tft-value-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <line x1="9" y1="3" x2="9" y2="21" />
            <line x1="15" y1="3" x2="15" y2="21" />
            <line x1="3" y1="9" x2="21" y2="9" />
            <line x1="3" y1="15" x2="21" y2="15" />
          </svg>
        </div>
        <h3 class="tft-value-card__title">Metric Precision &amp; Bespoke Dimensions</h3>
        <p class="tft-value-card__desc">Every product footprint matches your custom room dimensions, handcrafted with millimeter precision by master artisans.</p>
      </article>

      <article class="tft-value-card">
        <div class="tft-value-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <path
              d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
          </svg>
        </div>
        <h3 class="tft-value-card__title">Artisanal Heritage</h3>
        <p class="tft-value-card__desc">Bridging historical joinery methods with advanced laser-guided precision cutting
          systems.</p>
      </article>

      <article class="tft-value-card">
        <div class="tft-value-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
            <path d="M2 12h20" />
          </svg>
        </div>
        <h3 class="tft-value-card__title">Radical Transparency</h3>
        <p class="tft-value-card__desc">No middleman markups. Direct material-to-collector supply chains that honor
          skilled woodworkers.</p>
      </article>
    </div>

    <!-- PREMIUM SUSTAINABILITY STATS SECTION WITH FLOATING ICONS -->
    <section id="wp-block-sustainability-stats" class="tft-sustainability-stats">
      <h2 class="sr-only">Sustainability statistics</h2>
      <div class="tft-sustainability-stats__container">
        <div class="tft-sustainability-stats__item">
          <div class="tft-sustainability-stats__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
              <path d="M12 19V6M12 6l-4 4m4-4l4 4M5 20h14" />
            </svg>
          </div>
          <span class="tft-sustainability-stats__val" data-count="12500" data-suffix="+">0</span>
          <span class="tft-sustainability-stats__label">Trees Planted & Growing</span>
        </div>

        <div class="tft-sustainability-stats__item">
          <div class="tft-sustainability-stats__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg>
          </div>
          <span class="tft-sustainability-stats__val" data-count="100" data-suffix="%">0</span>
          <span class="tft-sustainability-stats__label">FSC Solid European Oak</span>
        </div>

        <div class="tft-sustainability-stats__item">
          <div class="tft-sustainability-stats__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
              <circle cx="12" cy="12" r="10" />
              <path d="M12 6a6 6 0 0 1 6 6M12 18v-6" />
            </svg>
          </div>
          <span class="tft-sustainability-stats__val" data-count="0" data-suffix=" kg">0</span>
          <span class="tft-sustainability-stats__label">Net Carbon Emissions</span>
        </div>
      </div>
    </section>

    <!-- MEET THE ARTISANS WITH CUSTOM HIGH-FIDELITY PORTRAIT PHOTO ASSETS -->
    <section id="wp-block-artisans" class="tft-artisans-sec">
      <div class="tft-artisans-sec__container">
        <div class="tft-shop-catalog__header" style="text-align: center; margin-bottom: 48px;">
          <span class="tft-shop-catalog__tag">The Workshop</span>
          <h2 class="tft-shop-catalog__title">Meet the Masters Behind the Chisel</h2>
          <p class="tft-shop-catalog__subtitle" style="margin-inline: auto;">Our pieces carry the signature and pride of
            their makers. Meet the hands shaping raw wood into art.</p>
        </div>

        <div class="tft-artisans-grid">
          <article class="tft-artisans-card">
            <div class="tft-artisans-card__img-wrap">
              <img class="tft-artisans-card__img" src="{{ asset('assets/img/about_artisan_soren.png') }}"
                alt="Soren Lassen, Master Joiner" width="400" height="400" loading="lazy">
            </div>
            <div class="tft-artisans-card__body">
              <h3 class="tft-artisans-card__name">Soren Lassen</h3>
              <span class="tft-artisans-card__role">Master Joiner, Copenhagen Studio</span>
              <p class="tft-artisans-card__bio">With over 24 years of custom woodworking experience, Soren focuses on
                standard wood dowelling, Japanese mortise-and-tenon connections, and custom ash selection.</p>
            </div>
          </article>

          <article class="tft-artisans-card">
            <div class="tft-artisans-card__img-wrap">
              <img class="tft-artisans-card__img" src="{{ asset('assets/img/about_artisan_elena.png') }}"
                alt="Elena Rostova, Senior Textile Weaver" width="400" height="400" loading="lazy">
            </div>
            <div class="tft-artisans-card__body">
              <h3 class="tft-artisans-card__name">Elena Rostova</h3>
              <span class="tft-artisans-card__role">Senior Textile Weaver, Antwerp Studio</span>
              <p class="tft-artisans-card__bio">Elena oversees our premium upholstery processes. She ensures every piece
                of bouclé or organic Belgian linen is tensioned properly by hand for generations of use.</p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- Section 1: Material Swatch Explorer with Tactile Cards and Meta Info -->
    <section id="wp-block-material-swatch-explorer" class="tft-material-explorer" style="margin-block-start: 100px;">
      <div class="tft-shop-catalog__header" style="text-align: center; margin-block-end: 48px;">
        <span class="tft-shop-catalog__tag">Interactive Materials</span>
        <h2 class="tft-shop-catalog__title">Material Swatch Explorer</h2>
        <p class="tft-shop-catalog__subtitle" style="margin-inline: auto; max-width: 600px;">Interact with our curated
          library of raw components. Select any swatch to view technical specifications, regional origins, and featured
          products.</p>
      </div>

      <div class="tft-material-explorer__container">
        <!-- Left Side: Swatch Grid -->
        <div class="tft-material-explorer__swatches">
          <button class="fur-swatches__item fur-swatches__item--active" data-material="oak"
            aria-label="Warm Solid White Oak">
            <span class="tft-material-explorer__swatch-circle"
              style="background-color: #e3d2bf; border: 1px solid #d5c0aa;"></span>
            <span class="fur-swatches__item-text">
              <span class="tft-material-explorer__swatch-name">Solid White Oak</span>
              <span class="fur-swatches__item-sub">Solid Hardwood</span>
            </span>
            <svg class="fur-swatches__item-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>

          <button class="fur-swatches__item" data-material="boucle" aria-label="Textured Bouclé Wool">
            <span class="tft-material-explorer__swatch-circle"
              style="background-color: #f6f5f2; border: 1px solid #e1deda;"></span>
            <span class="fur-swatches__item-text">
              <span class="tft-material-explorer__swatch-name">Textured Bouclé</span>
              <span class="fur-swatches__item-sub">Tactile Weave</span>
            </span>
            <svg class="fur-swatches__item-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>

          <button class="fur-swatches__item" data-material="marble" aria-label="Travertine Marble">
            <span class="tft-material-explorer__swatch-circle"
              style="background-color: #dfdbd3; border: 1px solid #c8c2b7;"></span>
            <span class="fur-swatches__item-text">
              <span class="tft-material-explorer__swatch-name">Travertine Marble</span>
              <span class="fur-swatches__item-sub">Natural Stone</span>
            </span>
            <svg class="fur-swatches__item-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>

          <button class="fur-swatches__item" data-material="leather" aria-label="Full-Grain Sienna Leather">
            <span class="tft-material-explorer__swatch-circle"
              style="background-color: #a05a3c; border: 1px solid #8e4e32;"></span>
            <span class="fur-swatches__item-text">
              <span class="tft-material-explorer__swatch-name">Sienna Leather</span>
              <span class="fur-swatches__item-sub">Premium Hide</span>
            </span>
            <svg class="fur-swatches__item-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>

          <button class="fur-swatches__item" data-material="brass" aria-label="Hand-Brushed Brass">
            <span class="tft-material-explorer__swatch-circle"
              style="background-color: #d4af37; border: 1px solid #c59f2c;"></span>
            <span class="fur-swatches__item-text">
              <span class="tft-material-explorer__swatch-name">Hand-Brushed Brass</span>
              <span class="fur-swatches__item-sub">Architectural Alloy</span>
            </span>
            <svg class="fur-swatches__item-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>
        </div>

        <!-- Right Side: Spec details panel (initialized with 'oak') -->
        <div class="tft-material-explorer__detail-wrap" id="fur-swatch-detail-container">
          <div class="fur-swatches__detail-block">
            <span class="fur-swatches__detail-category">Solid Hardwood</span>
            <h3 class="fur-swatches__detail-title">Warm Solid White Oak</h3>
            <p class="fur-swatches__detail-text">Sourced from sustainably managed forests in the Baltic region. Kiln-dried
              and finished with a zero-VOC matte hardwax oil to preserve the raw grain, texture, and natural golden hues.
            </p>

            <div class="fur-swatches__meta-row">
              <div class="fur-swatches__meta-col">
                <span class="fur-swatches__meta-label">Origin</span>
                <span class="fur-swatches__meta-val">Baltic Forests</span>
              </div>
              <div class="fur-swatches__meta-col">
                <span class="fur-swatches__meta-label">Recommended Pairing</span>
                <span class="fur-swatches__meta-val">Textured Bouclé Wool, Brushed Brass</span>
              </div>
            </div>

            <div class="fur-swatches__products-row">
              <span class="fur-swatches__meta-label">Featured Products</span>
              <div class="fur-swatches__products-list">
                <span class="fur-swatches__prod-tag">Linea Writing Desk</span>
                <span class="fur-swatches__prod-tag">Sven Dining Table</span>
                <span class="fur-swatches__prod-tag">Nora Bed Frame</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 2: Slow Craft Timeline with Custom Stage SVGs -->
    <section id="wp-block-slow-craft-timeline" class="tft-slow-craft"
      style="margin-block-start: 100px; margin-block-end: 100px;">
      <div class="tft-slow-craft__container">
        <div class="tft-shop-catalog__header" style="text-align: center; margin-block-end: 60px;">
          <span class="tft-shop-catalog__tag">The Timeline</span>
          <h2 class="tft-shop-catalog__title">The Slow Craft Process</h2>
          <p class="tft-shop-catalog__subtitle" style="margin-inline: auto; max-width: 600px;">Every piece of Bharat Art &amp; Craft is
            built to outlast generations. See the stages of patience and precision behind each silhouette.</p>
        </div>

        <div class="tft-slow-craft__timeline">
          <!-- Timeline Line -->
          <div class="tft-slow-craft__line"></div>

          <!-- Step 1 -->
          <div class="tft-slow-craft__step">
            <div class="tft-slow-craft__node">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
                <path d="M12 2L2 22h20L12 2z" />
              </svg>
            </div>
            <div class="tft-slow-craft__content">
              <span class="tft-slow-craft__phase">Timber Selection</span>
              <h3 class="tft-slow-craft__step-title">1. Raw Log Selection & Seasoning</h3>
              <p class="tft-slow-craft__step-desc">We personally inspect and select sustainably grown European Oak logs
                based on grain symmetry, lack of defects, and moisture content. The logs are air-seasoned for up to 12
                months to guarantee dimensional stability before cutting.</p>
            </div>
          </div>

          <!-- Step 2 -->
          <div class="tft-slow-craft__step">
            <div class="tft-slow-craft__node">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <path d="M9 3v18M15 3v18M3 9h18M3 15h18" />
              </svg>
            </div>
            <div class="tft-slow-craft__content">
              <span class="tft-slow-craft__phase">Precision Milling</span>
              <h3 class="tft-slow-craft__step-title">2. CNC Precision Profile Cutting</h3>
              <p class="tft-slow-craft__step-desc">Bridging modern software with raw wood, computer-controlled milling
                machines carve out the preliminary profiles. This ensures micro-millimeter precision for interlocking
                joints, reducing material waste by up to 30%.</p>
            </div>
          </div>

          <!-- Step 3 -->
          <div class="tft-slow-craft__step">
            <div class="tft-slow-craft__node">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
                <path
                  d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
              </svg>
            </div>
            <div class="tft-slow-craft__content">
              <span class="tft-slow-craft__phase">Manual Joinery</span>
              <h3 class="tft-slow-craft__step-title">3. Traditional Mortise & Tenon Assembly</h3>
              <p class="tft-slow-craft__step-desc">Our master joiners assemble the components by hand using traditional
                dowels, mortise-and-tenon joints, and custom wood pegs. No metal screws or synthetic adhesives are used in
                our structural cores, honoring heritage techniques.</p>
            </div>
          </div>

          <!-- Step 4 -->
          <div class="tft-slow-craft__step">
            <div class="tft-slow-craft__node">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
            </div>
            <div class="tft-slow-craft__content">
              <span class="tft-slow-craft__phase">Organic Finishing</span>
              <h3 class="tft-slow-craft__step-title">4. Hand-Sand & Organic Matte Finish</h3>
              <p class="tft-slow-craft__step-desc">Each surface undergoes five passes of hand-sanding, down to a silky
                320-grit texture. Finally, we rub in three coats of zero-VOC organic hardwax oils, which protect the wood
                fibers while letting the oak breathe.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </section>

  <!-- DYNAMIC FOOTER -->
  <!-- DYNAMIC FOOTER -->
  <!-- SYSTEM LEVEL: FOOTER (PREMIUM REBUILD) -->
@endsection