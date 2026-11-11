<header id="wp-block-tft-site-header" class="tft-header">
  <!-- Row 1: Top Bar -->
  <div class="tft-header__topbar">
    <div class="tft-header__topbar-container">
      <div class="tft-header__topbar-shipping">
        <svg class="tft-header__topbar-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect>
          <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
          <circle cx="5.5" cy="18.5" r="2.5"></circle>
          <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <span>FREE SHIPPING ON ALL ORDERS OVER $500</span>
      </div>
      <div class="tft-header__topbar-right">
        <div class="tft-header__topbar-socials">
          @if(!empty($site->social_links['instagram']))
          <a href="{{ $site->social_links['instagram'] }}" target="_blank" rel="noopener" class="tft-header__topbar-social-link"
            aria-label="Instagram">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
          </a>
          @endif
          @if(!empty($site->social_links['facebook']))
          <a href="{{ $site->social_links['facebook'] }}" target="_blank" rel="noopener" class="tft-header__topbar-social-link"
            aria-label="Facebook">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
          </a>
          @endif
          @if(!empty($site->whatsapp_url))
          <a href="{{ $site->whatsapp_url }}" target="_blank" rel="noopener" class="tft-header__topbar-social-link"
            aria-label="WhatsApp">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Row 2: Main Search & Action Bar -->
  <div class="tft-header__main">
    <div class="tft-header__main-container">
      <!-- Logo -->
      <a href="{{ route('home') }}" class="tft-header__logo-group" aria-label="Go to Home">
        <div class="tft-header__logo-arch">
          <img src="{{ asset('assets/img/logo-symbol.png') }}" alt="Bharat Art & Craft Arch Symbol" width="54"
            height="68" loading="lazy">
        </div>
        <div class="tft-header__logo-text">
          <span class="tft-header__logo-brand">Bharat</span>
          <span class="tft-header__logo-tagline">ART &amp; CRAFT</span>
        </div>
      </a>

      <!-- Large Rounded Search Capsule -->
      <div class="tft-header__search-capsule" id="tft-header-search-capsule" style="position: relative;">
        <form action="{{ route('shop') }}" method="get" class="tft-header__search-form" id="tft-header-search-form">
          <input type="text" name="s" class="tft-header__search-input" id="tft-header-search-input"
            autocomplete="off" placeholder="Search for solid wood furniture, handicrafts..." aria-label="Search Catalog">
          <button type="submit" class="tft-header__search-btn" aria-label="Submit Search">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </button>
        </form>
      </div>

      <!-- Quick Actions -->
      <div class="tft-header__quick-actions">
        <!-- Account / About -->
        <a href="{{ route('about') }}" class="tft-header__action-item tft-header__action-item--account"
          aria-label="About Atelier">
          <div class="tft-header__action-icon-wrap">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
          <span class="tft-header__action-label">About</span>
        </a>

        <!-- Cart (Sent on Enquiry / Quote) -->
        <a href="#" class="tft-header__action-item tft-header__action-item--cart fur-header__nav-btn--cart"
          id="fur-cart-trigger" aria-label="View Quote Cart">
          <div class="tft-header__action-icon-wrap">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span class="tft-header__action-badge fur-sidebar__cart-count fur-header__cart-count">0</span>
          </div>
          <span class="tft-header__action-label">Quote</span>
        </a>

        <!-- Mobile Hamburger (Hidden on Desktop) -->
        <button class="tft-header__hamburger-btn" id="fur-menu-toggle-mobile" aria-expanded="false"
          aria-label="Toggle Menu">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Row 3: Categories & Curation Row -->
  <div class="tft-header__nav-bar">
    <div class="tft-header__nav-bar-container">
      <nav class="tft-header__subnav" aria-label="Main Navigation">
        <ul class="tft-header__subnav-list">

          <!-- 1. HOME -->
          <li class="tft-header__subnav-item">
            <a href="{{ route('home') }}"
              class="tft-header__subnav-link {{ request()->routeIs('home') ? 'tft-header__subnav-link--active' : '' }}">
              <span class="tft-header__subnav-icon-wrap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
              </span>
              <span class="tft-header__subnav-text">
                <span class="tft-header__subnav-title">HOME</span>
                <span class="tft-header__subnav-desc">Flagship Store</span>
              </span>
            </a>
          </li>

          <!-- 2. ABOUT US -->
          <li class="tft-header__subnav-item">
            <a href="{{ route('about') }}"
              class="tft-header__subnav-link {{ request()->routeIs('about') ? 'tft-header__subnav-link--active' : '' }}">
              <span class="tft-header__subnav-icon-wrap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M12 16v-4"></path>
                  <path d="M12 8h.01"></path>
                </svg>
              </span>
              <span class="tft-header__subnav-text">
                <span class="tft-header__subnav-title">ABOUT US</span>
                <span class="tft-header__subnav-desc">Our Heritage &amp; Craft</span>
              </span>
            </a>
          </li>

          <!-- 3. COLLECTIONS (SHOP PAGE) with Dropdown of Categories (1 Level) -->
          <li class="tft-header__subnav-item tft-mega--has-dropdown" id="tft-mega-collections">
            <button
              class="tft-header__subnav-link tft-mega__trigger {{ request()->routeIs('shop*') ? 'tft-header__subnav-link--active' : '' }}"
              aria-haspopup="true" aria-expanded="false" aria-controls="tft-mega-panel-collections">
              <span class="tft-header__subnav-icon-wrap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                  <line x1="3" y1="6" x2="21" y2="6"></line>
                  <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
              </span>
              <span class="tft-header__subnav-text">
                <span class="tft-header__subnav-title">COLLECTIONS</span>
                <span class="tft-header__subnav-desc">Shop Page</span>
              </span>
              <svg class="tft-mega__chevron" width="11" height="11" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <div class="tft-mega__panel" id="tft-mega-panel-collections" role="region"
              aria-label="Collections categories dropdown">
              <div class="tft-mega__panel-inner">
                <!-- Columns 1 & 2: Flat Single-Level Category Directory -->
                <div class="tft-mega__col" style="grid-column: span 2;">
                  <div style="display: flex; align-items: center; justify-content: space-between; border-block-end: 1px solid var(--fur-border, #e8e4dc); padding-block-end: 10px; margin-block-end: 14px;">
                    <p class="tft-mega__col-heading" style="border: none; padding: 0; margin: 0;">All Furniture Categories</p>
                    <span style="font-size: 0.6875rem; color: var(--fur-text-muted); font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;">
                      {{ isset($globalCategories) ? $globalCategories->count() : 8 }} Collections
                    </span>
                  </div>

                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4px 32px;">
                    @if(isset($globalCategories) && $globalCategories->isNotEmpty())
                      @foreach($globalCategories as $gCat)
                        @php
                          $catSlug = strtolower($gCat->slug ?? "");
                        @endphp
                        <a href="{{ route('category.show', $gCat->slug) }}" class="tft-mega__link">
                          <span class="tft-mega__link-icon-wrap">
                            @if(str_contains($catSlug, "lounge") || str_contains($catSlug, "sofa"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"></path><path d="M3 11v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v2H7v-2a2 2 0 0 0-4 0z"></path></svg>
                            @elseif(str_contains($catSlug, "dining") || str_contains($catSlug, "stool"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><path d="M4 18v3M20 18v3M4 11h16M7 11V4h10v7"></path></svg>
                            @elseif(str_contains($catSlug, "table"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><rect x="3" y="8" width="18" height="3" rx="1"></rect><path d="M6 11v9M18 11v9M10 11v9M14 11v9"></path></svg>
                            @elseif(str_contains($catSlug, "storage") || str_contains($catSlug, "console"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><rect x="3" y="4" width="18" height="16" rx="2"></rect><line x1="3" y1="12" x2="21" y2="12"></line><line x1="12" y1="4" x2="12" y2="20"></line></svg>
                            @elseif(str_contains($catSlug, "bed"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><path d="M2 19h20M4 19v-9a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v9M2 9h20"></path></svg>
                            @elseif(str_contains($catSlug, "office") || str_contains($catSlug, "desk"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><rect x="3" y="10" width="18" height="10" rx="1"></rect><path d="M7 10V6a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4"></path></svg>
                            @elseif(str_contains($catSlug, "light") || str_contains($catSlug, "lamp"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><path d="M9 18h6M10 22h4M12 2v1M12 8a5 5 0 0 0-3 9h6a5 5 0 0 0-3-9z"></path></svg>
                            @elseif(str_contains($catSlug, "decor") || str_contains($catSlug, "art"))
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><path d="M12 2l2.4 7.4H22l-6 4.4 2.3 7.2L12 16.6l-6.3 4.4 2.3-7.2-6-4.4h7.6z"></path></svg>
                            @else
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M5 12v8M19 12v8M9 12v5M15 12v5"></path></svg>
                            @endif
                          </span>
                          <span class="tft-mega__link-body">
                            <span class="tft-mega__link-title">{{ $gCat->name }}</span>
                            <span class="tft-mega__link-desc">{{ $gCat->products_count }} {{ Str::plural('piece', $gCat->products_count) }} curated</span>
                          </span>
                        </a>
                      @endforeach
                    @else
                      @php
                        $fallbackCategories = [
                          ['slug' => 'lounge', 'name' => 'Lounge & Sofas', 'desc' => 'Boucle, linen & modular seating'],
                          ['slug' => 'dining', 'name' => 'Dining & Stools', 'desc' => 'Solid oak dining tables & chairs'],
                          ['slug' => 'tables', 'name' => 'Tables & Coffee Tables', 'desc' => 'Architectural low tables & desks'],
                          ['slug' => 'storage', 'name' => 'Consoles & Storage', 'desc' => 'Fluted credenzas & media units'],
                          ['slug' => 'bedroom', 'name' => 'Solid Wood Beds', 'desc' => 'Minimalist platform bed frames'],
                          ['slug' => 'office', 'name' => 'Office Chairs & Desks', 'desc' => 'Ergonomic solid wood workspace'],
                          ['slug' => 'lighting', 'name' => 'Designer Lighting', 'desc' => 'Pendant lamps & ambient glow'],
                          ['slug' => 'decor', 'name' => 'Aesthetic Decor', 'desc' => 'Artisanal objects & accessories'],
                        ];
                      @endphp
                      @foreach($fallbackCategories as $fCat)
                        <a href="{{ route('category.show', $fCat['slug']) }}" class="tft-mega__link">
                          <span class="tft-mega__link-icon-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M5 12v8M19 12v8M9 12v5M15 12v5"></path></svg>
                          </span>
                          <span class="tft-mega__link-body">
                            <span class="tft-mega__link-title">{{ $fCat['name'] }}</span>
                            <span class="tft-mega__link-desc">{{ $fCat['desc'] }}</span>
                          </span>
                        </a>
                      @endforeach
                    @endif
                  </div>
                </div>

                <!-- Column 3: Quick Catalog Navigation -->
                <div class="tft-mega__col">
                  <p class="tft-mega__col-heading">Catalog &amp; Services</p>
                  
                  <a href="{{ route('shop') }}" class="tft-mega__link">
                    <span class="tft-mega__link-icon-wrap" style="color: var(--fur-primary);">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                      </svg>
                    </span>
                    <span class="tft-mega__link-body">
                      <span class="tft-mega__link-title" style="color: var(--fur-primary); font-weight: 700;">All Collections &rarr;</span>
                      <span class="tft-mega__link-desc">View full catalog &amp; filter</span>
                    </span>
                  </a>

                  <a href="{{ route('consultation') }}" class="tft-mega__link">
                    <span class="tft-mega__link-icon-wrap">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                      </svg>
                    </span>
                    <span class="tft-mega__link-body">
                      <span class="tft-mega__link-title">Customized Enquiry</span>
                      <span class="tft-mega__link-desc">Bespoke timber &amp; dimensions</span>
                    </span>
                  </a>

                  <a href="{{ route('about') }}" class="tft-mega__link">
                    <span class="tft-mega__link-icon-wrap">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                      </svg>
                    </span>
                    <span class="tft-mega__link-body">
                      <span class="tft-mega__link-title">Woodcraft Heritage</span>
                      <span class="tft-mega__link-desc">Jodhpur seasoned solid wood</span>
                    </span>
                  </a>

                  <a href="{{ route('faqs') }}" class="tft-mega__link">
                    <span class="tft-mega__link-icon-wrap">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="tft-mega__link-icon">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                      </svg>
                    </span>
                    <span class="tft-mega__link-body">
                      <span class="tft-mega__link-title">Help &amp; FAQs</span>
                      <span class="tft-mega__link-desc">Delivery, warranty &amp; timber care</span>
                    </span>
                  </a>
                </div>

                                <!-- Column 4: Feature Card -->
                <div class="tft-mega__col tft-mega__col--feature">
                  <div class="tft-mega__feature-card">
                    <p class="tft-mega__feature-label">SHOP THE CATALOG</p>
                    <p class="tft-mega__feature-title">All Collections</p>
                    <p class="tft-mega__feature-desc">Discover our complete range of solid timber furniture and bespoke
                      interior designs.</p>
                    <a href="{{ route('shop') }}" class="tft-mega__feature-btn">Open Shop Page &rarr;</a>
                  </div>
                </div>
              </div>
            </div>
          </li>



          <!-- 5. CUSTOMIZED ENQUIRY -->
          <li class="tft-header__subnav-item">
            <a href="{{ route('consultation') }}"
              class="tft-header__subnav-link {{ (request()->routeIs('consultation') || request()->routeIs('custom-enquiry')) ? 'tft-header__subnav-link--active' : '' }}">
              <span class="tft-header__subnav-icon-wrap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 20h9"></path>
                  <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                </svg>
              </span>
              <span class="tft-header__subnav-text">
                <span class="tft-header__subnav-title">CUSTOMIZED ENQUIRY</span>
                <span class="tft-header__subnav-desc">Bespoke Furniture</span>
              </span>
            </a>
          </li>

          <!-- 6. CONTACT US -->
          <li class="tft-header__subnav-item">
            <a href="{{ route('contact') }}"
              class="tft-header__subnav-link {{ request()->routeIs('contact') ? 'tft-header__subnav-link--active' : '' }}">
              <span class="tft-header__subnav-icon-wrap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
              </span>
              <span class="tft-header__subnav-text">
                <span class="tft-header__subnav-title">CONTACT US</span>
                <span class="tft-header__subnav-desc">Get In Touch</span>
              </span>
            </a>
          </li>

        </ul>
      </nav>

      <!-- Right side CTA: Customized Enquiry -->
      <a href="{{ route('consultation') }}" class="tft-header__nav-cta">
        <div class="tft-header__nav-cta-thumb">
          <img src="{{ asset('assets/img/fur_prod_armchair_green_thumb.png') }}" alt="Green armchair thumb" width="36"
            height="36" loading="lazy">
        </div>
        <div class="tft-header__nav-cta-text">
          <span class="tft-header__nav-cta-title">Customized Enquiry</span>
          <span class="tft-header__nav-cta-subtitle">Book free design session</span>
        </div>
        <div class="tft-header__nav-cta-arrow">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>
      </a>
    </div>
  </div>
</header>