<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name', 'Bharat Art & Craft') . ' — Modern & Timeless Spaces')</title>
  <meta name="description" content="@yield('meta_description', 'Handcrafted bespoke furniture, timeless interior spaces, sustainable artisan design, and custom craft collections.')">
  
  <!-- Typography -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Icons & Core Stylesheet -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @stack('styles')
</head>
<body class="@yield('body_class', 'fur-body tft-redesign-layout')">
  <div class="fur-app-layout @yield('layout_class', '')">
    @include('layouts.header')
    @include('layouts.mobile-drawer')

    @yield('sidebar')

    <main class="fur-main" id="fur-main-content">
      @yield('content')
      @include('layouts.footer')
    </main>
  </div>

  @include('layouts.cart-drawer')
  @include('layouts.product-modal')
  @include('layouts.consultation-modal')

  @yield('modals')

  <!-- Dynamic Storefront Data from Database -->
  <script>
    @if(isset($frontendProducts) && count($frontendProducts) > 0)
      window.TFT_Products = {!! json_encode($frontendProducts) !!};
    @endif
    @if(isset($promoSlides) && count($promoSlides) > 0)
      window.TFT_PromoSlides = {!! json_encode($promoSlides) !!};
    @endif
    window.BAC_Site = {
      title: "{{ $site->title ?? 'Bharat Art & Craft' }}",
      phone: "{{ $site->phone ?? '+91-9876543210' }}",
      whatsapp: "{{ $site->whatsapp ?? '+919876543210' }}",
      email: "{{ $site->email ?? 'info@bharatartandcraft.com' }}"
    };
  </script>

  <!-- Core Javascript -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @yield('scripts')
  @stack('scripts')
</body>
</html>
