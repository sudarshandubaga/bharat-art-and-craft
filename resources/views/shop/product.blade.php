@extends('layouts.app')

@section('title', ($product ? $product->title . ' — ' : '') . config('app.name', 'Bharat Art & Craft'))
@section('meta_description', Str::limit(strip_tags($product->description ?? $product->excerpt ?? 'Explore craftsmanship details, timber choices, wood finishes, and metric CBM volume of our bespoke handcrafted furniture pieces.'), 160))
@section('layout_class', 'tft-layout-wide')

@push('styles')
<style>
  /* ==========================================================================
     GLOBAL PRODUCT SINGLE CONTAINER & RESPONSIVE LAYOUT
     ========================================================================== */
  .container {
    width: 100%;
    max-width: 1320px;
    margin-left: auto;
    margin-right: auto;
    padding-left: clamp(16px, 2.5vw, 32px);
    padding-right: clamp(16px, 2.5vw, 32px);
    box-sizing: border-box;
  }

  .tft-product-page-wrapper {
    --fur-atelier-bg: #faf8f5;
    --fur-atelier-card: #ffffff;
    --fur-atelier-border: rgba(30, 28, 24, 0.09);
    --fur-atelier-text: #1a1917;
    --fur-atelier-muted: #6b6760;
    --fur-atelier-primary: var(--fur-primary, #3d5a1e);
    --fur-atelier-gold: #c5a059;
    padding-block: 28px 64px;
  }

  /* Two-Column Responsive Product Layout */
  .tft-product-layout {
    display: grid;
    grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
    gap: clamp(28px, 4vw, 56px);
    align-items: start;
    margin-bottom: 48px;
  }
  @media (max-width: 991px) {
    .tft-product-layout {
      grid-template-columns: 1fr;
      gap: 36px;
    }
  }

  /* Top Navigation & Breadcrumbs Bar */
  .tft-ps-topbar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--fur-atelier-border);
  }
  .tft-ps-breadcrumbs {
    display: inline-flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    font-size: 0.8125rem;
    color: var(--fur-atelier-muted);
  }
  .tft-ps-breadcrumbs a {
    color: var(--fur-atelier-muted);
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .tft-ps-breadcrumbs a:hover {
    color: var(--fur-atelier-primary);
  }
  .tft-ps-breadcrumbs .active {
    color: var(--fur-atelier-text);
    font-weight: 600;
  }
  .tft-ps-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--fur-atelier-primary);
    text-decoration: none;
    padding: 7px 16px;
    border-radius: 999px;
    background: color-mix(in srgb, var(--fur-atelier-primary) 8%, #ffffff);
    border: 1px solid color-mix(in srgb, var(--fur-atelier-primary) 22%, transparent);
    transition: all 0.2s ease;
  }
  .tft-ps-back-btn:hover {
    background: var(--fur-atelier-primary);
    color: #ffffff;
    transform: translateX(-2px);
  }

  /* ==========================================================================
     MAGNIFY STAGE & INTERACTIVE GALLERY
     ========================================================================== */
  .tft-gallery-sticky {
    position: sticky;
    top: 24px;
    z-index: 20;
  }

  .tft-magnify-stage {
    position: relative;
    width: 100%;
    height: 480px;
    border-radius: 18px;
    background: var(--fur-atelier-bg);
    border: 1px solid var(--fur-atelier-border);
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: crosshair;
    user-select: none;
    transition: box-shadow 0.3s ease;
  }
  @media (min-width: 992px) {
    .tft-magnify-stage {
      height: 520px;
    }
  }
  .tft-magnify-stage:hover {
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.08);
  }

  /* Viewport holding image */
  .tft-magnify-viewport {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    pointer-events: none;
  }

  /* Main Stage Image */
  .tft-magnify-stage__img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 24px;
    transform-origin: center center;
    will-change: transform, transform-origin;
    transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.2s ease;
    pointer-events: none;
  }

  /* Circular Magnifier Loupe Lens Indicator */
  .tft-magnify-lens {
    position: absolute;
    width: 160px;
    height: 160px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 1px rgba(61, 90, 30, 0.3), 0 10px 32px rgba(0, 0, 0, 0.25), inset 0 0 20px rgba(255, 255, 255, 0.45);
    pointer-events: none;
    opacity: 0;
    transform: translate(-50%, -50%) scale(0.6);
    transition: opacity 0.2s ease, transform 0.2s ease;
    z-index: 6;
  }
  .tft-magnify-stage.is-zooming .tft-magnify-lens {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
  }

  /* Crosshair reticle lines inside lens */
  .tft-magnify-lens::before,
  .tft-magnify-lens::after {
    content: '';
    position: absolute;
    background: rgba(255, 255, 255, 0.65);
  }
  .tft-magnify-lens::before {
    top: 50%;
    left: 20%;
    right: 20%;
    height: 1px;
    transform: translateY(-50%);
  }
  .tft-magnify-lens::after {
    left: 50%;
    top: 20%;
    bottom: 20%;
    width: 1px;
    transform: translateX(-50%);
  }

  /* Top Actions on Stage (Fullscreen & Zoom In/Out) */
  .tft-stage-top-actions {
    position: absolute;
    top: 14px;
    right: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    z-index: 10;
  }
  .tft-stage-action-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid var(--fur-atelier-border);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(8px);
    color: var(--fur-atelier-text);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.2s ease;
  }
  .tft-stage-action-btn:hover {
    background: var(--fur-atelier-primary);
    color: #ffffff;
    transform: scale(1.08);
  }

  /* Stage SKU badge */
  .tft-stage-sku-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(8px);
    border: 1px solid var(--fur-atelier-border);
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--fur-atelier-text);
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  /* Stage CBM Badge */
  .tft-stage-cbm-badge {
    position: absolute;
    bottom: 14px;
    left: 14px;
    background: rgba(26, 25, 23, 0.85);
    backdrop-filter: blur(10px);
    color: #ffffff;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 0.8125rem;
    font-weight: 600;
    z-index: 10;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  /* Zoom Status Badge */
  .tft-stage-zoom-badge {
    position: absolute;
    bottom: 14px;
    right: 14px;
    background: rgba(26, 25, 23, 0.85);
    backdrop-filter: blur(10px);
    color: #ffffff;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 10;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    pointer-events: none;
    transition: all 0.2s ease;
  }
  .tft-magnify-stage.is-zooming .tft-stage-zoom-badge {
    background: var(--fur-atelier-primary);
    transform: scale(1.04);
  }

  /* Stage Chevrons */
  .tft-stage-nav-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid var(--fur-atelier-border);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(8px);
    color: var(--fur-atelier-text);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    opacity: 0;
    pointer-events: none;
    transition: all 0.25s ease;
  }
  .tft-stage-nav-arrow--prev { left: 14px; }
  .tft-stage-nav-arrow--next { right: 14px; }
  .tft-magnify-stage:hover .tft-stage-nav-arrow {
    opacity: 0.95;
    pointer-events: auto;
  }
  .tft-stage-nav-arrow:hover {
    opacity: 1 !important;
    background: var(--fur-atelier-primary);
    color: #ffffff;
    transform: translateY(-50%) scale(1.1);
  }

  /* Gallery Thumbnails */
  .tft-ps-thumbnails-wrap {
    margin-top: 16px;
  }
  .tft-ps-thumbnails {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    padding: 4px 2px 8px;
    scroll-behavior: smooth;
    scrollbar-width: thin;
  }
  .tft-ps-thumbnails::-webkit-scrollbar {
    height: 4px;
  }
  .tft-ps-thumbnails::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,0.15);
    border-radius: 999px;
  }
  .tft-ps-thumb {
    width: 82px;
    height: 82px;
    border-radius: 12px;
    border: 2px solid transparent;
    overflow: hidden;
    cursor: pointer;
    background: var(--fur-atelier-bg);
    flex-shrink: 0;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    padding: 3px;
    position: relative;
  }
  .tft-ps-thumb:hover {
    border-color: #d1c8bc;
    transform: translateY(-3px);
  }
  .tft-ps-thumb.active {
    border-color: var(--fur-atelier-primary);
    box-shadow: 0 0 0 2px color-mix(in srgb, var(--fur-atelier-primary) 30%, transparent), 0 6px 14px rgba(0,0,0,0.08);
    transform: translateY(-3px);
  }
  .tft-ps-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
  }
  .tft-ps-thumb__idx {
    position: absolute;
    top: 4px;
    right: 4px;
    font-size: 0.625rem;
    background: rgba(0,0,0,0.65);
    color: #fff;
    padding: 1px 5px;
    border-radius: 4px;
    font-weight: 700;
  }

  /* Gallery Atelier Guarantee Bar */
  .tft-gallery-guarantee {
    margin-top: 16px;
    padding: 14px 18px;
    background: var(--fur-atelier-bg);
    border: 1px solid var(--fur-atelier-border);
    border-radius: 12px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    font-size: 0.8125rem;
    color: var(--fur-atelier-muted);
  }
  .tft-gallery-guarantee span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  /* ==========================================================================
     RIGHT COLUMN: LUXURY DETAILS, CBM METRIC & ACTIONS
     ========================================================================== */
  .tft-ps-title {
    font-family: var(--fur-font-serif, 'Playfair Display', serif);
    font-size: clamp(2rem, 3.2vw, 2.75rem);
    font-weight: 700;
    color: var(--fur-atelier-text);
    line-height: 1.15;
    margin-bottom: 16px;
    letter-spacing: -0.01em;
  }

  /* CBM Export Metric Box */
  .tft-cbm-card {
    background: linear-gradient(135deg, color-mix(in srgb, var(--fur-atelier-primary) 8%, #ffffff) 0%, #ffffff 100%);
    border: 1.5px solid color-mix(in srgb, var(--fur-atelier-primary) 22%, #e5ded5);
    border-radius: 14px;
    padding: 18px 22px;
    margin-bottom: 24px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    position: relative;
    overflow: hidden;
  }
  .tft-cbm-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--fur-atelier-primary);
  }
  .tft-cbm-card__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 8px;
  }
  .tft-cbm-card__label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--fur-atelier-primary);
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .tft-cbm-card__val-row {
    display: flex;
    flex-wrap: wrap;
    align-items: baseline;
    gap: 12px;
  }
  .tft-cbm-card__val {
    font-family: var(--fur-font-serif, 'Playfair Display', serif);
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--fur-atelier-text);
    line-height: 1;
  }
  .tft-cbm-card__imperial {
    font-size: 0.875rem;
    color: var(--fur-atelier-muted);
    font-weight: 500;
  }
  .tft-cbm-card__container-est {
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px dashed color-mix(in srgb, var(--fur-atelier-primary) 20%, transparent);
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    font-size: 0.78rem;
    color: var(--fur-atelier-muted);
  }

  /* Specification Tiles Grid */
  .tft-spec-tiles {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 24px;
  }
  @media (max-width: 576px) {
    .tft-spec-tiles {
      grid-template-columns: 1fr;
    }
  }
  .tft-spec-tile {
    background: var(--fur-atelier-bg);
    border: 1px solid var(--fur-atelier-border);
    border-radius: 12px;
    padding: 14px 16px;
    transition: all 0.2s ease;
  }
  .tft-spec-tile:hover {
    border-color: #d1c8bc;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
  }
  .tft-spec-tile__label {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--fur-atelier-muted);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .tft-spec-tile__value {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--fur-atelier-text);
  }

  /* Action Box (Prominent CTA Button - Qty removed) */
  .tft-action-box {
    background: #ffffff;
    border: 1.5px solid var(--fur-atelier-border);
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.04);
    margin-bottom: 24px;
  }
  .tft-btn-quote-primary {
    width: 100%;
    height: 54px;
    background: var(--fur-atelier-primary);
    color: #ffffff;
    border: none;
    border-radius: 12px;
    padding-inline: 28px;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    cursor: pointer;
    box-shadow: 0 6px 20px color-mix(in srgb, var(--fur-atelier-primary) 35%, transparent);
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .tft-btn-quote-primary:hover {
    background: color-mix(in srgb, var(--fur-atelier-primary) 85%, #000000);
    transform: translateY(-2px);
    box-shadow: 0 10px 28px color-mix(in srgb, var(--fur-atelier-primary) 45%, transparent);
    color: #ffffff;
  }
  .tft-btn-quote-primary:active {
    transform: translateY(0);
  }

  /* ==========================================================================
     EXTENDED SECTION: DESCRIPTION & TRADE FAQS (MOVED BELOW TOP GRID)
     ========================================================================== */
  .tft-product-extended-sec {
    background: #ffffff;
    border: 1px solid var(--fur-atelier-border);
    border-radius: 20px;
    padding: clamp(24px, 4vw, 44px);
    margin-bottom: 56px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.03);
  }

  .tft-extended-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(28px, 4vw, 56px);
    align-items: start;
  }
  @media (max-width: 991px) {
    .tft-extended-grid {
      grid-template-columns: 1fr;
      gap: 40px;
    }
  }

  .tft-sec-heading-group {
    margin-bottom: 24px;
  }
  .tft-sec-tag {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--fur-atelier-primary);
    margin-bottom: 6px;
  }
  .tft-sec-title {
    font-family: var(--fur-font-serif, 'Playfair Display', serif);
    font-size: clamp(1.4rem, 2.2vw, 1.85rem);
    font-weight: 700;
    color: var(--fur-atelier-text);
    margin: 0;
  }

  /* Story / Description Column */
  .tft-story-body {
    font-size: 0.95rem;
    line-height: 1.8;
    color: #4a4742;
    margin-bottom: 24px;
  }

  .tft-craft-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-top: 24px;
  }
  @media (max-width: 576px) {
    .tft-craft-features {
      grid-template-columns: 1fr;
    }
  }
  .tft-craft-feat-card {
    background: var(--fur-atelier-bg);
    border: 1px solid var(--fur-atelier-border);
    border-radius: 12px;
    padding: 16px;
  }
  .tft-craft-feat-card__title {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--fur-atelier-text);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
  }
  .tft-craft-feat-card__desc {
    font-size: 0.78rem;
    line-height: 1.5;
    color: var(--fur-atelier-muted);
    margin: 0;
  }

  /* FAQs Column & Accordions */
  .tft-faq-accordion {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .tft-faq-item {
    border: 1px solid var(--fur-atelier-border);
    border-radius: 12px;
    background: var(--fur-atelier-bg);
    overflow: hidden;
    transition: all 0.2s ease;
  }
  .tft-faq-item:hover {
    border-color: #d1c8bc;
    background: #ffffff;
  }
  .tft-faq-question {
    width: 100%;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    background: transparent;
    border: none;
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--fur-atelier-text);
    text-align: left;
    cursor: pointer;
    line-height: 1.4;
  }
  .tft-faq-chevron {
    flex-shrink: 0;
    font-size: 0.875rem;
    color: var(--fur-atelier-primary);
    transition: transform 0.25s ease;
  }
  .tft-faq-question:not(.collapsed) .tft-faq-chevron {
    transform: rotate(180deg);
  }
  .tft-faq-answer {
    display: none;
    padding: 0 20px 18px;
    font-size: 0.875rem;
    line-height: 1.65;
    color: var(--fur-atelier-muted);
    border-top: 1px dashed rgba(0,0,0,0.06);
    padding-top: 12px;
  }
  .tft-faq-answer.is-open {
    display: block;
    animation: tftFadeIn 0.2s ease;
  }

  /* ==========================================================================
     RELATED PRODUCTS CAROUSEL
     ========================================================================== */
  .tft-related-section {
    margin-top: 56px;
    padding-top: 24px;
  }
  .tft-related-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
  }
  .tft-carousel-nav-controls {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .tft-carousel-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid var(--fur-atelier-border);
    background: #ffffff;
    color: var(--fur-atelier-text);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
  }
  .tft-carousel-btn:hover {
    background: var(--fur-atelier-primary);
    border-color: var(--fur-atelier-primary);
    color: #ffffff;
    transform: scale(1.08);
  }

  /* Carousel Track */
  .tft-related-carousel-track {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    padding: 8px 4px 24px;
    scrollbar-width: thin;
  }
  .tft-related-carousel-track::-webkit-scrollbar {
    height: 5px;
  }
  .tft-related-carousel-track::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,0.18);
    border-radius: 999px;
  }

  /* Carousel Card */
  .tft-carousel-card {
    flex: 0 0 calc(25% - 18px);
    scroll-snap-align: start;
    background: #ffffff;
    border: 1px solid var(--fur-atelier-border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  @media (max-width: 1200px) {
    .tft-carousel-card { flex: 0 0 calc(33.333% - 16px); }
  }
  @media (max-width: 860px) {
    .tft-carousel-card { flex: 0 0 calc(50% - 12px); }
  }
  @media (max-width: 540px) {
    .tft-carousel-card { flex: 0 0 280px; }
  }
  .tft-carousel-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
  }

  .tft-carousel-card__img-wrap {
    position: relative;
    aspect-ratio: 1 / 1;
    background: var(--fur-atelier-bg);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }
  .tft-carousel-card__img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.35s ease;
  }
  .tft-carousel-card:hover .tft-carousel-card__img {
    transform: scale(1.06);
  }

  .tft-carousel-card__body {
    padding: 18px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
  .tft-carousel-card__cat {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--fur-atelier-primary);
    margin-bottom: 6px;
    text-decoration: none;
  }
  .tft-carousel-card__title {
    font-family: var(--fur-font-serif, 'Playfair Display', serif);
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--fur-atelier-text);
    margin: 0 0 12px 0;
    line-height: 1.3;
  }
  .tft-carousel-card__title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
  }
  .tft-carousel-card__title a:hover {
    color: var(--fur-atelier-primary);
  }

  .tft-carousel-card__footer {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid var(--fur-atelier-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }
  .tft-carousel-card__cbm {
    font-size: 0.8125rem;
    font-weight: 700;
    color: var(--fur-atelier-primary);
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: color-mix(in srgb, var(--fur-atelier-primary) 8%, #ffffff);
    padding: 4px 10px;
    border-radius: 6px;
  }
  .tft-carousel-card__add-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid var(--fur-atelier-border);
    background: var(--fur-atelier-bg);
    color: var(--fur-atelier-text);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .tft-carousel-card__add-btn:hover {
    background: var(--fur-atelier-primary);
    border-color: var(--fur-atelier-primary);
    color: #ffffff;
    transform: scale(1.1);
  }

  /* ==========================================================================
     FULLSCREEN HIGH-DEFINITION LIGHTBOX MODAL
     ========================================================================== */
  .tft-lightbox-modal {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
  }
  .tft-lightbox-modal.is-open {
    display: flex;
  }
  .tft-lightbox-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(12, 11, 10, 0.94);
    backdrop-filter: blur(16px);
  }
  .tft-lightbox-content {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    z-index: 2;
  }
  .tft-lightbox-topbar {
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #ffffff;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  .tft-lightbox-title {
    font-family: var(--fur-font-serif, 'Playfair Display', serif);
    font-size: 1.15rem;
  }
  .tft-lightbox-tools {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .tft-lightbox-tool-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .tft-lightbox-tool-btn:hover {
    background: var(--fur-atelier-primary);
    border-color: var(--fur-atelier-primary);
    transform: scale(1.08);
  }
  .tft-lightbox-stage-area {
    flex-grow: 1;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 24px;
  }
  .tft-lightbox-img-wrap {
    max-width: 90vw;
    max-height: 75vh;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: grab;
    transition: transform 0.15s ease-out;
  }
  .tft-lightbox-img-wrap:active {
    cursor: grabbing;
  }
  .tft-lightbox-img {
    max-width: 100%;
    max-height: 75vh;
    object-fit: contain;
    user-select: none;
    border-radius: 8px;
  }
  .tft-lightbox-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(8px);
    color: #ffffff;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    z-index: 10;
  }
  .tft-lightbox-arrow:hover {
    background: var(--fur-atelier-primary);
    border-color: var(--fur-atelier-primary);
    transform: translateY(-50%) scale(1.1);
  }
  .tft-lightbox-arrow--prev { left: 24px; }
  .tft-lightbox-arrow--next { right: 24px; }

  .tft-lightbox-bottom-tray {
    padding: 16px 24px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
    gap: 12px;
    overflow-x: auto;
  }
  .tft-lightbox-tray-thumb {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    border: 2px solid transparent;
    cursor: pointer;
    overflow: hidden;
    opacity: 0.6;
    transition: all 0.2s ease;
    background: rgba(255,255,255,0.05);
  }
  .tft-lightbox-tray-thumb:hover {
    opacity: 0.9;
  }
  .tft-lightbox-tray-thumb.active {
    opacity: 1;
    border-color: var(--fur-atelier-primary);
    box-shadow: 0 0 12px var(--fur-atelier-primary);
  }
  .tft-lightbox-tray-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
@endpush

@section('sidebar')
  <aside class="fur-sidebar" aria-label="Main Navigation">
    <div class="fur-sidebar__header">
      <a href="{{ route('home') }}" class="fur-sidebar__logo" aria-label="Bharat Art &amp; Craft">
        <span class="tft-kave-logo">Bharat Art &amp; Craft</span>
      </a>
      <button class="fur-sidebar__toggle" id="fur-menu-toggle" aria-expanded="false" aria-label="Toggle Menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
          <line x1="4" y1="12" x2="20" y2="12"></line>
          <line x1="4" y1="6" x2="20" y2="6"></line>
          <line x1="4" y1="18" x2="20" y2="18"></line>
        </svg>
      </button>
    </div>

    <nav class="fur-sidebar__nav" id="fur-sidebar-menu">
      <ul class="fur-sidebar__nav-list">
        <li class="fur-sidebar__nav-item">
          <a class="fur-sidebar__nav-link" href="{{ route('home') }}">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fur-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            <span>Home</span>
          </a>
        </li>
        <li class="fur-sidebar__nav-item">
          <a class="fur-sidebar__nav-link" href="{{ route('shop') }}">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fur-icon"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            <span>Catalog</span>
          </a>
        </li>
        <li class="fur-sidebar__nav-item">
          <a class="fur-sidebar__nav-link" href="{{ route('consultation') }}">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fur-icon"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            <span>Custom Quote</span>
          </a>
        </li>
        <li class="fur-sidebar__nav-item">
          <a class="fur-sidebar__nav-link" href="{{ route('about') }}">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fur-icon"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
            <span>Our Atelier</span>
          </a>
        </li>
        <li class="fur-sidebar__nav-item">
          <a class="fur-sidebar__nav-link" href="{{ route('contact') }}">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fur-icon"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v4l3 3"></path></svg>
            <span>Contact</span>
          </a>
        </li>
      </ul>
    </nav>

    <div class="fur-sidebar__footer">
      <button class="fur-sidebar__action-btn" aria-label="Search" id="fur-search-trigger">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
      <button class="fur-sidebar__action-btn fur-sidebar__action-btn--cart" aria-label="Quote Cart"
        id="fur-cart-trigger-sidebar">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
          <circle cx="8" cy="21" r="1"></circle>
          <circle cx="19" cy="21" r="1"></circle>
          <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
        </svg>
        <span class="fur-sidebar__cart-count">0</span>
      </button>
    </div>
  </aside>
@endsection

@section('content')
<div class="tft-product-page-wrapper">
  <!-- PRIMARY CONTAINER WRAPPER -->
  <div class="container">
    <h1 class="sr-only">{{ $product->title ?? 'Product Spotlight' }} — Bharat Art & Craft</h1>

    <!-- TOP NAVIGATION & BREADCRUMBS -->
    <div class="tft-ps-topbar">
      <div class="tft-ps-breadcrumbs">
        <a href="{{ route('home') }}"><i class="bi bi-house-door me-1"></i>Home</a>
        <span>&rsaquo;</span>
        <a href="{{ route('shop') }}">Catalog</a>
        @if($product->category)
          <span>&rsaquo;</span>
          <a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a>
        @endif
        <span>&rsaquo;</span>
        <span class="active">{{ Str::limit($product->title, 40) }}</span>
      </div>

      <div class="d-flex align-items-center gap-2">
        <a href="{{ route('shop') }}" class="tft-ps-back-btn">
          <i class="bi bi-arrow-left"></i> Back to Catalog
        </a>
        <span class="badge bg-light text-muted border px-3 py-2 d-none d-sm-inline-flex align-items-center gap-1" style="font-size: 0.75rem;">
          <i class="bi bi-shield-check text-success"></i> Jodhpur Workshop Direct
        </span>
      </div>
    </div>

    @php
      $galleryList = collect();
      if (!empty($product->image_url)) {
          $galleryList->push($product->image_url);
      }
      if ($product->images && $product->images->isNotEmpty()) {
          foreach ($product->images as $img) {
              if ($img->image_url !== $product->image_url) {
                  $galleryList->push($img->image_url);
              }
          }
      }
      if ($galleryList->isEmpty()) {
          $galleryList->push(asset('assets/img/fur_chair_boucle.png'));
      }

      $cbmNum = (float)($product->cbm ?: 0.45);
      $cuFtNum = round($cbmNum * 35.3147, 1);
      $units40hq = $cbmNum > 0 ? floor(68 / $cbmNum) : 150;

      $productWood = $product->wood?->name ?? ($product->material ?? 'Sheesham Wood (Indian Rosewood)');
      $productFinish = $product->finish?->name ?? 'Natural Hand-Rubbed Oil';
    @endphp

    <!-- TWO-COLUMN TOP PRODUCT GRID (Gallery + Essential Buy Box) -->
    <div class="tft-product-layout">

      <!-- LEFT COLUMN: INTERACTIVE MAGNIFY GALLERY -->
      <div>
        <div class="tft-gallery-sticky">

          <!-- INTERACTIVE MAGNIFIER STAGE -->
          <div id="tft-main-stage-container" class="tft-magnify-stage"
               role="region" aria-label="Product Image Magnifier">
            
            <!-- SKU Pill -->
            @if($product->code)
              <div class="tft-stage-sku-badge">
                <i class="bi bi-hash text-muted"></i>
                <span class="font-monospace">{{ $product->code }}</span>
              </div>
            @endif

            <!-- Stage Top Actions (Zoom Toggle & Fullscreen) -->
            <div class="tft-stage-top-actions">
              <button type="button" class="tft-stage-action-btn" onclick="toggleStageZoom(event)" title="Toggle Magnify In/Out" id="btn-toggle-zoom">
                <i class="bi bi-zoom-in" id="icon-toggle-zoom"></i>
              </button>
              <button type="button" class="tft-stage-action-btn" onclick="openLightboxModal(event)" title="Expand Fullscreen High-Definition" aria-label="Expand image">
                <i class="bi bi-arrows-fullscreen"></i>
              </button>
            </div>

            <!-- Left/Right chevrons for fast paging -->
            @if($galleryList->count() > 1)
              <button type="button" class="tft-stage-nav-arrow tft-stage-nav-arrow--prev"
                      onclick="event.stopPropagation(); navigateGallery(-1)"
                      aria-label="Previous view">
                <i class="bi bi-chevron-left"></i>
              </button>
              <button type="button" class="tft-stage-nav-arrow tft-stage-nav-arrow--next"
                      onclick="event.stopPropagation(); navigateGallery(1)"
                      aria-label="Next view">
                <i class="bi bi-chevron-right"></i>
              </button>
            @endif

            <!-- Main Stage Image Viewport -->
            <div class="tft-magnify-viewport" id="tft-magnify-viewport">
              <img id="main-product-stage-img"
                   src="{{ $galleryList->first() }}"
                   alt="{{ $product->title }}"
                   class="tft-magnify-stage__img"
                   loading="eager"
                   draggable="false">
            </div>

            <!-- The Magnifying Loupe Lens Indicator -->
            <div id="tft-magnify-lens" class="tft-magnify-lens" aria-hidden="true"></div>

            <!-- Bottom Left: CBM Volume Chip -->
            <div class="tft-stage-cbm-badge">
              <i class="bi bi-box-seam text-warning"></i>
              <span>{{ $product->cbm ? $product->cbm . ' CBM' : '0.45 CBM' }}</span>
            </div>

            <!-- Bottom Right: Interactive Zoom Helper Badge -->
            <div class="tft-stage-zoom-badge" id="tft-zoom-status-badge">
              <i class="bi bi-zoom-in"></i>
              <span id="tft-zoom-status-text">Hover to Magnify</span>
            </div>
          </div>

          <!-- THUMBNAILS CAROUSEL / STRIP -->
          @if($galleryList->count() > 1)
            <div class="tft-ps-thumbnails-wrap">
              <div class="tft-ps-thumbnails" id="product-thumbnails-container">
                @foreach($galleryList as $tIdx => $tImg)
                  <div class="tft-ps-thumb {{ $tIdx === 0 ? 'active' : '' }}"
                       data-index="{{ $tIdx }}"
                       onclick="switchProductStageImage('{{ $tImg }}', {{ $tIdx }})">
                    <img src="{{ $tImg }}" alt="{{ $product->title }} angle {{ $tIdx + 1 }}">
                    <span class="tft-ps-thumb__idx">{{ $tIdx + 1 }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Atelier Workshop Quality Guarantee Bar -->
          <div class="tft-gallery-guarantee">
            <span><i class="bi bi-shield-check text-success"></i> 100% Solid Seasoned Timber</span>
            <span><i class="bi bi-camera text-primary"></i> Actual Workshop Photos</span>
            <span><i class="bi bi-arrows-fullscreen text-secondary"></i> Click to Zoom Fullscreen</span>
          </div>

        </div>
      </div>

      <!-- RIGHT COLUMN: LUXURY DETAILS, CBM METRIC & PRIMARY CTA -->
      <div>
        <div class="ps-lg-2">

          <!-- Category & Badges Header -->
          <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle text-uppercase fw-bold px-3 py-1 rounded-pill" style="font-size: 0.72rem; letter-spacing: 0.08em;">
              <i class="bi bi-gem me-1"></i> {{ $product->category?->name ?? 'Handcrafted Collection' }}
            </span>
            <span class="badge bg-light text-muted border px-2 py-1 rounded-pill" style="font-size: 0.72rem;">
              Export Ready
            </span>
          </div>

          <!-- Product Title -->
          <h1 class="tft-ps-title">{{ $product->title }}</h1>

          <!-- LUXURY CBM TRADE VOLUME HIGHLIGHT BOX -->
          <div class="tft-cbm-card">
            <div class="tft-cbm-card__header">
              <span class="tft-cbm-card__label">
                <i class="bi bi-box-seam"></i> Export &amp; Trade Metric Volume
              </span>
              <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill" style="font-size: 0.72rem;">
                <i class="bi bi-patch-check-fill me-1"></i> Trade Spec
              </span>
            </div>

            <div class="tft-cbm-card__val-row">
              <span class="tft-cbm-card__val">{{ $product->cbm ? $product->cbm . ' CBM' : '0.45 CBM' }}</span>
              <span class="tft-cbm-card__imperial">({{ $cuFtNum }} cu ft volume)</span>
            </div>

            <div class="tft-cbm-card__container-est">
              <span>
                <i class="bi bi-truck me-1 text-primary"></i> Est. Container Capacity: <strong>~{{ $units40hq }} units</strong> per 40&prime; HQ (68 CBM)
              </span>
              <span class="text-muted small">LCL / FCL palletized</span>
            </div>
          </div>

          <!-- ARTISANAL SPECIFICATION TILES -->
          <div class="tft-spec-tiles">
            <div class="tft-spec-tile">
              <div class="tft-spec-tile__label">
                <i class="bi bi-tree text-success"></i> Timber / Species
              </div>
              <div class="tft-spec-tile__value" id="spec-wood-name">
                {{ $productWood }}
              </div>
              <div class="text-muted mt-1" style="font-size: 0.75rem;">Kiln Seasoned (&lt;12% moisture)</div>
            </div>

            <div class="tft-spec-tile">
              <div class="tft-spec-tile__label">
                <i class="bi bi-brush text-primary"></i> Surface Polish / Finish
              </div>
              <div class="tft-spec-tile__value" id="spec-finish-name">
                {{ $productFinish }}
              </div>
              <div class="text-muted mt-1" style="font-size: 0.75rem;">Non-toxic organic wax seal</div>
            </div>

            <div class="tft-spec-tile">
              <div class="tft-spec-tile__label">
                <i class="bi bi-hammer text-warning"></i> Master Joinery
              </div>
              <div class="tft-spec-tile__value">
                Mortise &amp; Tenon Joints
              </div>
              <div class="text-muted mt-1" style="font-size: 0.75rem;">Traditional generational craft</div>
            </div>

            <div class="tft-spec-tile">
              <div class="tft-spec-tile__label">
                <i class="bi bi-geo-alt text-danger"></i> Atelier Provenance
              </div>
              <div class="tft-spec-tile__value">
                Jodhpur, Rajasthan, India
              </div>
              <div class="text-muted mt-1" style="font-size: 0.75rem;">Direct workshop dispatch</div>
            </div>
          </div>

          <!-- PRIMARY ACTION BOX (Add to Quote Cart - Qty Stepper Removed) -->
          <div class="tft-action-box">
            <button type="button"
                    id="btn-add-to-quote-detail"
                    class="tft-btn-quote-primary"
                    onclick="submitProductToQuote({{ $product->id }})">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="8" cy="21" r="1"></circle>
                <circle cx="19" cy="21" r="1"></circle>
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
              </svg>
              <span>Add to Quote Cart</span>
            </button>

            <div class="mt-3 pt-3 border-top d-flex flex-wrap align-items-center justify-content-between gap-2">
              <span class="small text-muted d-inline-flex align-items-center gap-1">
                <i class="bi bi-shield-lock-fill text-success"></i> No upfront payment required &bull; Direct workshop quote
              </span>
              <a href="{{ route('consultation', ['item' => $product->title]) }}" class="small fw-semibold text-decoration-none" style="color: var(--fur-atelier-primary);">
                Need Custom Dimensions? Request Drawing &rarr;
              </a>
            </div>
          </div>

          <!-- TRUST BADGES MINI STRIP -->
          <div class="p-3 bg-light rounded-3 border d-flex flex-wrap align-items-center justify-content-between gap-2 text-muted small">
            <span><i class="bi bi-box-seam text-primary me-1"></i> 7-Ply Palletized Sea Packaging</span>
            <span><i class="bi bi-globe me-1"></i> Global Port Dispatch (ICD/FCL)</span>
          </div>

        </div>
      </div>
    </div>

    <!-- ==========================================================================
         EXTENDED SECTION: DESCRIPTION & TRADE FAQS (MOVED BELOW TOP GRID)
         ========================================================================== -->
    <section class="tft-product-extended-sec" id="product-story-and-faqs">
      <div class="tft-extended-grid">
        
        <!-- COLUMN 1: PRODUCT STORY & CRAFTSMANSHIP DESCRIPTION -->
        <div>
          <div class="tft-sec-heading-group">
            <span class="tft-sec-tag">Artisan Provenance</span>
            <h2 class="tft-sec-title">Architectural Details &amp; Craftsmanship</h2>
          </div>

          <div class="tft-story-body">
            @if(!empty($product->description))
              {!! nl2br(e($product->description)) !!}
            @else
              <p>
                Every contour and joint of the <strong>{{ $product->title }}</strong> is individually hand-shaped by generational master wood artisans at our Jodhpur atelier. Built using legally harvested seasoned timber, this piece unites classical Rajasthani carving precision with refined modern proportions.
              </p>
              <p>
                Assembled using structural mortise-and-tenon joints, the frame resists seasonal contraction and expansion across international climates. Each surface is carefully sanded across multiple grits before receiving hand-rubbed organic wax finish to highlight the natural timber grain.
              </p>
            @endif
          </div>

          <!-- Craftsmanship Highlight Features -->
          <div class="tft-craft-features">
            <div class="tft-craft-feat-card">
              <div class="tft-craft-feat-card__title">
                <i class="bi bi-droplet-half text-primary"></i> Kiln Seasoned
              </div>
              <p class="tft-craft-feat-card__desc">
                Chamber-dried to &lt;12% moisture to prevent warping, splitting, or surface cracking across climates.
              </p>
            </div>

            <div class="tft-craft-feat-card">
              <div class="tft-craft-feat-card__title">
                <i class="bi bi-hammer text-warning"></i> Mortise &amp; Tenon
              </div>
              <p class="tft-craft-feat-card__desc">
                Interlocking wood joints crafted without brittle nails for heirloom-grade structural longevity.
              </p>
            </div>

            <div class="tft-craft-feat-card">
              <div class="tft-craft-feat-card__title">
                <i class="bi bi-shield-check text-success"></i> Fumigation Certified
              </div>
              <p class="tft-craft-feat-card__desc">
                Heat-treated or Methyl Bromide certified for complete international customs compliance.
              </p>
            </div>

            <div class="tft-craft-feat-card">
              <div class="tft-craft-feat-card__title">
                <i class="bi bi-sliders text-secondary"></i> Custom Adjustments
              </div>
              <p class="tft-craft-feat-card__desc">
                Dimensions, wood species, and polishes can be tailored for architects and interior trade projects.
              </p>
            </div>
          </div>
        </div>

        <!-- COLUMN 2: FREQUENTLY ASKED QUESTIONS (FAQS) -->
        <div>
          <div class="tft-sec-heading-group">
            <span class="tft-sec-tag">Trade &amp; Purchasing</span>
            <h2 class="tft-sec-title">Frequently Asked Questions</h2>
          </div>

          <div class="tft-faq-accordion" id="productFaqAccordion">
            @php
              $tradeFaqs = [
                [
                  'q' => 'How does the quotation and ordering process work?',
                  'a' => 'Add the items to your Quote Cart and submit your request. Our workshop team calculates export freight, packaging, and custom finish options, returning a formal proforma quote within 24 business hours. No payment is required upfront.'
                ],
                [
                  'q' => 'Can we customize the dimensions, wood species, or finish?',
                  'a' => 'Yes. As a direct Jodhpur manufacturer, we accommodate bespoke measurements, wood species (Teak, Sheesham, Acacia, Oak, Mango), and bespoke distress or polish stains. Share your architectural drawings via the consultation form.'
                ],
                [
                  'q' => 'What is the CBM volume and how is export packaging handled?',
                  'a' => 'Unit volume is stated in CBM (cubic meters). All furniture pieces are packed in 7-ply heavy corrugated cartons with high-density EPE edge buffers and sea-worthy wooden pallet crating for LCL and FCL container shipments.'
                ],
                [
                  'q' => 'What are the production lead times for trade orders?',
                  'a' => 'Standard handcrafted production lead time is 2 to 4 weeks depending on batch volume. We dispatch directly to inland container depots (ICD) or major ports (Mundra, Nhava Sheva).'
                ],
                [
                  'q' => 'Is fumigation certification provided for international export?',
                  'a' => 'Yes. All export orders receive official Government-accredited Methyl Bromide or Heat Treatment (ISPM 15) fumigation and phytosanitary certificates for smooth customs clearance worldwide.'
                ]
              ];

              if (isset($faqs) && $faqs->isNotEmpty()) {
                  $faqItems = $faqs->map(fn($f) => ['q' => $f->question, 'a' => $f->answer])->toArray();
              } else {
                  $faqItems = $tradeFaqs;
              }
            @endphp

            @foreach($faqItems as $fIdx => $item)
              <div class="tft-faq-item">
                <button type="button" class="tft-faq-question {{ $fIdx === 0 ? '' : 'collapsed' }}" onclick="toggleFaqAccordion(this)">
                  <span>{{ $item['q'] }}</span>
                  <i class="bi bi-chevron-down tft-faq-chevron"></i>
                </button>
                <div class="tft-faq-answer {{ $fIdx === 0 ? 'is-open' : '' }}">
                  {!! nl2br(e($item['a'])) !!}
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>
    </section>

    <!-- TRUST STRIP -->
    <div class="tft-ps-trust" id="wp-block-ps-trust">
      <div class="tft-ps-trust__item">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
        </svg>
        <div><strong>Sustainably Sourced</strong><span>Kiln-dried seasoned timber</span></div>
      </div>
      <div class="tft-ps-trust__item">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
        </svg>
        <div><strong>Master Joinery</strong><span>Traditional hand-carved joinery</span></div>
      </div>
      <div class="tft-ps-trust__item">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
          <rect x="1" y="3" width="15" height="13" rx="2" />
          <polygon points="16 8 20 8 23 11 23 16 16 16 8" />
          <circle cx="5.5" cy="18.5" r="2.5" />
          <circle cx="18.5" cy="18.5" r="2.5" />
        </svg>
        <div><strong>Palletized Dispatch</strong><span>Sea-worthy wooden crate packing</span></div>
      </div>
      <div class="tft-ps-trust__item">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
          <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67" />
        </svg>
        <div><strong>Direct Factory Quote</strong><span>Tailored wholesale specifications</span></div>
      </div>
    </div>

    <!-- ==========================================================================
         RELATED PRODUCTS CAROUSEL
         ========================================================================== -->
    @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
      <section class="tft-related-section" id="wp-block-ps-related-carousel">
        <div class="tft-related-header">
          <div>
            <span class="tft-sec-tag">Handcrafted Atelier Pieces</span>
            <h3 class="tft-sec-title">Related Furniture Designs</h3>
          </div>
          <div class="tft-carousel-nav-controls">
            <button type="button" class="tft-carousel-btn" onclick="scrollRelatedCarousel(-1)" aria-label="Scroll left">
              <i class="bi bi-chevron-left"></i>
            </button>
            <button type="button" class="tft-carousel-btn" onclick="scrollRelatedCarousel(1)" aria-label="Scroll right">
              <i class="bi bi-chevron-right"></i>
            </button>
            <a href="{{ route('shop') }}" class="btn btn-sm btn-outline-dark px-3 ms-2" style="border-radius: 999px;">
              View Catalog &rarr;
            </a>
          </div>
        </div>

        <!-- CAROUSEL TRACK -->
        <div class="tft-related-carousel-track" id="related-carousel-track">
          @foreach($relatedProducts as $rel)
            <article class="tft-carousel-card" data-prod-id="{{ $rel->id }}" data-id="{{ $rel->id }}">
              <div class="tft-carousel-card__img-wrap">
                <a href="{{ route('product.single', $rel->slug) }}" class="d-block w-100 h-100 text-center">
                  <img class="tft-carousel-card__img" src="{{ $rel->image_url }}" alt="{{ $rel->title }}" loading="lazy">
                </a>
              </div>
              <div class="tft-carousel-card__body">
                @if($rel->category)
                  <a href="{{ route('category.show', $rel->category->slug) }}" class="tft-carousel-card__cat">
                    {{ $rel->category->name }}
                  </a>
                @else
                  <span class="tft-carousel-card__cat">Furniture</span>
                @endif
                <h4 class="tft-carousel-card__title">
                  <a href="{{ route('product.single', $rel->slug) }}">{{ $rel->title }}</a>
                </h4>
                <div class="tft-carousel-card__footer">
                  <span class="tft-carousel-card__cbm">
                    <i class="bi bi-box-seam me-1"></i>{{ $rel->cbm ? $rel->cbm . ' CBM' : '0.45 CBM' }}
                  </span>
                  <button type="button"
                          class="tft-carousel-card__add-btn"
                          data-prod-id="{{ $rel->id }}"
                          onclick="event.stopPropagation(); if(window.FUR_Theme) window.FUR_Theme.addToCart({{ $rel->id }})"
                          title="Add to Quote"
                          aria-label="Add to Quote">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  </button>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      </section>
    @endif

  </div>
</div>

<!-- ==========================================================================
     FULLSCREEN HIGH-DEFINITION LIGHTBOX MODAL
     ========================================================================== -->
<div id="tft-product-lightbox" class="tft-lightbox-modal" aria-hidden="true" role="dialog" aria-modal="true">
  <div class="tft-lightbox-backdrop" onclick="closeLightboxModal()"></div>
  <div class="tft-lightbox-content">
    <div class="tft-lightbox-topbar">
      <div class="tft-lightbox-title">
        <span>{{ $product->title }}</span>
        <span class="ms-3 text-white-50 font-monospace small" id="lightbox-counter-label">1 / {{ $galleryList->count() }}</span>
      </div>
      <div class="tft-lightbox-tools">
        <button type="button" class="tft-lightbox-tool-btn" onclick="lightboxZoom(-0.3)" title="Zoom Out" aria-label="Zoom out">
          <i class="bi bi-dash-lg"></i>
        </button>
        <button type="button" class="tft-lightbox-tool-btn" onclick="lightboxResetZoom()" title="Reset Zoom" aria-label="Reset zoom">
          <i class="bi bi-aspect-ratio"></i>
        </button>
        <button type="button" class="tft-lightbox-tool-btn" onclick="lightboxZoom(0.3)" title="Zoom In" aria-label="Zoom in">
          <i class="bi bi-plus-lg"></i>
        </button>
        <button type="button" class="tft-lightbox-tool-btn ms-2" onclick="closeLightboxModal()" title="Close (Esc)" aria-label="Close modal">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    </div>

    <div class="tft-lightbox-stage-area" id="lightbox-stage-area">
      @if($galleryList->count() > 1)
        <button type="button" class="tft-lightbox-arrow tft-lightbox-arrow--prev" onclick="navigateGallery(-1)" aria-label="Previous image">
          <i class="bi bi-chevron-left"></i>
        </button>
        <button type="button" class="tft-lightbox-arrow tft-lightbox-arrow--next" onclick="navigateGallery(1)" aria-label="Next image">
          <i class="bi bi-chevron-right"></i>
        </button>
      @endif

      <div class="tft-lightbox-img-wrap" id="lightbox-img-wrap">
        <img id="lightbox-main-img" src="{{ $galleryList->first() }}" alt="{{ $product->title }}" class="tft-lightbox-img" draggable="false">
      </div>
    </div>

    @if($galleryList->count() > 1)
      <div class="tft-lightbox-bottom-tray">
        @foreach($galleryList as $tIdx => $tImg)
          <div class="tft-lightbox-tray-thumb {{ $tIdx === 0 ? 'active' : '' }}"
               data-index="{{ $tIdx }}"
               onclick="switchProductStageImage('{{ $tImg }}', {{ $tIdx }})">
            <img src="{{ $tImg }}" alt="Thumb {{ $tIdx + 1 }}">
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  window.TFT_CurrentProduct = {
    id: {{ $product->id }},
    title: @json($product->title),
    price: {{ (float)($product->price ?? 0) }},
    cbm: @json($product->cbm ?: '0.45'),
    image: @json($galleryList->first()),
    slug: @json($product->slug),
    wood: @json($productWood),
    finish: @json($productFinish),
    category: @json($product->category?->name ?? 'Furniture')
  };

  const galleryImages = @json($galleryList->values());
  let currentGalleryIndex = 0;
  let lightboxScale = 1;
  let isZoomed = false;
  let isHovering = false;
  let rafId = null;

  /* ==========================================================================
     MAGNIFIER ENGINE
     ========================================================================== */
  function setZoom(zoomed, originX = 50, originY = 50) {
    const stage = document.getElementById('tft-main-stage-container');
    const stageImg = document.getElementById('main-product-stage-img');
    const badgeText = document.getElementById('tft-zoom-status-text');
    const iconZoom = document.getElementById('icon-toggle-zoom');

    if (!stage || !stageImg) return;
    isZoomed = zoomed;

    if (isZoomed) {
      stage.classList.add('is-zooming');
      stageImg.style.transformOrigin = `${originX.toFixed(2)}% ${originY.toFixed(2)}%`;
      stageImg.style.transform = 'scale(2.5)';
      if (badgeText) badgeText.textContent = '2.5× Artisan Detail';
      if (iconZoom) iconZoom.className = 'bi bi-zoom-out';
    } else {
      stage.classList.remove('is-zooming');
      stageImg.style.transform = 'scale(1)';
      stageImg.style.transformOrigin = 'center center';
      if (badgeText) badgeText.textContent = 'Hover to Magnify';
      if (iconZoom) iconZoom.className = 'bi bi-zoom-in';
    }
  }

  window.toggleStageZoom = function(e) {
    if (e) e.stopPropagation();
    setZoom(!isZoomed, 50, 50);
  };

  (function initMagnifierEvents() {
    const stage = document.getElementById('tft-main-stage-container');
    const stageImg = document.getElementById('main-product-stage-img');
    const lens = document.getElementById('tft-magnify-lens');

    if (!stage || !stageImg) return;

    stage.addEventListener('mouseenter', (e) => {
      if (window.matchMedia('(pointer: coarse)').matches) return;
      isHovering = true;
      const rect = stage.getBoundingClientRect();
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;
      setZoom(true, x, y);
    });

    stage.addEventListener('mouseleave', () => {
      isHovering = false;
      setZoom(false);
      if (rafId) cancelAnimationFrame(rafId);
    });

    stage.addEventListener('mousemove', (e) => {
      if (!isHovering && !isZoomed) return;

      if (rafId) cancelAnimationFrame(rafId);
      rafId = requestAnimationFrame(() => {
        const rect = stage.getBoundingClientRect();
        const clientX = e.clientX - rect.left;
        const clientY = e.clientY - rect.top;

        if (lens) {
          lens.style.left = `${clientX}px`;
          lens.style.top = `${clientY}px`;
        }

        const percentX = Math.max(0, Math.min(100, (clientX / rect.width) * 100));
        const percentY = Math.max(0, Math.min(100, (clientY / rect.height) * 100));

        stageImg.style.transformOrigin = `${percentX.toFixed(2)}% ${percentY.toFixed(2)}%`;
      });
    });

    // Clicking anywhere on image opens lightbox
    stage.addEventListener('click', (e) => {
      if (e.target.closest('.tft-stage-action-btn, .tft-stage-nav-arrow, .tft-stage-cbm-badge, .tft-stage-sku-badge')) {
        return;
      }
      openLightboxModal();
    });
  })();

  /* ==========================================================================
     GALLERY SWITCHING & LIGHTBOX
     ========================================================================== */
  window.switchProductStageImage = function(url, index) {
    currentGalleryIndex = index !== undefined ? index : 0;
    const stageImg = document.getElementById('main-product-stage-img');
    const lightboxImg = document.getElementById('lightbox-main-img');

    if (stageImg) {
      stageImg.style.opacity = '0.2';
      setTimeout(() => {
        stageImg.src = url;
        stageImg.style.opacity = '1';
        if (isZoomed) {
          stageImg.style.transformOrigin = '50% 50%';
        }
      }, 120);
    }

    if (lightboxImg) {
      lightboxImg.src = url;
    }

    // Update active thumb classes
    document.querySelectorAll('.tft-ps-thumb').forEach((t, i) => {
      t.classList.toggle('active', i === currentGalleryIndex);
    });
    document.querySelectorAll('.tft-lightbox-tray-thumb').forEach((t, i) => {
      t.classList.toggle('active', i === currentGalleryIndex);
    });

    const counter = document.getElementById('lightbox-counter-label');
    if (counter) counter.textContent = `${currentGalleryIndex + 1} / ${galleryImages.length}`;

    if (window.TFT_CurrentProduct) {
      window.TFT_CurrentProduct.image = url;
    }
  };

  window.navigateGallery = function(delta) {
    if (!galleryImages || galleryImages.length === 0) return;
    let nextIdx = (currentGalleryIndex + delta + galleryImages.length) % galleryImages.length;
    window.switchProductStageImage(galleryImages[nextIdx], nextIdx);
  };

  window.openLightboxModal = function(e) {
    if (e) e.stopPropagation();
    const modal = document.getElementById('tft-product-lightbox');
    if (!modal) return;
    lightboxScale = 1;
    const imgWrap = document.getElementById('lightbox-img-wrap');
    if (imgWrap) imgWrap.style.transform = `scale(1)`;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  window.closeLightboxModal = function() {
    const modal = document.getElementById('tft-product-lightbox');
    if (!modal) return;
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  window.lightboxZoom = function(delta) {
    lightboxScale = Math.min(3.5, Math.max(0.6, lightboxScale + delta));
    const imgWrap = document.getElementById('lightbox-img-wrap');
    if (imgWrap) imgWrap.style.transform = `scale(${lightboxScale.toFixed(2)})`;
  };

  window.lightboxResetZoom = function() {
    lightboxScale = 1;
    const imgWrap = document.getElementById('lightbox-img-wrap');
    if (imgWrap) imgWrap.style.transform = `scale(1)`;
  };

  // Keyboard navigation for gallery & lightbox
  document.addEventListener('keydown', (e) => {
    const modal = document.getElementById('tft-product-lightbox');
    const isModalOpen = modal && modal.classList.contains('is-open');

    if (e.key === 'Escape' && isModalOpen) {
      closeLightboxModal();
    } else if (e.key === 'ArrowLeft') {
      navigateGallery(-1);
    } else if (e.key === 'ArrowRight') {
      navigateGallery(1);
    }
  });

  /* ==========================================================================
     FAQS ACCORDION (Vanilla JS)
     ========================================================================== */
  window.toggleFaqAccordion = function(btn) {
    const item = btn.closest('.tft-faq-item');
    if (!item) return;
    const answer = item.querySelector('.tft-faq-answer');
    if (!answer) return;

    const isOpen = answer.classList.contains('is-open');

    // Close all FAQs in this container
    const container = item.closest('.tft-faq-accordion');
    if (container) {
      container.querySelectorAll('.tft-faq-answer').forEach(a => a.classList.remove('is-open'));
      container.querySelectorAll('.tft-faq-question').forEach(q => q.classList.add('collapsed'));
    }

    if (!isOpen) {
      answer.classList.add('is-open');
      btn.classList.remove('collapsed');
    }
  };

  /* ==========================================================================
     RELATED PRODUCTS CAROUSEL SCROLLER
     ========================================================================== */
  window.scrollRelatedCarousel = function(direction) {
    const track = document.getElementById('related-carousel-track');
    if (!track) return;
    const card = track.querySelector('.tft-carousel-card');
    const cardWidth = card ? card.offsetWidth + 24 : 300;
    track.scrollBy({
      left: direction * cardWidth * 1.5,
      behavior: 'smooth'
    });
  };

  /* ==========================================================================
     ADD TO QUOTE (Qty defaults to 1, uses default wood & finish)
     ========================================================================== */
  window.submitProductToQuote = function(productId) {
    const productMetadata = {
      title: @json($product->title),
      price: {{ (float)($product->price ?? 0) }},
      cbm: @json($product->cbm ?: '0.45'),
      image: galleryImages[currentGalleryIndex] || @json($galleryList->first()),
      slug: @json($product->slug),
      wood: @json($productWood),
      finish: @json($productFinish)
    };

    if (window.FUR_Theme && typeof window.FUR_Theme.addToCart === 'function') {
      window.FUR_Theme.addToCart(productId, 1, productMetadata);
    } else {
      const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      fetch('/quote/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token || '',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          product_id: productId,
          id: productId,
          quantity: 1,
          ...productMetadata
        })
      }).then(res => res.json()).then(data => {
        if (data.success) {
          if (window.FUR_Theme) {
            window.FUR_Theme.state.cart = data.cart;
            window.FUR_Theme.persistCart();
            window.FUR_Theme.renderCart();
            window.FUR_Theme.openCart();
            window.FUR_Theme.showSuccessNotification(productMetadata.title);
          } else {
            const drawer = document.getElementById('fur-cart-drawer');
            if (drawer) {
              drawer.setAttribute('aria-hidden', 'false');
              drawer.classList.add('fur-cart-overlay--open');
            }
          }
        }
      }).catch(err => {
        console.warn("Quote add error:", err);
      });
    }
  };
</script>
@endpush
