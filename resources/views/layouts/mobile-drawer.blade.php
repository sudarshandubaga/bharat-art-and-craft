<nav class="tft-mobile-drawer" id="tft-mobile-drawer" aria-label="Mobile Navigation">
  <div class="tft-mobile-drawer__header">
    <a href="{{ route('home') }}" class="tft-header__logo-group" aria-label="Go to Home" style="text-decoration: none;">
      <div class="tft-header__logo-arch" style="width: 34px; height: 42px;">
        <img src="{{ asset('assets/img/logo-symbol.png') }}" alt="{{ config('app.name', 'Bharat Art & Craft') }}" width="34" height="42" loading="lazy">
      </div>
      <div class="tft-header__logo-text">
        <span class="tft-header__logo-brand" style="font-size: 1.15rem;">Bharat</span>
        <span class="tft-header__logo-tagline" style="font-size: 0.55rem; letter-spacing: 0.15em;">ART &amp; CRAFT</span>
      </div>
    </a>
    <button class="tft-mobile-drawer__close" id="tft-mobile-drawer-close" aria-label="Close Menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>

  <div class="tft-mobile-drawer__search" style="position: relative;">
    <form action="{{ route('shop') }}" method="get" class="tft-mobile-drawer__search-form">
      <input type="text" name="s" class="tft-mobile-drawer__search-input" id="tft-mobile-drawer-search-input"
        autocomplete="off" placeholder="Search for furniture..." aria-label="Search Catalog">
      <button type="submit" class="tft-mobile-drawer__search-btn" aria-label="Search">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
    </form>
  </div>

  <div class="tft-mobile-drawer__nav">
    <!-- 1. Home -->
    <a href="{{ route('home') }}"
      class="tft-mobile-drawer__link {{ request()->routeIs('home') ? 'tft-mobile-drawer__link--active' : '' }}">
      <span class="tft-mobile-drawer__link-text">Home</span>
    </a>

    <!-- 2. About Us -->
    <a href="{{ route('about') }}"
      class="tft-mobile-drawer__link {{ request()->routeIs('about') ? 'tft-mobile-drawer__link--active' : '' }}">
      <span class="tft-mobile-drawer__link-text">About Us</span>
    </a>

    <!-- 3. Collections (Shop Page) with Dropdown of Categories (1 Level) -->
    <button
      class="tft-mobile-drawer__link tft-nav-dropdown__btn {{ request()->routeIs('shop*') ? 'tft-mobile-drawer__link--active' : '' }}"
      aria-expanded="false">
      <span class="tft-mobile-drawer__link-text">Collections (Shop Page)</span>
      <svg class="tft-mobile-drawer__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2.5">
        <polyline points="6 9 12 15 18 9"></polyline>
      </svg>
    </button>
    <div class="tft-nav-dropdown__menu tft-mobile-drawer__submenu">
      <a href="{{ route('shop') }}" class="tft-mobile-drawer__sublink"
        style="font-weight: 700; color: var(--fur-primary);">All Collections (Shop Page)</a>
      @if(isset($globalCategories) && $globalCategories->isNotEmpty())
        @foreach($globalCategories as $mCat)
          <a href="{{ route('category.show', $mCat->slug) }}" class="tft-mobile-drawer__sublink">{{ $mCat->name }}</a>
        @endforeach
      @else
        <a href="{{ route('category.show', 'lounge') }}" class="tft-mobile-drawer__sublink">Lounge &amp; Sofas</a>
        <a href="{{ route('category.show', 'dining') }}" class="tft-mobile-drawer__sublink">Dining &amp; Stools</a>
        <a href="{{ route('category.show', 'tables') }}" class="tft-mobile-drawer__sublink">Tables &amp; Coffee Tables</a>
        <a href="{{ route('category.show', 'storage') }}" class="tft-mobile-drawer__sublink">Consoles &amp; Storage</a>
        <a href="{{ route('category.show', 'bedroom') }}" class="tft-mobile-drawer__sublink">Solid Wood Beds</a>
        <a href="{{ route('category.show', 'office') }}" class="tft-mobile-drawer__sublink">Office Chairs &amp; Desks</a>
        <a href="{{ route('category.show', 'lighting') }}" class="tft-mobile-drawer__sublink">Designer Lighting</a>
        <a href="{{ route('category.show', 'decor') }}" class="tft-mobile-drawer__sublink">Aesthetic Decor</a>
      @endif
    </div>

    <!-- 4. FAQs -->
    <a href="{{ route('faqs') }}"
      class="tft-mobile-drawer__link {{ request()->routeIs('faqs') ? 'tft-mobile-drawer__link--active' : '' }}">
      <span class="tft-mobile-drawer__link-text">FAQs</span>
    </a>

    <!-- 5. Customized Enquiry -->
    <a href="{{ route('consultation') }}"
      class="tft-mobile-drawer__link {{ (request()->routeIs('consultation') || request()->routeIs('custom-enquiry')) ? 'tft-mobile-drawer__link--active' : '' }}">
      <span class="tft-mobile-drawer__link-text">Customized Enquiry</span>
    </a>

    <!-- 6. Contact Us -->
    <a href="{{ route('contact') }}"
      class="tft-mobile-drawer__link {{ request()->routeIs('contact') ? 'tft-mobile-drawer__link--active' : '' }}">
      <span class="tft-mobile-drawer__link-text">Contact Us</span>
    </a>
  </div>

  <div class="tft-mobile-drawer__footer">
    <div class="tft-mobile-drawer__socials">
      <a href="https://instagram.com/" target="_blank" rel="noopener" class="tft-mobile-drawer__social-link"
        aria-label="Instagram">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
          <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
          <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
        </svg>
      </a>
      <a href="https://pinterest.com/" target="_blank" rel="noopener" class="tft-mobile-drawer__social-link"
        aria-label="Pinterest">
        <svg width="18" height="18" viewBox="0 0 384 512" fill="currentColor" aria-hidden="true"
          style="display: inline-block; vertical-align: middle;">
          <path
            d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" />
        </svg>
      </a>
      <a href="https://facebook.com/" target="_blank" rel="noopener" class="tft-mobile-drawer__social-link"
        aria-label="Facebook">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
        </svg>
      </a>
    </div>
    <p class="tft-drawer__footer-tagline">Crafted with care since 2008</p>
    <div class="tft-drawer__footer-links">
      <a href="{{ route('about') }}" class="tft-drawer__footer-link">About</a>
      <a href="{{ route('contact') }}" class="tft-drawer__footer-link">Contact</a>
      <a href="{{ route('faqs') }}" class="tft-drawer__footer-link">FAQs</a>
    </div>
  </div>
</nav>