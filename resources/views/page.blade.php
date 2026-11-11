@extends('layouts.app')

@section('title', ($page->meta_title ?: $page->title) . ' — ' . config('app.name', 'Bharat Art & Craft'))
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->excerpt ?: $page->description), 160))

@section('content')
  <h1 class="sr-only">{{ $page->title }} — Bharat Art &amp; Craft</h1>

  <!-- STICKY HEADER -->
  <header class="fur-header">
    <div class="fur-header__scrolled-brand">
      <button class="fur-header__scrolled-toggle" id="fur-scrolled-menu-toggle" aria-expanded="false" aria-label="Toggle Menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fur-icon">
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
  </header>

  <!-- PAGE HERO -->
  <section class="tft-post-hero" style="position: relative; min-height: 280px; display: flex; align-items: center; justify-content: center; background: var(--fur-bg-secondary, #faf7f2); padding: 80px 24px 60px; text-align: center;">
    <div class="tft-post-hero__content" style="max-width: 800px; margin: 0 auto;">
      <div class="tft-post-hero__breadcrumbs" style="font-size: 0.85rem; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 16px; color: var(--fur-text-muted, #766e65);">
        <a href="{{ route('home') }}" style="color: inherit; text-decoration: none;">Home</a>
        <span style="margin: 0 8px;">/</span>
        <span>{{ $page->title }}</span>
      </div>
      <h2 class="tft-post-hero__title" style="font-size: clamp(2rem, 4vw, 3rem); font-family: var(--fur-font-serif, serif); font-weight: 400; margin: 0 0 16px; color: var(--fur-text, #1a1714);">
        {{ $page->title }}
      </h2>
      <p class="tft-post-hero__desc" style="font-size: 1.05rem; line-height: 1.6; color: var(--fur-text-muted, #5f574f); margin: 0;">
        {{ $page->meta_description ?: 'Official publication & trade policies of Bharat Art & Craft' }}
      </p>
    </div>
  </section>

  <!-- MAIN CONTENT BODY -->
  <main class="tft-page-body" style="max-width: 900px; margin: 0 auto; padding: 60px 24px 100px;">
    <article class="tft-prose" style="font-size: 1.08rem; line-height: 1.85; color: var(--fur-text, #2c2724);">
      @if($page->image_url && !str_contains($page->image_url, 'placeholder'))
        <div style="margin-bottom: 40px; border-radius: 8px; overflow: hidden; max-height: 440px;">
          <img src="{{ $page->image_url }}" alt="{{ $page->title }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
      @endif

      @if($page->excerpt)
        <div class="tft-lead" style="font-size: 1.25rem; font-family: var(--fur-font-serif, serif); font-style: italic; line-height: 1.7; margin-bottom: 32px; padding: 24px; background: rgba(0,0,0,0.02); border-left: 3px solid var(--fur-primary, #9c6644); border-radius: 4px;">
          {!! nl2br(e($page->excerpt)) !!}
        </div>
      @endif

      @if($page->description)
        <div class="tft-page-content" style="margin-top: 24px;">
          {!! $page->description !!}
        </div>
      @endif
    </article>
  </main>
@endsection
