@extends('layouts.app')

@section('title', 'Shop by Material — Bharat Art & Craft')
@section('meta_description', 'Shop our premium handcrafted furniture collections grouped by natural wood timbers, Italian stone finishes, and woven textile swatches.')

@section('content')
  <h1 class="sr-only">Shop by Material — Bharat Art & Craft Atelier</h1>

  <!-- SCROLLED STICKY HEADER -->
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
  <section class="tft-post-hero" id="wp-block-materials-hero">
    <img class="tft-post-hero__img" src="{{ asset('assets/img/fur_materials_showcase.png') }}"
      alt="Natural material tactile surfaces" width="1920" height="700" loading="eager">
    <div class="tft-post-hero__overlay"></div>
    <div class="tft-post-hero__content">
      <div class="tft-post-hero__breadcrumb">
        <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp;
        <a href="{{ route('shop') }}">Shop</a> &nbsp;&rarr;&nbsp;
        <span>Shop by Material</span>
      </div>
      <span class="tft-post-hero__tag">TACTILE ESSENCE</span>
      <h2 class="tft-post-hero__title">Shop by Material</h2>
      <p class="tft-post-hero__desc">Explore our custom furniture designs grouped by natural raw tactile finishes and
        fabric weaves.</p>
    </div>
  </section>
  <!-- /wp:section -->

  <!-- SWATCH TABS TRIGGER PANEL -->
  <section class="tft-mat-swatches-sec" id="wp-block-materials-selector">
    <h2 class="sr-only">Materials selector</h2>
    <h2 class="sr-only">Materials selector</h2>
    <div class="tft-mat-swatches-sec__container">

      <div class="tft-mat-tabs" role="tablist" aria-label="Material Collections">

        <button class="tft-mat-tab tft-mat-tab--active" role="tab" aria-selected="true" aria-controls="tft-mat-pane-oak"
          id="tft-tab-oak" data-tft-click="switch-tab" data-tft-tab="oak">
          <img src="{{ asset('assets/img/fur_mat_oak.png') }}" alt="Oak swatch" class="tft-mat-tab__img" width="56"
            height="56" loading="lazy">
          <span class="tft-mat-tab__info">
            <strong class="tft-mat-tab__name">European Oak</strong>
            <span class="tft-mat-tab__count">24 Products</span>
          </span>
        </button>

        <button class="tft-mat-tab" role="tab" aria-selected="false" aria-controls="tft-mat-pane-walnut"
          id="tft-tab-walnut" data-tft-click="switch-tab" data-tft-tab="walnut">
          <img src="{{ asset('assets/img/fur_mat_leather.png') }}" alt="Walnut Swatch" class="tft-mat-tab__img" width="56"
            height="56" loading="lazy">
          <span class="tft-mat-tab__info">
            <strong class="tft-mat-tab__name">Dark Walnut</strong>
            <span class="tft-mat-tab__count">18 Products</span>
          </span>
        </button>

        <button class="tft-mat-tab" role="tab" aria-selected="false" aria-controls="tft-mat-pane-travertine"
          id="tft-tab-travertine" data-tft-click="switch-tab" data-tft-tab="travertine">
          <img src="{{ asset('assets/img/fur_mat_marble.png') }}" alt="Travertine swatch" class="tft-mat-tab__img"
            width="56" height="56" loading="lazy">
          <span class="tft-mat-tab__info">
            <strong class="tft-mat-tab__name">Travertine Stone</strong>
            <span class="tft-mat-tab__count">10 Products</span>
          </span>
        </button>

        <button class="tft-mat-tab" role="tab" aria-selected="false" aria-controls="tft-mat-pane-linen" id="tft-tab-linen"
          data-tft-click="switch-tab" data-tft-tab="linen">
          <img src="{{ asset('assets/img/fur_mat_linen.png') }}" alt="Linen swatch" class="tft-mat-tab__img" width="56"
            height="56" loading="lazy">
          <span class="tft-mat-tab__info">
            <strong class="tft-mat-tab__name">Belgian Linen</strong>
            <span class="tft-mat-tab__count">22 Products</span>
          </span>
        </button>

        <button class="tft-mat-tab" role="tab" aria-selected="false" aria-controls="tft-mat-pane-boucle"
          id="tft-tab-boucle" data-tft-click="switch-tab" data-tft-tab="boucle">
          <img src="{{ asset('assets/img/fur_mat_boucle.png') }}" alt="Boucle swatch" class="tft-mat-tab__img" width="56"
            height="56" loading="lazy">
          <span class="tft-mat-tab__info">
            <strong class="tft-mat-tab__name">Ivory Bouclé</strong>
            <span class="tft-mat-tab__count">14 Products</span>
          </span>
        </button>

      </div>

    </div>
  </section>

  <!-- SWATCH PANES GRID -->
  <section class="tft-mat-grid-sec" id="wp-block-materials-catalog">
    <div class="tft-mat-grid-sec__container">

      <!-- PANE: European Oak -->
      <div class="tft-mat-pane tft-mat-pane--active" id="tft-mat-pane-oak" role="tabpanel" aria-labelledby="tft-tab-oak">
        <div class="tft-mat-pane__header">
          <h2 class="tft-mat-pane__title">Solid European White Oak Collection</h2>
          <p class="tft-mat-pane__desc">Silky natural timber grains sanded by hand and sealed with a plant-based matte
            protective coat.</p>
        </div>

        <div class="tft-mat-products-grid">

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fp_table_oak_round.png') }}"
                alt="Oak Dining Table" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Solid Oak Dining Table</h3>
              <span class="tft-mat-item-card__price">$2,190</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="oak-table" data-tft-title="Solid Oak Dining Table" data-tft-cbm="2190"
                data-tft-image="assets/img/fp_table_oak_round.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_chair_oak.png') }}" alt="Oak Chair"
                width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Solid Oak Dining Chair</h3>
              <span class="tft-mat-item-card__price">$590</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="oak-chair" data-tft-title="Solid Oak Dining Chair" data-tft-cbm="590"
                data-tft-image="assets/img/fur_chair_oak.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_prod_sideboard_dark.png') }}"
                alt="Oak Sideboard" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Atelier Wood Credenza</h3>
              <span class="tft-mat-item-card__price">$2,490</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="wood-cred" data-tft-title="Atelier Wood Credenza" data-tft-cbm="2490"
                data-tft-image="assets/img/fur_prod_sideboard_dark.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_prod_nightstand.png') }}"
                alt="Oak Bedside Table" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Nordic Bedside Table</h3>
              <span class="tft-mat-item-card__price">$750</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="nord-bed" data-tft-title="Nordic Bedside Table" data-tft-cbm="750"
                data-tft-image="assets/img/fur_prod_nightstand.png">Enquire Now</button>
            </div>
          </article>

        </div>
      </div>

      <!-- PANE: Walnut -->
      <div class="tft-mat-pane" id="tft-mat-pane-walnut" role="tabpanel" aria-labelledby="tft-tab-walnut">
        <div class="tft-mat-pane__header">
          <h2 class="tft-mat-pane__title">Dark Aniline Walnut Collection</h2>
          <p class="tft-mat-pane__desc">Deep walnut chocolate tones, showcasing architectural contrast and structural
            strength.</p>
        </div>

        <div class="tft-mat-products-grid">

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_chair_walnut.png') }}"
                alt="Walnut Dining Chair" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Solid Walnut Dining Chair</h3>
              <span class="tft-mat-item-card__price">$580</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="wal-chair" data-tft-title="Solid Walnut Dining Chair" data-tft-cbm="580"
                data-tft-image="assets/img/fur_chair_walnut.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_prod_desk.png') }}"
                alt="Walnut Writing Desk" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Atelier Walnut Writing Desk</h3>
              <span class="tft-mat-item-card__price">$1,490</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="wal-desk" data-tft-title="Atelier Walnut Writing Desk" data-tft-cbm="1490"
                data-tft-image="assets/img/fur_prod_desk.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_prod_wardrobe.png') }}"
                alt="Walnut Armoire Wardrobe" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Walnut Armoire Wardrobe</h3>
              <span class="tft-mat-item-card__price">$3,490</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="wal-ward" data-tft-title="Walnut Armoire Wardrobe" data-tft-cbm="3490"
                data-tft-image="assets/img/fur_prod_wardrobe.png">Enquire Now</button>
            </div>
          </article>

        </div>
      </div>

      <!-- PANE: Travertine Stone -->
      <div class="tft-mat-pane" id="tft-mat-pane-travertine" role="tabpanel" aria-labelledby="tft-tab-travertine">
        <div class="tft-mat-pane__header">
          <h2 class="tft-mat-pane__title">Honed Cream Travertine Marble</h2>
          <p class="tft-mat-pane__desc">Italian travertine blocks, keeping open geologic pores and sculptural weight
            intact.</p>
        </div>

        <div class="tft-mat-products-grid">

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fp_table_coffee_travertine.png') }}"
                alt="Travertine Coffee Table" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Rondo Travertine Coffee Table</h3>
              <span class="tft-mat-item-card__price">$1,090</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="trav-coffee" data-tft-title="Rondo Travertine Coffee Table" data-tft-cbm="1090"
                data-tft-image="assets/img/fp_table_coffee_travertine.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fp_table_marble.png') }}"
                alt="Travertine Block Side Table" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Travertine Block Side Table</h3>
              <span class="tft-mat-item-card__price">$650</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="trav-side" data-tft-title="Travertine Block Side Table" data-tft-cbm="650"
                data-tft-image="assets/img/fp_table_marble.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_chair_stone.png') }}"
                alt="Travertine Sculptural Stool" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Travertine Accent Pedestal</h3>
              <span class="tft-mat-item-card__price">$850</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="trav-ped" data-tft-title="Travertine Accent Pedestal" data-tft-cbm="850"
                data-tft-image="assets/img/fur_chair_stone.png">Enquire Now</button>
            </div>
          </article>

        </div>
      </div>

      <!-- PANE: Belgian Linen -->
      <div class="tft-mat-pane" id="tft-mat-pane-linen" role="tabpanel" aria-labelledby="tft-tab-linen">
        <div class="tft-mat-pane__header">
          <h2 class="tft-mat-pane__title">Organic Flax Linen Collection</h2>
          <p class="tft-mat-pane__desc">Belgian-sourced linen fibres, offering loose relaxed breathability and beautiful
            drape.</p>
        </div>

        <div class="tft-mat-products-grid">

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_sofa_linen.png') }}" alt="Como Linen Sofa"
                width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Como Linen Sofa</h3>
              <span class="tft-mat-item-card__price">$2,890</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="lin-sofa" data-tft-title="Como Linen Sofa" data-tft-cbm="2890"
                data-tft-image="assets/img/fur_sofa_linen.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fp_sofa_linen.png') }}"
                alt="Linen Lounge Armchair" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Linen Lounge Armchair</h3>
              <span class="tft-mat-item-card__price">$1,190</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="lin-arm" data-tft-title="Linen Lounge Armchair" data-tft-cbm="1190"
                data-tft-image="assets/img/fp_sofa_linen.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_mat_linen.png') }}"
                alt="Linen Accent Pillow" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Organic Linen Cushion</h3>
              <span class="tft-mat-item-card__price">$120</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="lin-cush" data-tft-title="Organic Linen Cushion" data-tft-cbm="120"
                data-tft-image="assets/img/fur_mat_linen.png">Enquire Now</button>
            </div>
          </article>

        </div>
      </div>

      <!-- PANE: Ivory Bouclé -->
      <div class="tft-mat-pane" id="tft-mat-pane-boucle" role="tabpanel" aria-labelledby="tft-tab-boucle">
        <div class="tft-mat-pane__header">
          <h2 class="tft-mat-pane__title">Tactile Ivory Wool Bouclé</h2>
          <p class="tft-mat-pane__desc">High-loop premium wool fibers, adding sensory warmth and organic volume.</p>
        </div>

        <div class="tft-mat-products-grid">

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_chair_boucle.png') }}"
                alt="Bouclé Lounge Chair" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Calma Bouclé Chair</h3>
              <span class="tft-mat-item-card__price">$1,190</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="bouc-chair" data-tft-title="Calma Bouclé Chair" data-tft-cbm="1190"
                data-tft-image="assets/img/fur_chair_boucle.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_sofa_boucle.png') }}"
                alt="Bouclé Sectional Module" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Como Bouclé Modular Sofa</h3>
              <span class="tft-mat-item-card__price">$2,990</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="bouc-sofa" data-tft-title="Como Bouclé Modular Sofa" data-tft-cbm="2990"
                data-tft-image="assets/img/fur_sofa_boucle.png">Enquire Now</button>
            </div>
          </article>

          <article class="tft-mat-item-card">
            <div class="tft-mat-item-card__img-wrap">
              <img class="tft-mat-item-card__img" src="{{ asset('assets/img/fur_mat_boucle.png') }}"
                alt="Boucle footstool ottoman" width="300" height="220" loading="lazy">
            </div>
            <div class="tft-mat-item-card__body">
              <h3 class="tft-mat-item-card__title">Bouclé Accent Ottoman</h3>
              <span class="tft-mat-item-card__price">$450</span>
              <button type="button" class="tft-mat-item-card__add" data-tft-click="add-material-item"
                data-tft-id="bouc-otto" data-tft-title="Bouclé Accent Ottoman" data-tft-cbm="450"
                data-tft-image="assets/img/fur_mat_boucle.png">Enquire Now</button>
            </div>
          </article>

        </div>
      </div>

    </div>
  </section>

  <!-- START: NEW MATERIAL INFORMATION SECTION -->
  <section class="tft-mat-care" id="wp-block-materials-care">
    <div class="tft-mat-care__header">
      <span class="tft-mat-care__tagline">Care & Preservation</span>
      <h2 class="tft-mat-care__title">Nurturing Natural Character</h2>
      <p class="tft-mat-care__desc">Sustainably sourced raw materials grow and evolve with age. Follow our tailored
        maintenance protocols to safeguard their textures for generations.</p>
    </div>
    <div class="tft-mat-care__grid">
      <article class="tft-mat-care__card">
        <div class="tft-mat-care__card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <path d="M12 22V12m0 0l-4-4m4 4l4-4m-4-6a4 4 0 0 0-4 4c0 3 4 8 4 8s4-5 4-8a4 4 0 0 0-4-4z" />
          </svg>
        </div>
        <h3 class="tft-mat-care__card-title">European Oak</h3>
        <p class="tft-mat-care__card-text">Wipe spills immediately with a dry cloth. Use zero-VOC hardwax wood oil twice a
          year to restore the original matte moisture shield and block dust settlement.</p>
      </article>

      <article class="tft-mat-care__card">
        <div class="tft-mat-care__card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0" />
          </svg>
        </div>
        <h3 class="tft-mat-care__card-title">Dark Walnut</h3>
        <p class="tft-mat-care__card-text">Avoid direct, prolonged window sunlight to preserve deep chocolate aniline
          tones. Clean with a damp microfibre cloth and coat with organic beeswax annually.</p>
      </article>

      <article class="tft-mat-care__card">
        <div class="tft-mat-care__card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <path
              d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
          </svg>
        </div>
        <h3 class="tft-mat-care__card-title">Travertine Stone</h3>
        <p class="tft-mat-care__card-text">Porous stone requires gentle handling. Only clean with neutral-pH stone soap.
          Apply mineral stone sealers to maintain geological block barriers against wine and acidic coffee stain drops.
        </p>
      </article>

      <article class="tft-mat-care__card">
        <div class="tft-mat-care__card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
          </svg>
        </div>
        <h3 class="tft-mat-care__card-title">Weaves & Linens</h3>
        <p class="tft-mat-care__card-text">Vacuum boucle and linen upholstery weekly using low-suction soft brush
          attachments. For spill spots, blot gently with clean warm water, never rub the fiber loops.</p>
      </article>
    </div>
  </section>

  <section class="tft-mat-sampler" id="wp-block-materials-sampler">
    <div class="tft-mat-sampler__container">
      <div class="tft-mat-sampler__content">
        <span class="tft-mat-sampler__tagline">Atelier Sample Box</span>
        <h2 class="tft-mat-sampler__title">Experience Textures at Home</h2>
        <p class="tft-mat-sampler__desc">Choosing furniture is a highly tactile process. Order our signature sample kit
          including hand-cut blocks of European Oak, Aniline Walnut, cream Travertine stone, organic Belgian flax linen,
          and heavy loops of ivory boucle. The cost is fully credited back to your first custom order.</p>
        <button type="button" class="tft-mat-sampler__cta" id="tft-sampler-request-btn">Request Swatch Kit — $15</button>
      </div>
      <div class="tft-mat-sampler__visual">
        <div class="tft-mat-sampler__img-frame">
          <img class="tft-mat-sampler__img" src="{{ asset('assets/img/atelier_swatch_box.png') }}"
            alt="Atelier Swatch and timber Sample Box showing oak, walnut, travertine, linen, and boucle" width="560"
            height="420" loading="lazy">
        </div>
      </div>
    </div>
  </section>
  <!-- END: NEW MATERIAL INFORMATION SECTION -->

  <!-- SYSTEM LEVEL: FOOTER -->
@endsection