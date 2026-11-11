@extends('layouts.app')

@section('title', 'Bharat Art & Craft — Modern & Timeless Spaces | Premium Furniture Shop')
@section('body_class', 'fur-body tft-redesign-layout tft-page-index')

@section('content')
    <!-- REDESIGNED TOP BAR -->
    <div class="tft-top-bar">
        <div class="tft-top-bar__search">
            <svg class="tft-top-bar__search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" autocomplete="off" placeholder="Search wooden furniture, handicrafts, bespoke decor..." aria-label="Search">
        </div>
        <div class="tft-top-bar__actions">

            <a href="{{ route('about') }}" class="tft-top-bar__action-btn" aria-label="About Atelier">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
            <button class="tft-top-bar__action-btn tft-top-bar__action-btn--cart fur-header__nav-btn--cart" aria-label="Quote Cart">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="8" cy="21" r="1"></circle>
                    <circle cx="19" cy="21" r="1"></circle>
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                </svg>
                <span class="tft-top-bar__cart-count fur-sidebar__cart-count">0</span>
            </button>
        </div>
    </div>

    <!-- TFT PREMIUM SPLIT HERO SECTION -->
    <section id="wp-block-hero-split" class="tft-hero-split" aria-label="Curated Solid Wood Furniture Collection">
        <div class="tft-hero-split__container">

            @php
                $primarySlide = $sliders->first();
            @endphp
            <!-- Left side: Curated for calm card -->
            <div class="tft-hero-split__left">
                <!-- Vertical Slider Dots -->
                <div class="tft-hero-split__dots-vertical">
                    <span class="tft-hero-split__vertical-dot tft-hero-split__vertical-dot--active"></span>
                    <span class="tft-hero-split__vertical-dot"></span>
                    <span class="tft-hero-split__vertical-dot"></span>
                </div>

                <div class="tft-hero-split__left-content">
                    <span class="tft-hero-split__tagline">{{ $primarySlide?->excerpt ?: 'AUTHENTIC HANDICRAFTS • BESPOKE SOLID WOOD' }}</span>
                    <h1 class="tft-hero-split__title">
                        @if($primarySlide && $primarySlide->title)
                            {!! nl2br(e($primarySlide->title)) !!}
                        @else
                            Naturally crafted. <br>Uniquely <span class="tft-hero-split__title-script">yours.</span>
                        @endif
                    </h1>
                    <p class="tft-hero-split__description">
                        {{ $primarySlide?->description ?: 'Timeless wooden furniture and heritage handicrafts carved from pure seasoned Teak, Sheesham, and Oak for spaces of enduring warmth.' }}
                    </p>
                    <div class="tft-hero-split__actions">
                        <a href="{{ route('shop') }}" class="tft-hero-split__btn-primary">
                            <span>Browse Furniture</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <a href="{{ route('consultation') }}" class="tft-hero-split__link-explore">
                            <span>Upload Your Custom Design &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right side: Cinematic Image Panel -->
            <div class="tft-hero-split__right"
                style="background-image: url('{{ $primarySlide?->image_url ?? asset('assets/img/fur_room_living.png') }}');">
                <div class="tft-hero-split__right-overlay"></div>

                <!-- Circular floating nature badge (Top-Right) -->
                <div class="tft-hero-split__nature-badge">
                    <svg class="tft-hero-split__badge-circle" viewBox="0 0 100 100" width="110" height="110">
                        <path id="badgePath" d="M 50, 50 m -38, 0 a 38,38 0 1,1 76,0 a 38,38 0 1,1 -76,0" fill="none" />
                        <text font-size="9" letter-spacing="1.5" fill="currentColor">
                            <textPath href="#badgePath">100% SOLID WOOD • ARTISAN CRAFTED •</textPath>
                        </text>
                    </svg>
                    <div class="tft-hero-split__badge-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path
                                d="M12 2a15 15 0 0 0-8.2 12.8c-.2 1 .3 2.1 1.3 2.3L12 19l6.9-1.9c1-.2 1.5-1.3 1.3-2.3A15 15 0 0 0 12 2z">
                            </path>
                            <path d="M12 2v17"></path>
                        </svg>
                    </div>
                </div>

                <!-- Bottom-Left White Overlay Card ("New In / Spring Collection 2026 / Discover Now") -->
                <div class="tft-hero-split__overlay-card">
                    <div class="tft-hero-split__card-info">
                        <span class="tft-hero-split__card-tag">{{ $primarySlide?->excerpt ?: 'NEW COLLECTION' }}</span>
                        <h2 class="tft-hero-split__card-title">{{ $primarySlide?->title ?: 'Handcrafted Masterpieces' }}</h2>
                        <a href="{{ route('shop') }}" class="tft-hero-split__card-cta">
                            <span>Discover Now</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    <div class="tft-hero-split__card-image-wrap">
                        <img src="{{ asset('assets/img/flower-transparent.png') }}" alt="Branch outline decor" width="60"
                            height="60" loading="lazy" class="tft-hero-split__card-branch">
                    </div>
                </div>

                <!-- Bottom-Right Slider Arrows -->
                <div class="tft-hero-split__arrows">
                    <button class="tft-hero-split__arrow-btn tft-hero-split__arrow-btn--prev"
                        aria-label="Previous slider slide">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </button>
                    <button class="tft-hero-split__arrow-btn tft-hero-split__arrow-btn--next"
                        aria-label="Next slider slide">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>



    <!-- TFT CATEGORY DECK SECTION -->
    <section id="wp-block-category-deck" class="tft-category-deck" aria-label="Curated collections and journal highlights">
        <div class="tft-category-deck__container">

            <!-- Card 1: Customized Enquiry Featured -->
            <article class="tft-category-deck__card tft-category-deck__card--featured">
                <div class="tft-category-deck__card-content">
                    <span class="tft-category-deck__card-tag">BESPOKE HANDICRAFT</span>
                    <h3 class="tft-category-deck__card-title">Upload your design,<br>we <span
                            class="tft-category-deck__card-title-italic">handcraft</span> it</h3>
                    <p class="tft-category-deck__card-desc">Share your sketches, Pinterest photos, or dimensions. Our master carpenters hand-carve it in pure Teak or Sheesham wood.</p>
                    <a href="{{ route('consultation') }}" class="tft-category-deck__card-link">
                        <span>UPLOAD CUSTOM DESIGN</span>
                        <span class="tft-category-deck__card-arrow-circle">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>
            </article>

            <!-- Dynamic Categories (Top 3) -->
            @foreach($categories->take(3) as $cIndex => $category)
            <article class="tft-category-deck__card tft-category-deck__card--split">
                <div class="tft-category-deck__split-image-wrap">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                        class="tft-category-deck__split-img" width="280" height="280" loading="lazy">
                    <div class="tft-category-deck__split-overlay">
                        <div class="tft-category-deck__split-header">
                            <span class="tft-category-deck__split-num">0{{ $cIndex + 1 }}</span>
                            <div class="tft-category-deck__split-icon-circle">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                                    <path d="M5 12v8M19 12v8M9 12v5M15 12v5"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tft-category-deck__card-body">
                    <h3 class="tft-category-deck__card-title">{{ strtoupper($category->name) }}</h3>
                    <p class="tft-category-deck__card-desc">{{ $category->description ?: 'Solid timber & bespoke artisan pieces.' }}</p>
                    <a href="{{ route('category.show', $category->slug) }}" class="tft-category-deck__card-link">
                        <span>EXPLORE {{ strtoupper($category->name) }}</span>
                        <span class="tft-category-deck__card-arrow">&rarr;</span>
                    </a>
                </div>
            </article>
            @endforeach

            <!-- Card 5: The Bharat Art & Craft Journal Dark Green -->
            <article class="tft-category-deck__card tft-category-deck__card--journal">
                <div class="tft-category-deck__card-content">
                    <span class="tft-category-deck__card-tag">WOODCRAFT JOURNAL</span>
                    <h3 class="tft-category-deck__card-title">Artisan stories, tips &amp;<br>heritage</h3>
                    <p class="tft-category-deck__card-desc">Discover centuries of Indian woodworking heritage, wood care guides, and artisanal craft techniques.</p>
                    <a href="{{ route('blog') }}" class="tft-category-deck__card-link">
                        <span>EXPLORE NOW</span>
                        <span class="tft-category-deck__card-arrow">&rarr;</span>
                    </a>
                </div>
                <div class="tft-category-deck__journal-image-wrap">
                    <img src="{{ asset('assets/img/ftn-zz.png') }}" alt="Journal inspiration"
                        class="tft-category-deck__journal-img" width="300" height="280" loading="lazy">
                </div>
            </article>

            <!-- TFT PREMIUM SERVICE STRIP -->
            <section class="tft-services-strip" aria-label="Core services and values">

                <!-- Left: 3 Service Features Row -->
                <div class="tft-services-strip__main-features">

                    <!-- Feature 1: Sustainable Materials -->
                    <div class="tft-services-strip__feature-col">
                        <div class="tft-services-strip__feature-icon-wrap">
                            <!-- Leaf Icon -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 3.58-1 9.58A7 7 0 0 1 11 20z">
                                </path>
                                <path d="M9 22v-4h4"></path>
                            </svg>
                        </div>
                        <div class="tft-services-strip__feature-content">
                            <h3 class="tft-services-strip__feature-title">SUSTAINABLE MATERIALS</h3>
                            <p class="tft-services-strip__feature-desc">Responsibly sourced, naturally beautiful.</p>
                        </div>
                    </div>

                    <!-- Feature 2: Quality You Can Trust -->
                    <div class="tft-services-strip__feature-col">
                        <div class="tft-services-strip__feature-icon-wrap">
                            <!-- Shield Check Icon -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 11 11 13 15 9"></polyline>
                            </svg>
                        </div>
                        <div class="tft-services-strip__feature-content">
                            <h3 class="tft-services-strip__feature-title">QUALITY YOU CAN TRUST</h3>
                            <p class="tft-services-strip__feature-desc">Crafted to last, backed by our lifetime warranty.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3: White-Glove Delivery -->
                    <div class="tft-services-strip__feature-col">
                        <div class="tft-services-strip__feature-icon-wrap">
                            <!-- Truck Icon -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        <div class="tft-services-strip__feature-content">
                            <h3 class="tft-services-strip__feature-title">WHITE-GLOVE DELIVERY</h3>
                            <p class="tft-services-strip__feature-desc">Delivered, assembled & placed with care.</p>
                        </div>
                    </div>

                </div>

                <!-- Right: Story Card -->
                <div class="tft-services-strip__story-card">
                    <div class="tft-services-strip__story-content">
                        <span class="tft-services-strip__story-tag">DESIGNING LIFE WITH PURPOSE</span>
                        <a href="{{ route('about') }}" class="tft-services-strip__story-link">
                            <span>LEARN OUR STORY</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    <!-- Leaf Vector Graphic Background / Overlay -->
                    <div class="tft-services-strip__story-leaf">
                        <svg width="84" height="110" viewBox="0 0 84 110" fill="none" stroke="currentColor"
                            stroke-width="1.2">
                            <path
                                d="M42 100V20M42 20C42 20 62 40 62 60C62 80 42 100 42 100M42 20C42 20 22 40 22 60C22 80 42 100 42 100"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M42 40C42 40 52 46 56 54" stroke-linecap="round" />
                            <path d="M42 55C42 55 52 61 56 69" stroke-linecap="round" />
                            <path d="M42 70C42 70 50 76 54 84" stroke-linecap="round" />
                            <path d="M42 40C42 40 32 46 28 54" stroke-linecap="round" />
                            <path d="M42 55C42 55 32 61 28 69" stroke-linecap="round" />
                            <path d="M42 70C42 70 34 76 30 84" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>

            </section>

        </div>
    </section>

    <!-- START OF NEW ELEMENT -->
    <!-- TFT PREMIUM MOODBOARD / MATERIAL PAIRINGS (wp-block-curator-notebook) -->

    <!-- END OF NEW ELEMENT -->

    <!-- REDESIGNED NEW ARRIVALS -->
    <section id="wp-block-new-arrivals" class="tft-new-arrivals" aria-label="New arrivals curated selection">
        <div class="tft-new-arrivals__container">

            <!-- Left Info Column -->
            <div class="tft-new-arrivals__info-col">
                <div class="tft-new-arrivals__tag">
                    <span>FRESH FINDS, TIMELESS APPEAL</span>
                </div>
                <h2 class="tft-new-arrivals__title">New <span class="tft-new-arrivals__title-script">Arrivals</span></h2>
                <p class="tft-new-arrivals__subtitle">Thoughtfully selected pieces to bring beauty, comfort, and balance
                    into your everyday living.</p>
                <a href="{{ route('shop') }}" class="tft-new-arrivals__cta-btn">
                    <span>Explore All New Arrivals</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>


            </div>

            <!-- Right Products Grid / Slider Column -->
            <div class="tft-new-arrivals__slider-col">
                <div class="tft-new-arrivals__grid-viewport">
                    <div class="tft-new-arrivals__grid">

                        @forelse($newArrivals->take(6) as $prod)
                        <article class="tft-product-card" data-prod-id="{{ $prod->id }}" data-id="{{ $prod->id }}">
                            <div class="tft-product-card__img-wrap">
                                <a href="{{ route('product.single', $prod->slug) }}" class="tft-product-card__img-link">
                                    <img class="tft-product-card__img" src="{{ $prod->image_url }}"
                                        alt="{{ $prod->title }}" width="280" height="280" loading="lazy"
                                        draggable="false">
                                </a>
                            </div>
                            <div class="tft-product-card__content">
                                <span class="tft-product-card__category">{{ $prod->category?->name ?? 'Furniture' }}</span>
                                <h3 class="tft-product-card__title"><a href="{{ route('product.single', $prod->slug) }}"
                                        class="tft-product-card__title-link">{{ $prod->title }}</a></h3>
                                <p class="tft-product-card__desc">{{ $prod->excerpt ?: Str::limit(strip_tags($prod->description ?? ''), 75) }}</p>
                                <div class="tft-product-card__footer">
                                    <span class="tft-product-card__cbm"><i class="bi bi-box-seam me-1"></i>{{ $prod->cbm ? $prod->cbm . ' CBM' : '0.45 CBM' }}</span>
                                    <button class="tft-product-card__add-to-cart" data-prod-id="{{ $prod->id }}" onclick="event.stopPropagation(); if(window.FUR_Theme) window.FUR_Theme.addToCart({{ $prod->id }})" aria-label="Add to Quote" title="Add to Quote">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                        @empty
                        <article class="tft-product-card">
                            <div class="tft-product-card__img-wrap">
                                <a href="{{ route('shop') }}" class="tft-product-card__img-link">
                                    <img class="tft-product-card__img" src="{{ asset('assets/img/fur_new_sideboard.png') }}"
                                        alt="Solid Wood Sideboard" width="280" height="280" loading="lazy" draggable="false">
                                </a>
                            </div>
                            <div class="tft-product-card__content">
                                <span class="tft-product-card__category">Furniture</span>
                                <h3 class="tft-product-card__title"><a href="{{ route('shop') }}" class="tft-product-card__title-link">Minimalist Sideboard</a></h3>
                                <p class="tft-product-card__desc">Clean lines, functional storage, timeless appeal.</p>
                                <div class="tft-product-card__footer">
                                    <span class="tft-product-card__cbm"><i class="bi bi-box-seam me-1"></i>0.65 CBM</span>
                                </div>
                            </div>
                        </article>
                        @endforelse

                    </div>
                </div>

                <!-- Dots progress indicator & arrow slider -->
                <div class="tft-new-arrivals__slider-controls">
                    <div class="tft-new-arrivals__dots">
                        <span class="tft-new-arrivals__dot tft-new-arrivals__dot--active"></span>
                        <span class="tft-new-arrivals__dot"></span>
                        <span class="tft-new-arrivals__dot"></span>
                        <span class="tft-new-arrivals__dot"></span>
                    </div>
                </div>

                <!-- Floating Next Arrow -->
                <button class="tft-new-arrivals__slider-next" aria-label="Next slide">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>

        </div>

        <!-- TFT PREMIUM SERVICE STRIP (NESTED INSIDE NEW ARRIVALS) -->
        <div class="tft-services-strip__nested-wrapper">
            <div class="tft-services-strip__container">

                <!-- Block 1: Design Services Capsule -->
                <article class="tft-service-card tft-service-card--capsule tft-service-card--services">
                    <div class="tft-service-card__left">
                        <span class="tft-service-card__tag">DESIGN SERVICES</span>
                        <h3 class="tft-service-card__title">Designed for your lifestyle</h3>
                        <p class="tft-service-card__desc">Work with our experts to create spaces that are uniquely yours.
                        </p>
                        <a href="{{ route('consultation') }}" class="tft-service-card__link-text">
                            <span>Explore Services</span>
                            <span class="tft-service-card__link-arrow">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="tft-service-card__right-arch">
                        <img src="{{ asset('assets/img/fur_services_armchair.png') }}"
                            alt="Japandi armchair interior concept" class="tft-service-card__arch-img" width="130"
                            height="150" loading="lazy">
                    </div>
                </article>

                <!-- Middle Column: 3 Features Column Layout -->
                <div class="tft-services-strip__middle-group">

                    <!-- Block 2: Natural Materials -->
                    <article class="tft-service-card tft-service-card--standard">
                        <div class="tft-service-card__icon-wrap">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 3.58-1 9.58A7 7 0 0 1 11 20z">
                                </path>
                                <path d="M9 22v-4h4"></path>
                            </svg>
                        </div>
                        <h3 class="tft-service-card__card-title">Natural Materials</h3>
                        <p class="tft-service-card__card-desc">Sustainably sourced for a better tomorrow.</p>
                        <div class="tft-service-card__accent-line"></div>
                    </article>

                    <!-- Block 3: Exclusive Designs -->
                    <article class="tft-service-card tft-service-card--standard">
                        <div class="tft-service-card__icon-wrap">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                </path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                        </div>
                        <h3 class="tft-service-card__card-title">Exclusive Designs</h3>
                        <p class="tft-service-card__card-desc">Unique collections you won't find anywhere else.</p>
                        <div class="tft-service-card__accent-line"></div>
                    </article>

                    <!-- Block 4: Loved by Many -->
                    <article class="tft-service-card tft-service-card--standard">
                        <div class="tft-service-card__icon-wrap">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="tft-service-card__card-title">Loved by Many</h3>
                        <p class="tft-service-card__card-desc">Join thousands of happy homes around the world.</p>
                        <div class="tft-service-card__accent-line"></div>
                    </article>

                </div>

                <!-- Block 5: The Bharat Art & Craft Journal Capsule -->
                <article class="tft-service-card tft-service-card--capsule tft-service-card--journal">
                    <div class="tft-service-card__left">
                        <span class="tft-service-card__tag">BHARAT ART &amp; CRAFT JOURNAL</span>
                        <h3 class="tft-service-card__title">Stories, tips &amp; inspiration</h3>
                        <a href="{{ route('blog') }}" class="tft-service-card__link-text">
                            <span>Explore More</span>
                            <span class="tft-service-card__link-arrow">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="tft-service-card__right-arch">
                        <img src="{{ asset('assets/img/fur_services_journal.png') }}" alt="Leaf plant and moody room"
                            class="tft-service-card__arch-img" width="130" height="150" loading="lazy">
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- TFT PREMIUM PRESS SHOWCASE SECTION -->
    <section id="wp-block-press-strip" class="tft-press-showcase" aria-label="As seen in publications">

        <!-- Center Branding & Logo Group -->
        <div class="tft-press-showcase__content">
            <div class="tft-press-showcase__brand-badge">
                <svg width="32" height="42" viewBox="0 0 24 32" fill="none" stroke="#c5a880" stroke-width="1.2">
                    <path d="M4 28V10C4 5.58 7.58 2 12 2s8 3.58 8 8v18" stroke-linecap="round" />
                    <path d="M12 20a4 4 0 0 0 4-4c0-3-4-6-4-6s-4 3-4 6a4 4 0 0 0 4 4z" />
                    <path d="M12 10v10" />
                </svg>
            </div>

            <div class="tft-press-showcase__subtitle-wrap">
                <span class="tft-press-showcase__subtitle-dot"></span>
                <span class="tft-press-showcase__subtitle-line"></span>
                <span class="tft-press-showcase__subtitle">AS SEEN IN</span>
                <span class="tft-press-showcase__subtitle-line"></span>
                <span class="tft-press-showcase__subtitle-dot"></span>
            </div>

            <h2 class="tft-press-showcase__title">Trusted. Recognized. Featured.</h2>
            <p class="tft-press-showcase__desc">Bharat Art &amp; Craft is proud to be featured in world-leading architecture, handicraft and lifestyle publications.</p>

            <!-- Logos Rounded Capsule -->
            <div class="tft-press-showcase__capsule">
                <span class="tft-press-showcase__logo-item tft-press-showcase__logo-item--dezeen">dezeen</span>
                <span class="tft-press-showcase__divider">|</span>
                <span class="tft-press-showcase__logo-item tft-press-showcase__logo-item--ad">AD</span>
                <span class="tft-press-showcase__divider">|</span>
                <span class="tft-press-showcase__logo-item tft-press-showcase__logo-item--elle">ELLE DECOR</span>
                <span class="tft-press-showcase__divider">|</span>
                <span class="tft-press-showcase__logo-item tft-press-showcase__logo-item--vogue">VOGUE LIVING</span>
                <span class="tft-press-showcase__divider">|</span>
                <span class="tft-press-showcase__logo-item tft-press-showcase__logo-item--wallpaper">Wallpaper*</span>
                <a href="{{ route('about') }}" class="tft-press-showcase__cta-btn"
                    aria-label="Explore press editorial details">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>

            <!-- Elegant Wheat Accent Divider -->
            <div class="tft-press-showcase__divider-accent">
                <span class="tft-press-showcase__divider-line"></span>
                <span class="tft-press-showcase__divider-leaf">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c5a880" stroke-width="1.2">
                        <!-- Branch stem -->
                        <path d="M 6,18 L 18,6" />
                        <!-- Leaves -->
                        <path d="M 10,14 C 8,13 8,11 11,11 C 11,11 12,13 10,14 Z" fill="#faf8f4" />
                        <path d="M 14,10 C 12,9 12,7 15,7 C 15,7 16,9 14,10 Z" fill="#faf8f4" />
                        <path d="M 12,12 C 13,14 15,14 15,11 C 15,11 13,10 12,12 Z" fill="#faf8f4" />
                        <path d="M 16,8 C 17,10 19,10 19,7 C 19,7 17,6 16,8 Z" fill="#faf8f4" />
                    </svg>
                </span>
                <span class="tft-press-showcase__divider-line"></span>
            </div>

            <!-- Bottom Features Row -->
            <div class="tft-press-showcase__features">
                <!-- Feature 1 -->
                <div class="tft-press-showcase__feat-box">
                    <span class="tft-press-showcase__feat-icon-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#5c6358" stroke-width="1.5">
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 3.58-1 9.58A7 7 0 0 1 11 20z">
                            </path>
                            <path d="M9 22v-4h4"></path>
                        </svg>
                    </span>
                    <div class="tft-press-showcase__feat-info">
                        <span class="tft-press-showcase__feat-title">NATURAL MATERIALS</span>
                        <span class="tft-press-showcase__feat-desc">Responsibly sourced</span>
                    </div>
                </div>
                <!-- Separator -->
                <span class="tft-press-showcase__feat-divider"></span>
                <!-- Feature 2 -->
                <div class="tft-press-showcase__feat-box">
                    <span class="tft-press-showcase__feat-icon-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#5c6358" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </span>
                    <div class="tft-press-showcase__feat-info">
                        <span class="tft-press-showcase__feat-title">ETHICAL & SUSTAINABLE</span>
                        <span class="tft-press-showcase__feat-desc">For a better tomorrow</span>
                    </div>
                </div>
                <!-- Separator -->
                <span class="tft-press-showcase__feat-divider"></span>
                <!-- Feature 3 -->
                <div class="tft-press-showcase__feat-box">
                    <span class="tft-press-showcase__feat-icon-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#5c6358" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                            </path>
                        </svg>
                    </span>
                    <div class="tft-press-showcase__feat-info">
                        <span class="tft-press-showcase__feat-title">GLOBAL REACH</span>
                        <span class="tft-press-showcase__feat-desc">Loved by designers</span>
                    </div>
                </div>
                <!-- Separator -->
                <span class="tft-press-showcase__feat-divider"></span>
                <!-- Feature 4 -->
                <div class="tft-press-showcase__feat-box">
                    <span class="tft-press-showcase__feat-icon-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#5c6358" stroke-width="1.5">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                    </span>
                    <div class="tft-press-showcase__feat-info">
                        <span class="tft-press-showcase__feat-title">DESIGNING LIFE</span>
                        <span class="tft-press-showcase__feat-desc">With purpose & soul</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Decorative Corner with exact Curved Triple Wave BG and Gold Outlines -->
        <div class="tft-press-showcase__deco tft-press-showcase__deco--right">
            <svg class="tft-press-showcase__wave-svg" viewBox="-10 0 110 100" preserveAspectRatio="none" width="100%"
                height="100%">
                <defs>
                    <clipPath id="tft-right-image-clip">
                        <path d="M 100,0 L 90,0 C 60,5 20,15 15,35 C 12,50 65,55 75,70 C 85,82 55,88 80,100 L 100,100 Z" />
                    </clipPath>
                </defs>
                <!-- 1. Outer Wave Background (Solid Soft Gray/Beige) -->
                <path d="M 100,0 L 72,0 C 42,5 2,15 -3,35 C -6,50 47,55 57,70 C 67,82 37,88 62,100 L 100,100 Z"
                    fill="#eae5dc" />
                <!-- 2. Middle Wave Background (Solid Off-White/Cream with Gold Stroke) -->
                <path d="M 100,0 L 81,0 C 51,5 11,15 6,35 C 3,50 56,55 66,70 C 76,82 46,88 71,100 L 100,100 Z"
                    fill="#faf8f4" />
                <path d="M 81,0 C 51,5 11,15 6,35 C 3,50 56,55 66,70 C 76,82 46,88 71,100" fill="none" stroke="#d5c5b2"
                    stroke-width="1.2" vector-effect="non-scaling-stroke" />
                <!-- 3. Inner Wave (Image with Gold Stroke) -->
                <g clip-path="url(#tft-right-image-clip)">
                    <image href="{{ asset('assets/img/fur_lookbook_reading.png') }}" x="0" y="0" width="100" height="100"
                        preserveAspectRatio="xMidYMid slice" />
                </g>
                <path d="M 90,0 C 60,5 20,15 15,35 C 12,50 65,55 75,70 C 85,82 55,88 80,100" fill="none" stroke="#d5c5b2"
                    stroke-width="1.2" vector-effect="non-scaling-stroke" />
            </svg>
        </div>
    </section>



    <!-- BRAND PHILOSOPHY FEATURE BAND -->
    <!-- wp:pattern {"slug":"fur-philosophy"} -->
    <section id="wp-block-fur-philosophy" class="fur-philosophy tft-philosophy" aria-labelledby="fur-philosophy-heading">
        <div class="tft-philosophy__row">

            <!-- LEFT ELEMENT: Philosophy Card -->
            <div class="tft-philosophy__container">
                <!-- Column 1: Image -->
                <div class="tft-philosophy__image-side">
                    <img class="tft-philosophy__img" src="{{ asset('assets/img/fur_room_living.png') }}"
                        alt="Thoughtfully crafted living room furniture" width="800" height="500" loading="lazy">
                    <div class="tft-philosophy__img-badge">Est. 2019</div>
                </div>

                <!-- Column 2: Text Content -->
                <div class="tft-philosophy__content-side">
                    <span class="tft-philosophy__tag">OUR PHILOSOPHY</span>
                    <h2 id="fur-philosophy-heading" class="tft-philosophy__title">Designed with purpose.<br>Made to <em>last
                            a lifetime.</em></h2>
                    <p class="tft-philosophy__text">We believe furniture is not just functional — it is the silent backdrop
                        of life's most meaningful moments. Every piece in our collection is crafted from responsibly sourced
                        solid hardwoods and natural textiles, built to become part of your family story.</p>
                    <a href="#about" class="tft-philosophy__btn">
                        <span>Our Full Story</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- RIGHT ELEMENT: Green Stats Card (Outside of Philosophy Card) -->
            <div class="tft-philosophy__stats-side">
                <div class="tft-philosophy__stats-card">

                    <!-- Stat Item 1: 100% FSC-Certified Wood -->
                    <div class="tft-philosophy__stat-item">
                        <div class="tft-philosophy__stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="7"></circle>
                                <circle cx="12" cy="12" r="4"></circle>
                            </svg>
                        </div>
                        <div class="tft-philosophy__stat-info">
                            <div class="tft-philosophy__stat-header">
                                <strong>100%</strong>
                                <span>FSC-Certified Wood</span>
                            </div>
                            <p class="tft-philosophy__stat-desc">From responsibly managed forests</p>
                        </div>
                    </div>

                    <!-- Stat Item 2: 12,000+ Homes Furnished -->
                    <div class="tft-philosophy__stat-item">
                        <div class="tft-philosophy__stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <circle cx="12" cy="13" r="3"></circle>
                            </svg>
                        </div>
                        <div class="tft-philosophy__stat-info">
                            <div class="tft-philosophy__stat-header">
                                <strong>12,000+</strong>
                                <span>Homes Furnished</span>
                            </div>
                            <p class="tft-philosophy__stat-desc">Across 45 countries worldwide</p>
                        </div>
                    </div>

                    <!-- Stat Item 3: 10 Yr Frame Warranty -->
                    <div class="tft-philosophy__stat-item">
                        <div class="tft-philosophy__stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <circle cx="12" cy="11" r="3"></circle>
                            </svg>
                        </div>
                        <div class="tft-philosophy__stat-info">
                            <div class="tft-philosophy__stat-header">
                                <strong>10 Yr</strong>
                                <span>Frame Warranty</span>
                            </div>
                            <p class="tft-philosophy__stat-desc">Built to last. Guaranteed.</p>
                        </div>
                    </div>

                    <!-- Stat Item 4: 0% Net Carbon Emissions -->
                    <div class="tft-philosophy__stat-item">
                        <div class="tft-philosophy__stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M7 13.5c1-1.5 3-2.5 5-2.5s4 1 5 2.5"></path>
                            </svg>
                        </div>
                        <div class="tft-philosophy__stat-info">
                            <div class="tft-philosophy__stat-header">
                                <strong>0%</strong>
                                <span>Net Emissions</span>
                            </div>
                            <p class="tft-philosophy__stat-desc">We offset 100% of our footprint</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- /wp:pattern -->





    <!-- LUXURY BRAND SERVICES GRID -->
    <!-- wp:pattern {"slug":"fur-services"} -->
    <section id="wp-block-fur-services" class="fur-services" aria-labelledby="fur-services-heading">
        <div class="fur-section-header">
            <div>
                <h2 id="fur-services-heading" class="fur-section-header__title">Bespoke Design & Services</h2>
                <p class="fur-section-header__subtitle">Experience premium, end-to-end luxury care.</p>
            </div>
        </div>
        <div class="fur-services__grid">
            <div class="fur-service-card">
                <div class="fur-service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="fur-service-card__title">10-Year Frame Warranty</h3>
                <p class="fur-service-card__desc">Enjoy absolute peace of mind. Every sofa and lounge chair frame is backed
                    by a decade-long structural integrity guarantee.</p>
            </div>
            <div class="fur-service-card">
                <div class="fur-service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                        <path d="M9 3v18M3 15h6M15 3v18"></path>
                    </svg>
                </div>
                <h3 class="fur-service-card__title">Bespoke Woodcraft Enquiry</h3>
                <p class="fur-service-card__desc">Upload your design, sketch, or photo. Our master carpenters handcraft your furniture in solid Teak or Sheesham wood with custom dimensions.</p>
            </div>
            <div class="fur-service-card">
                <div class="fur-service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </div>
                <h3 class="fur-service-card__title">Safe Pan-India &amp; Global Dispatch</h3>
                <p class="fur-service-card__desc">Heavy-duty wooden crate packing, doorstep transit insurance, and dedicated artisan care for all custom woodcraft furniture.</p>
            </div>
            <div class="fur-service-card">
                <div class="fur-service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3 class="fur-service-card__title">Flexible Trade Accounts</h3>
                <p class="fur-service-card__desc">Exclusive discounts, dedicated account managers, and streamlined
                    procurement services tailored for interior architects.</p>
            </div>
        </div>
    </section>
    <!-- /wp:pattern -->

    <!-- CUSTOMER TESTIMONIALS (REDESIGNED) -->
    <!-- wp:pattern {"slug":"tft-testimonials"} -->
    <section id="wp-block-tft-testimonials" class="tft-testimonials" aria-labelledby="tft-testimonials-heading"
        style="background-image: url('{{ asset('assets/img/fur_testimonials_bg.png') }}');">
        <div class="tft-testimonials__container">
            <div class="tft-testimonials__header">
                <span class="tft-testimonials__eyebrow">WHAT OUR PATRONS SAY</span>
                <h2 id="tft-testimonials-heading" class="tft-testimonials__title">Loved by <em>12,000+</em> homes &amp; resorts
                </h2>
                <p class="tft-testimonials__subtitle">Authentic handcrafted artistry. Discover why interior connoisseurs
                    trust Bharat Art &amp; Craft for bespoke wooden furniture.</p>
            </div>

            <div class="tft-testimonials__grid">
                @forelse($testimonials->take(4) as $rev)
                <article class="tft-testimonial-card">
                    <div class="tft-testimonial-card__img-wrap">
                        <img class="tft-testimonial-card__img" src="{{ $rev->image_url ?: asset('assets/img/fur_ugc_1.png') }}"
                            alt="{{ $rev->name }}" width="360" height="240" loading="lazy">
                    </div>
                    <div class="tft-testimonial-card__body">
                        <div class="tft-testimonial-card__quote-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <div class="tft-testimonial-card__rating" role="img" aria-label="5 out of 5 stars">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <blockquote class="tft-testimonial-card__quote">
                            "{{ $rev->description }}"
                        </blockquote>
                        <footer class="tft-testimonial-card__footer">
                            <div class="tft-testimonial-card__avatar-initial">{{ strtoupper(substr($rev->name, 0, 1)) }}</div>
                            <div class="tft-testimonial-card__meta">
                                <h3 class="tft-testimonial-card__author">{{ $rev->name }}</h3>
                                <span class="tft-testimonial-card__location">{{ $rev->designation ?: 'Patron' }}</span>
                            </div>
                        </footer>
                    </div>
                </article>
                @empty
                <article class="tft-testimonial-card">
                    <div class="tft-testimonial-card__img-wrap">
                        <img class="tft-testimonial-card__img" src="{{ asset('assets/img/fur_ugc_1.png') }}"
                            alt="Living space with handcrafted wood chair" width="360" height="240" loading="lazy">
                    </div>
                    <div class="tft-testimonial-card__body">
                        <div class="tft-testimonial-card__quote-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <div class="tft-testimonial-card__rating" role="img" aria-label="5 out of 5 stars">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <blockquote class="tft-testimonial-card__quote">
                            "The Handcrafted Teakwood Armchair is breathtaking. The traditional brass accents and cane weave reflect master craftsmanship. Delivered with great care."
                        </blockquote>
                        <footer class="tft-testimonial-card__footer">
                            <div class="tft-testimonial-card__avatar-initial">A</div>
                            <div class="tft-testimonial-card__meta">
                                <h3 class="tft-testimonial-card__author">Ananya Sharma</h3>
                                <span class="tft-testimonial-card__location">New Delhi &mdash; Handcrafted Seating</span>
                            </div>
                        </footer>
                    </div>
                </article>
                @endforelse
            </div>


        </div>
    </section>
    <!-- /wp:pattern -->

    <!-- EDITORIAL JOURNAL GRID -->
    <!-- wp:pattern {"slug":"fur-journal"} -->
    <section id="wp-block-tft-journal" class="tft-journal" aria-labelledby="tft-journal-heading">
        <header class="tft-journal__header">
            <div class="tft-journal__header-info">
                <span class="tft-journal__header-tag">IDEAS & INSPIRATION</span>
                <h2 id="tft-journal-heading" class="tft-journal__header-title">Ideas & Inspiration</h2>
                <p class="tft-journal__header-desc">Timeless ideas, expert guides, and real homes &mdash; designed to
                    inspire the way you live.</p>
            </div>
            <a href="{{ route('blog') }}" class="tft-journal__header-link">
                <span>View All Articles</span>
                <span class="tft-journal__header-link-arrow">&rarr;</span>
            </a>
        </header>

        <div class="tft-journal__grid">
            @forelse($blogs->take(3) as $art)
            <article class="tft-journal__card">
                <a href="{{ route('blog.single', $art->slug) }}" class="tft-journal__card-img-wrap">
                    <img class="tft-journal__card-img" src="{{ $art->image_url }}"
                        alt="{{ $art->title }}" width="400" height="280" loading="lazy">
                    <span class="tft-journal__card-tag">{{ $art->category_name ?? 'JOURNAL' }}</span>
                </a>
                <div class="tft-journal__card-body">
                    <div class="tft-journal__card-meta">
                        <span class="tft-journal__card-meta-item">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <time datetime="{{ $art->created_at?->toDateString() }}">{{ $art->created_at?->format('M d, Y') ?? 'Recent' }}</time>
                        </span>
                        <span class="tft-journal__card-meta-divider"></span>
                        <span class="tft-journal__card-meta-item">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>5 min read</span>
                        </span>
                    </div>
                    <h3 class="tft-journal__card-title"><a href="{{ route('blog.single', $art->slug) }}">{{ $art->title }}</a></h3>
                    <p class="tft-journal__card-excerpt">{{ Str::limit(strip_tags($art->description ?? $art->excerpt), 120) }}</p>
                    <div class="tft-journal__card-footer">
                        <a href="{{ route('blog.single', $art->slug) }}" class="tft-journal__card-link">
                            <span>Read Article</span>
                            <span class="tft-journal__card-link-arrow">&rarr;</span>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <article class="tft-journal__card">
                <a href="{{ route('blog') }}" class="tft-journal__card-img-wrap">
                    <img class="tft-journal__card-img" src="{{ asset('assets/img/fur_room_living.png') }}"
                        alt="Woodcraft Journal" width="400" height="280" loading="lazy">
                    <span class="tft-journal__card-tag">STYLING TIPS</span>
                </a>
                <div class="tft-journal__card-body">
                    <h3 class="tft-journal__card-title"><a href="{{ route('blog') }}">Solid Teak &amp; Sheesham: The Heritage Hardwood Guide</a></h3>
                    <p class="tft-journal__card-excerpt">Grain patterns, natural oil content, and seasoning methods &mdash; how we select timber to last generations.</p>
                </div>
            </article>
            @endforelse
        </div>
    </section>
    <!-- /wp:pattern -->

    <!-- NEWSLETTER SIGNUP SECTION (REDESIGNED) -->
    <!-- wp:pattern {"slug":"tft-newsletter"} -->
    <section id="wp-block-tft-newsletter" class="tft-newsletter" aria-labelledby="tft-newsletter-heading">
        <div class="tft-newsletter__card">
            <div class="tft-newsletter__main">
                <div class="tft-newsletter__content">

                    <!-- S-Curve Divider inside Content column to overflow on top of image -->
                    <div class="tft-newsletter__divider" aria-hidden="true">
                        <svg viewBox="0 0 200 600" preserveAspectRatio="none" fill="currentColor">
                            <path
                                d="M 0,0 L 140,0 C 120,80 50,100 30,150 C 10,200 20,280 80,380 C 110,430 160,480 180,600 L 0,600 Z">
                            </path>
                        </svg>
                        <!-- Floating White Badge with Leaf Icon -->
                        <div class="tft-newsletter__wave-badge">
                            <svg class="tft-newsletter__leaf-icon" width="20" height="20" viewBox="0 0 16 16"
                                fill="currentColor">
                                <path
                                    d="M1.4 1.7c.216.289.65.84 1.725 1.274 1.093.44 2.884.774 5.834.528l.37-.023c1.823-.06 3.117.598 3.956 1.579C14.16 6.082 14.5 7.41 14.5 8.5c0 .58-.032 1.285-.229 1.997q.198.248.382.54c.756 1.2 1.19 2.563 1.348 3.966a1 1 0 0 1-1.98.198c-.13-.97-.397-1.913-.868-2.77C12.173 13.386 10.565 14 8 14c-1.854 0-3.32-.544-4.45-1.435-1.125-.887-1.89-2.095-2.391-3.383C.16 6.62.16 3.646.509 1.902L.73.806zm-.05 1.39c-.146 1.609-.008 3.809.74 5.728.457 1.17 1.13 2.213 2.079 2.961.942.744 2.185 1.22 3.83 1.221 2.588 0 3.91-.66 4.609-1.445-1.789-2.46-4.121-1.213-6.342-2.68-.74-.488-1.735-1.323-1.844-2.308-.023-.214.237-.274.38-.112 1.4 1.6 3.573 1.757 5.59 2.045 1.227.215 2.21.526 3.033 1.158.058-.39.075-.782.075-1.158 0-.91-.288-1.988-.975-2.792-.626-.732-1.622-1.281-3.167-1.229l-.316.02c-3.05.253-5.01-.08-6.291-.598a5.3 5.3 0 0 1-1.4-.811" />
                            </svg>
                        </div>
                    </div>

                    <span class="tft-newsletter__tag">JOIN THE COMMUNITY</span>
                    <h2 id="tft-newsletter-heading" class="tft-newsletter__title">
                        Design stories,<br>new arrivals &<br><em>exclusive member offers</em>
                    </h2>
                    <p class="tft-newsletter__desc">
                        Join 40,000+ design enthusiasts. No spam — just beautiful furniture and thoughtful interiors,
                        delivered monthly.
                    </p>

                    <!-- Features Grid -->
                    <div class="tft-newsletter__features">
                        <div class="tft-newsletter__feature-item">
                            <div class="tft-newsletter__feature-icon">
                                <svg class="tft-newsletter__leaf-icon" width="20" height="20" viewBox="0 0 16 16"
                                    fill="currentColor">
                                    <path
                                        d="M1.4 1.7c.216.289.65.84 1.725 1.274 1.093.44 2.884.774 5.834.528l.37-.023c1.823-.06 3.117.598 3.956 1.579C14.16 6.082 14.5 7.41 14.5 8.5c0 .58-.032 1.285-.229 1.997q.198.248.382.54c.756 1.2 1.19 2.563 1.348 3.966a1 1 0 0 1-1.98.198c-.13-.97-.397-1.913-.868-2.77C12.173 13.386 10.565 14 8 14c-1.854 0-3.32-.544-4.45-1.435-1.125-.887-1.89-2.095-2.391-3.383C.16 6.62.16 3.646.509 1.902L.73.806zm-.05 1.39c-.146 1.609-.008 3.809.74 5.728.457 1.17 1.13 2.213 2.079 2.961.942.744 2.185 1.22 3.83 1.221 2.588 0 3.91-.66 4.609-1.445-1.789-2.46-4.121-1.213-6.342-2.68-.74-.488-1.735-1.323-1.844-2.308-.023-.214.237-.274.38-.112 1.4 1.6 3.573 1.757 5.59 2.045 1.227.215 2.21.526 3.033 1.158.058-.39.075-.782.075-1.158 0-.91-.288-1.988-.975-2.792-.626-.732-1.622-1.281-3.167-1.229l-.316.02c-3.05.253-5.01-.08-6.291-.598a5.3 5.3 0 0 1-1.4-.811" />
                                </svg>
                            </div>
                            <div class="tft-newsletter__feature-content">
                                <strong class="tft-newsletter__feature-title">Curated Content</strong>
                                <span class="tft-newsletter__feature-desc">Inspiration & stories handpicked for you</span>
                            </div>
                        </div>
                        <div class="tft-newsletter__feature-item">
                            <div class="tft-newsletter__feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
                            </div>
                            <div class="tft-newsletter__feature-content">
                                <strong class="tft-newsletter__feature-title">New Arrivals</strong>
                                <span class="tft-newsletter__feature-desc">Be the first to discover our latest pieces</span>
                            </div>
                        </div>
                        <div class="tft-newsletter__feature-item">
                            <div class="tft-newsletter__feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                    </path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>
                            </div>
                            <div class="tft-newsletter__feature-content">
                                <strong class="tft-newsletter__feature-title">Member Offers</strong>
                                <span class="tft-newsletter__feature-desc">Exclusive discounts & early access</span>
                            </div>
                        </div>
                        <div class="tft-newsletter__feature-item">
                            <div class="tft-newsletter__feature-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                    </path>
                                </svg>
                            </div>
                            <div class="tft-newsletter__feature-content">
                                <strong class="tft-newsletter__feature-title">Design Community</strong>
                                <span class="tft-newsletter__feature-desc">Join a global community that loves design</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    @if(session('success'))
                        <div style="background: rgba(197, 168, 128, 0.15); border: 1px solid var(--fur-primary); color: var(--fur-text); padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 0.9rem;">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="tft-newsletter__form" id="tft-newsletter-form" action="{{ route('newsletter.submit') }}" method="post">
                        @csrf
                        <label class="tft-newsletter__label" for="tft-newsletter-email">Email address</label>
                        <div class="tft-newsletter__input-group">
                            <span class="tft-newsletter__input-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <input class="tft-newsletter__input" type="email" id="tft-newsletter-email" name="email"
                                placeholder="you@example.com" required autocomplete="email">
                            <button class="tft-newsletter__btn" type="submit">Subscribe &rarr;</button>
                        </div>
                        <p class="tft-newsletter__note">By subscribing you agree to our <a href="#privacy">Privacy
                                Policy</a>. Unsubscribe anytime.</p>
                    </form>
                </div>

                <div class="tft-newsletter__image-side" aria-hidden="true">
                    <img class="tft-newsletter__img" src="{{ asset('assets/img/fur_banner_sofa.png') }}" alt="" width="600"
                        height="500" loading="lazy">
                </div>
            </div>

            <!-- Bottom Stats Bar -->
            <div class="tft-newsletter__stats">
                <div class="tft-newsletter__stat-item">
                    <span class="tft-newsletter__stat-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </span>
                    <div class="tft-newsletter__stat-content">
                        <strong class="tft-newsletter__stat-number">40,000+</strong>
                        <span class="tft-newsletter__stat-label">Design enthusiasts</span>
                    </div>
                </div>
                <div class="tft-newsletter__stat-item">
                    <span class="tft-newsletter__stat-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                            </path>
                        </svg>
                    </span>
                    <div class="tft-newsletter__stat-content">
                        <strong class="tft-newsletter__stat-number">120+</strong>
                        <span class="tft-newsletter__stat-label">Countries worldwide</span>
                    </div>
                </div>
                <div class="tft-newsletter__stat-item">
                    <span class="tft-newsletter__stat-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <div class="tft-newsletter__stat-content">
                        <strong class="tft-newsletter__stat-number">Monthly</strong>
                        <span class="tft-newsletter__stat-label">Curated inspiration</span>
                    </div>
                </div>
                <div class="tft-newsletter__stat-item">
                    <span class="tft-newsletter__stat-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                    </span>
                    <div class="tft-newsletter__stat-content">
                        <strong class="tft-newsletter__stat-number">100%</strong>
                        <span class="tft-newsletter__stat-label">No spam. Unsubscribe anytime.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /wp:pattern -->

    <!-- FOOTER (PREMIUM REBUILD) -->
    <!-- FOOTER (PREMIUM REBUILD) -->
    <!-- DYNAMIC FOOTER -->
    <!-- SYSTEM LEVEL: FOOTER (PREMIUM REBUILD) -->
@endsection