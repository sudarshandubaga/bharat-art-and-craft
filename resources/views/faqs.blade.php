@extends('layouts.app')

@section('title', 'Frequently Asked Questions — ' . config('app.name', 'Bharat Art & Craft'))
@section('meta_description', 'Find answers to common questions about Bharat Art & Craft solid wood furniture, bespoke sizing, export delivery, warranty, and timber care.')
@section('body_class', 'fur-body tft-redesign-layout tft-page-contact')

@section('content')
  <h1 class="sr-only">Frequently Asked Questions — Bharat Art &amp; Craft</h1>

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
      <div class="fur-header__tag">Artisan Support</div>
      <div class="fur-header__ticker-wrap">
        <span class="fur-header__ticker-text">Transparent timelines, sustainable hardwood provenance, and generation-lasting craft.</span>
      </div>
    </div>
  </header>

  <!-- POST HERO SECTION -->
  <section class="tft-post-hero" id="wp-block-faqs-hero">
    <img class="tft-post-hero__img" src="{{ asset('assets/img/fur_room_living.png') }}" alt="Bharat Art &amp; Craft Showroom" width="1920" height="700" loading="eager">
    <div class="tft-post-hero__overlay"></div>
    <div class="tft-post-hero__content">
      <div class="tft-post-hero__breadcrumb">
        <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp; 
        <span>FAQs</span>
      </div>
      <span class="tft-post-hero__tag">Help &amp; Guidance</span>
      <h1 class="tft-post-hero__title">Frequently Asked Questions</h1>
      <p class="tft-post-hero__desc">Find answers about our artisan solid-wood craft, bespoke dimension customization, delivery timelines, and wood care.</p>
    </div>
  </section>

  <!-- MAIN FAQ CONTAINER -->
  <section class="tft-cnt-page" id="wp-block-faqs-content" style="margin-block-start: 0; padding-block-start: clamp(2rem, 4vw, 3.5rem);">
    <!-- Key Highlights Strip -->
    <div class="tft-cnt-features" style="margin-block-end: var(--fur-margin-block-lg); border-block: 1px solid var(--fur-border, #e8e4dc); padding-block: 24px;">
      <div class="tft-cnt-feature-card">
        <div class="tft-cnt-feature-card__icon-wrap">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div class="tft-cnt-feature-card__content">
          <strong class="tft-cnt-feature-card__title">100% Solid Hardwood</strong>
          <span class="tft-cnt-feature-card__desc">Sustainably sourced certified timbers</span>
        </div>
      </div>

      <div class="tft-cnt-feature-card">
        <div class="tft-cnt-feature-card__icon-wrap">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
        </div>
        <div class="tft-cnt-feature-card__content">
          <strong class="tft-cnt-feature-card__title">Custom Sizing Available</strong>
          <span class="tft-cnt-feature-card__desc">Tailored to your architectural spaces</span>
        </div>
      </div>

      <div class="tft-cnt-feature-card">
        <div class="tft-cnt-feature-card__icon-wrap">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
        </div>
        <div class="tft-cnt-feature-card__content">
          <strong class="tft-cnt-feature-card__title">White Glove Delivery</strong>
          <span class="tft-cnt-feature-card__desc">Careful in-room setup and inspection</span>
        </div>
      </div>

      <div class="tft-cnt-feature-card">
        <div class="tft-cnt-feature-card__icon-wrap">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <div class="tft-cnt-feature-card__content">
          <strong class="tft-cnt-feature-card__title">10-Year Craft Warranty</strong>
          <span class="tft-cnt-feature-card__desc">Generation-lasting structural integrity</span>
        </div>
      </div>
    </div>

    <!-- FAQ Accordion & Help Card Layout -->
    <div class="tft-cnt-faq-inspired">
      <!-- Accordion List Column -->
      <div class="tft-faq-main-col">
        <div style="display: flex; align-items: baseline; justify-content: space-between; margin-block-end: 24px;">
          <h2 class="tft-cnt-faq__title" style="margin-bottom: 0;">Frequently Asked Questions</h2>
          <span style="font-size: 0.8125rem; color: var(--fur-text-muted); font-weight: 600;">
            {{ $faqs->count() }} {{ Str::plural('question', $faqs->count()) }}
          </span>
        </div>

        <div class="tft-cnt-faq-list">
          @forelse($faqs as $fIndex => $faq)
          <div class="tft-cnt-faq-item tft-faq-card">
            <button type="button" class="tft-cnt-faq-btn" aria-expanded="{{ $fIndex === 0 ? 'true' : 'false' }}" data-tft-click="contact-toggle-faq">
              <span class="tft-faq-question-text">{{ $faq->question }}</span>
              <span class="tft-faq-icon-circle">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
              </span>
            </button>
            <div class="tft-cnt-faq-panel">
              <div class="tft-faq-answer-inner">
                <p>{!! nl2br(e($faq->answer)) !!}</p>
              </div>
            </div>
          </div>
          @empty
          <!-- Fallback Questions -->
          <div class="tft-cnt-faq-item tft-faq-card">
            <button type="button" class="tft-cnt-faq-btn" aria-expanded="true" data-tft-click="contact-toggle-faq">
              <span class="tft-faq-question-text">How long does delivery take for custom furniture orders?</span>
              <span class="tft-faq-icon-circle">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
              </span>
            </button>
            <div class="tft-cnt-faq-panel">
              <div class="tft-faq-answer-inner">
                <p>Ready-to-ship catalog items are dispatched within 3-5 business days. Bespoke finishes or customized spatial dimensions are hand-built by our master artisans in our workshops, typically taking between 14-28 business days depending on design complexity.</p>
              </div>
            </div>
          </div>

          <div class="tft-cnt-faq-item tft-faq-card">
            <button type="button" class="tft-cnt-faq-btn" aria-expanded="false" data-tft-click="contact-toggle-faq">
              <span class="tft-faq-question-text">Can I customize the dimensions, wood finish, or fabric of any piece?</span>
              <span class="tft-faq-icon-circle">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
              </span>
            </button>
            <div class="tft-cnt-faq-panel">
              <div class="tft-faq-answer-inner">
                <p>Yes, bespoke customization is our signature service. You can adjust length, width, height, timber finish (European Oak, Smoked Walnut, Bleached Ash), and upholstery fabrics. Visit our <a href="{{ route('consultation') }}" style="color: var(--fur-primary); font-weight: 600; text-decoration: underline;">Customized Enquiry</a> page to submit your spatial drawings or requirements.</p>
              </div>
            </div>
          </div>
          @endforelse
        </div>
      </div>

      <!-- Right Column: Sticky Consultation & Direct Contact Cards -->
      <div class="tft-faq-sticky-sidebar">
        <!-- Customized Enquiry Card -->
        <div class="tft-cnt-card tft-cnt-card--advice" style="border-radius: var(--fur-radius-lg, 14px); background: var(--fur-bg-elevated, #ffffff); padding: 32px; border: 1px solid var(--fur-border, #e8e4dc); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
          <div>
            <span style="font-size: 0.6875rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--fur-primary); display: block; margin-bottom: 8px;">BESPOKE FURNITURE</span>
            <h3 class="tft-cnt-card__title" style="margin-bottom: 12px; font-size: 1.25rem;">Need a custom size or finish?</h3>
            <p class="tft-cnt-card__desc" style="margin-bottom: 24px; line-height: 1.6; font-size: 0.875rem; color: var(--fur-text-muted);">Our master carpenters and interior architects build custom pieces tailored to your exact residential or commercial floorplans.</p>
          </div>
          
          <a href="{{ route('consultation') }}" class="tft-cnt-action-btn" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; width: 100%; padding: 14px 20px; font-weight: 600;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
            <span>Submit Customized Enquiry &rarr;</span>
          </a>
        </div>

        <!-- Still Have Questions Card -->
        <div class="tft-cnt-card" style="border-radius: var(--fur-radius-lg, 14px); background: var(--fur-bg-card, #f7f5f0); padding: 32px; border: 1px solid var(--fur-border, #e8e4dc);">
          <h3 class="tft-cnt-card__title" style="margin-bottom: 10px; font-size: 1.15rem;">Still have questions?</h3>
          <p class="tft-cnt-card__desc" style="margin-bottom: 20px; font-size: 0.875rem; color: var(--fur-text-muted); line-height: 1.55;">We're here to help. Reach our design concierge team via phone, email, or schedule an atelier visit.</p>
          
          <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; font-size: var(--fur-fs-small, 0.875rem);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--fur-primary)" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->phone ?? '+919876543210') }}" style="color: var(--fur-text); font-weight: 600; text-decoration: none;">{{ $site->phone ?? '+91 98765 43210' }}</a>
            </div>
            <div style="display: flex; align-items: center; gap: 12px; font-size: var(--fur-fs-small, 0.875rem);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--fur-primary)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <a href="mailto:{{ $site->email ?? 'info@bharatartandcraft.com' }}" style="color: var(--fur-text); font-weight: 600; text-decoration: none;">{{ $site->email ?? 'info@bharatartandcraft.com' }}</a>
            </div>
          </div>

          <a href="{{ route('contact') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--fur-primary); text-decoration: none;">
            <span>Visit Contact Page</span>
            <span>&rarr;</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <style>
    .tft-cnt-faq-inspired {
      display: grid !important;
      grid-template-columns: minmax(0, 1.8fr) minmax(320px, 380px) !important;
      gap: clamp(28px, 4vw, 56px) !important;
      align-items: start !important;
    }
    @media (max-width: 960px) {
      .tft-cnt-faq-inspired {
        grid-template-columns: 1fr !important;
      }
    }
    .tft-faq-sticky-sidebar {
      position: sticky;
      top: 120px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }
    @media (max-width: 960px) {
      .tft-faq-sticky-sidebar {
        position: static;
      }
    }
    .tft-cnt-faq-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .tft-faq-card {
      background: var(--fur-bg-elevated, #ffffff);
      border: 1px solid var(--fur-border, #e8e4dc);
      border-radius: 12px;
      padding: 0 24px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }
    .tft-faq-card:hover {
      border-color: color-mix(in srgb, var(--fur-primary, #3d5a1e) 40%, var(--fur-border, #e8e4dc));
    }
    .tft-faq-card:has(.tft-cnt-faq-btn[aria-expanded="true"]) {
      border-color: var(--fur-primary, #3d5a1e);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }
    .tft-cnt-faq-btn {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      padding-block: 20px;
      background: none;
      border: none;
      cursor: pointer;
      text-align: left;
      gap: 16px;
      font-family: var(--fur-font-serif, "Playfair Display", Georgia, serif);
      font-size: 1.05rem;
      font-weight: 500;
      color: var(--fur-text-primary, #1a1a18);
      transition: color 0.15s ease;
    }
    .tft-cnt-faq-btn:hover {
      color: var(--fur-primary, #3d5a1e);
    }
    .tft-faq-question-text {
      line-height: 1.4;
      flex-grow: 1;
    }
    .tft-faq-icon-circle {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: var(--fur-bg-card, #f4f1eb);
      color: var(--fur-text-muted, #7c776e);
      flex-shrink: 0;
      transition: background-color 0.2s ease, color 0.2s ease;
    }
    .tft-cnt-faq-btn[aria-expanded="true"] .tft-faq-icon-circle {
      background: color-mix(in srgb, var(--fur-primary, #3d5a1e) 15%, transparent);
      color: var(--fur-primary, #3d5a1e);
    }
    .tft-cnt-faq-btn[aria-expanded="true"] svg {
      transform: rotate(180deg) !important;
      color: var(--fur-primary, #3d5a1e) !important;
    }
    .tft-cnt-faq-panel {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .tft-faq-answer-inner {
      padding-block-end: 22px;
      border-block-start: 1px solid var(--fur-border, #f0ede6);
      padding-block-start: 14px;
    }
    .tft-faq-answer-inner p {
      font-family: var(--fur-font-sans, "Inter", sans-serif);
      font-size: 0.9375rem;
      line-height: 1.7;
      color: var(--fur-text-muted, #666);
      margin: 0;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Smoothly initialize any initially expanded FAQ accordion panel
      document.querySelectorAll('.tft-cnt-faq-btn[aria-expanded="true"]').forEach(function (btn) {
        var panel = btn.nextElementSibling;
        if (panel) {
          panel.style.maxHeight = panel.scrollHeight + 'px';
        }
      });
    });
  </script>
@endsection
