<footer class="tft-footer" id="wp-block-shop-footer">
  <div class="tft-footer__upper">
    <div class="tft-footer__main-grid">

      <!-- Brand & Left Info Column -->
      <div class="tft-footer__col-brand">
        <!-- Logo Group -->
        <a href="{{ route('home') }}" class="tft-footer__logo-group" aria-label="Go to Home">
          <div class="tft-footer__logo-arch">
            <img src="{{ asset('assets/img/logo-symbol.png') }}" alt="Kave Home Arch Symbol" width="54" height="68"
              loading="lazy">
          </div>

        </a>
        <p class="tft-footer__tagline">
          Honouring raw natural textures, quiet architectural proportions, and generation-lasting wood craftsmanship for
          modern residential spaces.
        </p>

        <div class="tft-footer__contact-list">
          <div class="tft-footer__contact-item">
            <span class="tft-footer__contact-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </span>
            <div class="tft-footer__contact-info">
              <strong>Atelier &amp; Works</strong>
              <span>{{ $site->address ?? 'Industrial Area, Jodhpur, Rajasthan, India' }}</span>
            </div>
          </div>
          <div class="tft-footer__contact-item">
            <span class="tft-footer__contact-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path
                  d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                </path>
              </svg>
            </span>
            <div class="tft-footer__contact-info">
              <strong>{{ $site->phone ?? '+91-9876543210' }}</strong>
              <span>Mon - Sat: 10:00 AM – 7:00 PM IST</span>
            </div>
          </div>
          <div class="tft-footer__contact-item">
            <span class="tft-footer__contact-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </span>
            <div class="tft-footer__contact-info">
              <strong>{{ $site->email ?? 'info@bharatartandcraft.com' }}</strong>
              <span>We reply within 24 hours</span>
            </div>
          </div>
        </div>

        <div class="tft-footer__social-section">
          <span class="tft-footer__social-title">Follow along</span>
          <div class="tft-footer__social-links">
            @if(!empty($site->social_links['instagram']))
              <a href="{{ $site->social_links['instagram'] }}" target="_blank" rel="noopener"
                class="tft-footer__social-btn" aria-label="Instagram">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
              </a>
            @endif
            @if(!empty($site->social_links['pinterest']))
              <a href="{{ $site->social_links['pinterest'] }}" target="_blank" rel="noopener"
                class="tft-footer__social-btn" aria-label="Pinterest">
                <svg width="14" height="14" viewBox="0 0 384 512" fill="currentColor" aria-hidden="true"
                  style="display: inline-block; vertical-align: middle;">
                  <path
                    d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" />
                </svg>
              </a>
            @endif
            @if(!empty($site->social_links['facebook']))
              <a href="{{ $site->social_links['facebook'] }}" target="_blank" rel="noopener"
                class="tft-footer__social-btn" aria-label="Facebook">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
              </a>
            @endif
            @if(!empty($site->whatsapp_url))
              <a href="{{ $site->whatsapp_url }}" target="_blank" rel="noopener" class="tft-footer__social-btn"
                aria-label="WhatsApp">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path
                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                  </path>
                </svg>
              </a>
            @endif
          </div>
        </div>
      </div>

      <!-- Links Column 1: Collections -->
      <div class="tft-footer__col-links">
        <h3 class="tft-footer__heading">Collections</h3>
        <ul class="tft-footer__links-list">
          @if(isset($globalCategories) && $globalCategories->isNotEmpty())
            @foreach($globalCategories->take(7) as $gCat)
              <li><a href="{{ route('category.show', $gCat->slug) }}">{{ $gCat->name }}</a></li>
            @endforeach
          @else
            <li><a href="{{ route('category.show', 'tables') }}">Solid Wood Dining Tables</a></li>
            <li><a href="{{ route('category.show', 'lounge') }}">Handcrafted Chairs &amp; Sofas</a></li>
            <li><a href="{{ route('category.show', 'bedroom') }}">Carved Bed Frames</a></li>
            <li><a href="{{ route('category.show', 'storage') }}">Consoles &amp; Almirahs</a></li>
            <li><a href="{{ route('category.show', 'dining') }}">Dining &amp; Entertaining</a></li>
            <li><a href="{{ route('category.show', 'lighting') }}">Brass &amp; Wooden Lighting</a></li>
            <li><a href="{{ route('category.show', 'decor') }}">Heritage Handicrafts</a></li>
          @endif
        </ul>
      </div>

      <!-- Links Column 2: The Studio -->
      <div class="tft-footer__col-links">
        <h3 class="tft-footer__heading">The Studio</h3>
        <ul class="tft-footer__links-list">
          <li><a href="{{ route('about') }}">Our Story</a></li>
          <li><a href="{{ route('about') }}#wp-block-philosophy">Atelier Philosophy</a></li>
          <li><a href="{{ route('about') }}#wp-block-artisans">Meet the Artisans</a></li>
          <li><a href="{{ route('about') }}#wp-block-slow-craft-timeline">The Slow Craft Process</a></li>
          <li><a href="#sustainability">Sustain & FSC Forestry</a></li>
          <li><a href="#careers">Careers</a></li>
          <li><a href="{{ route('blog') }}">Journal</a></li>
        </ul>
      </div>

      <!-- Links Column 3: Services -->
      <div class="tft-footer__col-links">
        <h3 class="tft-footer__heading">Services &amp; Help</h3>
        <ul class="tft-footer__links-list">
          <li><a href="{{ route('faqs') }}">Frequently Asked Questions</a></li>
          <li><a href="{{ route('consultation') }}">Customized Enquiry</a></li>
          <li><a href="{{ route('contact') }}">Contact Atelier</a></li>
          <li><a href="{{ route('shop') }}">All Collections</a></li>
          <li><a href="#shipping">White-Glove Shipping</a></li>
          <li><a href="#care">Wood Care &amp; Maintenance</a></li>
          <li><a href="{{ route('checkout') }}">Send Furniture Enquiry</a></li>
        </ul>
      </div>

      <!-- Links Column 4: Newsletter -->
      <div class="tft-footer__col-newsletter">
        <h3 class="tft-footer__heading">Studio Dispatch</h3>
        <p class="tft-footer__newsletter-text">
          Subscribe to receive seasonal lookbooks, workshop updates, and exclusive collection launches.
        </p>
        <form class="tft-footer__form" action="{{ route('newsletter.submit') }}" method="POST"
          data-tft-submit="subscribe-newsletter">
          @csrf
          <input type="email" name="email" placeholder="Your email address" class="tft-footer__input" required
            aria-label="Email address">
          <button type="submit" class="tft-footer__submit-btn" aria-label="Submit newsletter form">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </button>
        </form>
        <div class="tft-footer__checkbox-wrapper">
          <span class="tft-footer__checkbox-icon">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
            </svg>
          </span>
          <span class="tft-footer__checkbox-label">
            By subscribing, you agree to our privacy policy and consent to receive marketing communication.
          </span>
        </div>
      </div>

      <!-- Arch Image Column -->
      <div class="tft-footer__col-arch">
        <div class="tft-footer__arch-frame">
          <img class="tft-footer__arch-img" src="{{ asset('assets/img/fur_footer_arch.png') }}"
            alt="Bharat Art & Craft Interior Space" width="220" height="300" loading="lazy">
        </div>
      </div>

    </div>


  </div>

  <div class="tft-footer__lower">
    <div class="tft-footer__copyright-row">
      <p class="tft-footer__copyright-text">&copy; {{ date('Y') }} {{ config('app.name', 'Bharat Art & Craft') }}. All
        rights reserved. &bull; <a href="{{ route('page.show', 'terms-of-use') }}"
          style="color: inherit; text-decoration: underline;">Terms of Use</a> &bull; <a
          href="{{ route('page.show', 'privacy-policy') }}" style="color: inherit; text-decoration: underline;">Privacy
          Policy</a></p>
    </div>
  </div>
</footer>