@extends('layouts.app')

@section('title', 'Send Furniture Enquiry — Bharat Art & Craft')
@section('meta_description', 'Submit your handcrafted furniture enquiry. Review your selected pieces and receive a bespoke quotation and craftsmanship timeline directly from our master artisans.')

@section('content')
<div style="background: var(--fur-bg-secondary, #faf7f2); padding: 40px 20px 80px; min-height: 85vh;">
  <div style="max-width: 1200px; margin: 0 auto;">
    
    <!-- HEADER -->
    <header style="margin-bottom: 32px; text-align: left;">
      <span style="display: inline-block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.12em; color: var(--fur-primary, #9a7b4f); margin-bottom: 6px;">
        Direct Atelier Quotation
      </span>
      <h1 style="font-family: var(--fur-font-serif, 'Playfair Display', serif); font-size: 2.1rem; font-weight: 600; color: var(--fur-text, #2b2823); margin: 0 0 6px 0; line-height: 1.2;">
        Send Furniture Enquiry
      </h1>
      <p style="font-size: 0.9rem; color: var(--fur-text-muted, #766e65); margin: 0;">
        Submit your selected pieces for quotation. No online payment required &mdash; our workshop export team will contact you with pricing and CBM shipping calculations.
      </p>
    </header>

    @if(session('success'))
      <div style="background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
        {{ session('success') }}
      </div>
    @endif

    <!-- TWO-COLUMN LAYOUT -->
    <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 32px; align-items: start;" class="chk-grid-layout">

      <!-- LEFT SIDE: ENQUIRY FORM WITH EXACTLY 9 FIELDS -->
      <div style="background: var(--fur-surface, #ffffff); border: 1px solid var(--fur-border, #e8e4dc); border-radius: 12px; padding: 32px 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 1px solid var(--fur-border, #e8e4dc);">
          <div>
            <h2 style="font-family: var(--fur-font-serif, 'Playfair Display', serif); font-size: 1.35rem; font-weight: 600; color: var(--fur-text, #2b2823); margin: 0 0 4px 0;">
              Enquiry &amp; Delivery Details
            </h2>
            <p style="font-size: 0.8rem; color: var(--fur-text-muted, #766e65); margin: 0;">
              Please provide your contact and location details for quotation dispatch.
            </p>
          </div>
          <span style="background: rgba(154, 123, 79, 0.12); color: var(--fur-primary, #9a7b4f); padding: 4px 10px; border-radius: 4px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">
            No Payment
          </span>
        </div>

        <form id="tft-checkout-form" action="{{ route('checkout.submit') }}" method="POST" novalidate style="display: flex; flex-direction: column; gap: 18px;">
          @csrf
          <input type="hidden" name="cart_items_summary" id="chk-cart-items-summary" value="">

          <!-- Row 1: Name & Email -->
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="chk-input-row">
            <!-- 1. Name -->
            <div>
              <label for="chk-name" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: block; margin-bottom: 6px;">
                1. Name <span style="color: #c94a29;">*</span>
              </label>
              <input type="text" id="chk-name" name="name" required placeholder="e.g. Rajesh Sharma" autocomplete="name" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
            </div>

            <!-- 2. Email -->
            <div>
              <label for="chk-email" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: block; margin-bottom: 6px;">
                2. Email <span style="color: #c94a29;">*</span>
              </label>
              <input type="email" id="chk-email" name="email" required placeholder="e.g. rajesh@example.com" autocomplete="email" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
            </div>
          </div>

          <!-- Row 2: Phone No. & Company Name -->
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="chk-input-row">
            <!-- 3. Phone No. (optional) -->
            <div>
              <label for="chk-phone" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>3. Phone No. <span style="font-weight: 400; color: var(--fur-text-muted, #766e65); text-transform: lowercase;">(optional)</span></span>
              </label>
              <input type="tel" id="chk-phone" name="phone" placeholder="e.g. +91 98765 43210" autocomplete="tel" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
            </div>

            <!-- 4. Company Name (optional) -->
            <div>
              <label for="chk-company" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: flex; justify-content: space-between; margin-bottom: 6px;">
                <span>4. Company Name <span style="font-weight: 400; color: var(--fur-text-muted, #766e65); text-transform: lowercase;">(optional)</span></span>
              </label>
              <input type="text" id="chk-company" name="company" placeholder="e.g. Heritage Designs Ltd." autocomplete="organization" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
            </div>
          </div>

          <!-- 5. Address -->
          <div>
            <label for="chk-address" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: block; margin-bottom: 6px;">
              5. Address <span style="color: #c94a29;">*</span>
            </label>
            <input type="text" id="chk-address" name="address" required placeholder="e.g. Flat 402, Royal Palms, Link Road" autocomplete="street-address" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
          </div>

          <!-- Row 3: City, State, Pincode -->
          <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;" class="chk-input-row-three">
            <!-- 6. City -->
            <div>
              <label for="chk-city" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: block; margin-bottom: 6px;">
                6. City <span style="color: #c94a29;">*</span>
              </label>
              <input type="text" id="chk-city" name="city" required placeholder="e.g. Mumbai" autocomplete="address-level2" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
            </div>

            <!-- 7. State -->
            <div>
              <label for="chk-state" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: block; margin-bottom: 6px;">
                7. State <span style="color: #c94a29;">*</span>
              </label>
              <input type="text" id="chk-state" name="state" required placeholder="e.g. Maharashtra" autocomplete="address-level1" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
            </div>

            <!-- 8. Pincode / Zipcode -->
            <div>
              <label for="chk-pincode" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: block; margin-bottom: 6px;">
                8. Pincode / Zipcode <span style="color: #c94a29;">*</span>
              </label>
              <input type="text" id="chk-pincode" name="pincode" required placeholder="e.g. 400050" autocomplete="postal-code" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
            </div>
          </div>

          <!-- 9. Country -->
          <div>
            <label for="chk-country" style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--fur-text, #2b2823); display: block; margin-bottom: 6px;">
              9. Country <span style="color: #c94a29;">*</span>
            </label>
            <input type="text" id="chk-country" name="country" required placeholder="e.g. India, United States, United Kingdom, UAE" value="India" autocomplete="country-name" style="width: 100%; padding: 11px 14px; font-size: 0.9rem; border: 1px solid var(--fur-border, #d8d0c5); border-radius: 6px; background: var(--fur-bg-secondary, #faf7f2); color: var(--fur-text, #2b2823);">
          </div>

          <!-- Error Alert -->
          <div id="chk-error-box" style="display: none; background: #fdf2f0; border: 1px solid #f5c2b7; color: #c94a29; padding: 12px 14px; border-radius: 6px; font-size: 0.84rem;"></div>

          <!-- Submit Button -->
          <div style="margin-top: 10px;">
            <button type="submit" id="chk-submit-btn" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 28px; background: var(--fur-primary, #9a7b4f); color: #ffffff; border: none; border-radius: 6px; font-size: 1.05rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
              </svg>
              <span id="chk-submit-btn-text">Send Furniture Enquiry (No Payment Required)</span>
            </button>
            <p style="text-align: center; font-size: 0.78rem; color: var(--fur-text-muted, #766e65); margin: 10px 0 0 0;">
              🔒 Direct workshop enquiry &bull; You will receive pricing and timeline within 24 hours
            </p>
          </div>

        </form>

      </div>

      <!-- RIGHT SIDE: KEEP PRODUCT DETAILS THAT ALREADY HAD ADDED IN CART -->
      <div style="position: sticky; top: 90px;">
        <div style="background: var(--fur-surface, #ffffff); border: 1px solid var(--fur-border, #e8e4dc); border-radius: 12px; padding: 26px 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
          
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid var(--fur-border, #e8e4dc);">
            <div>
              <h2 style="font-family: var(--fur-font-serif, 'Playfair Display', serif); font-size: 1.25rem; font-weight: 600; color: var(--fur-text, #2b2823); margin: 0 0 2px 0;">
                Selected Pieces In Cart
              </h2>
              <span id="chk-cart-count-badge" style="font-size: 0.78rem; color: var(--fur-text-muted, #766e65);">
                Items in your quote enquiry
              </span>
            </div>
            <a href="{{ route('shop') }}" style="font-size: 0.8rem; font-weight: 600; color: var(--fur-primary, #9a7b4f); text-decoration: none;">
              + Add pieces
            </a>
          </div>

          <!-- Cart Items Container -->
          <div id="chk-items-list" style="display: flex; flex-direction: column; gap: 14px; max-height: 420px; overflow-y: auto; padding-right: 4px; margin-bottom: 18px;">
            @php
              $serverCart = $cart ?? session()->get('quote_cart', []);
              $serverTotalItems = 0;
              $serverTotalCbm = 0;
            @endphp

            @if(!empty($serverCart) && count($serverCart) > 0)
              @foreach($serverCart as $item)
                @php
                  $itemQty = (int)($item['quantity'] ?? 1);
                  $itemCbm = (float)($item['cbm'] ?? 0.45) * $itemQty;
                  $serverTotalItems += $itemQty;
                  $serverTotalCbm += $itemCbm;
                  $itemImg = $item['image'] ?? asset('assets/img/fur_prod_vase.png');
                @endphp
                <div class="chk-item-card" style="display: flex; gap: 14px; padding: 12px; background: var(--fur-bg-secondary, #faf7f2); border-radius: 8px; border: 1px solid var(--fur-border, #ece7e0); align-items: center;">
                  <img src="{{ $itemImg }}" alt="{{ $item['title'] ?? 'Product' }}" style="width: 64px; height: 64px; object-fit: cover; border-radius: 6px; border: 1px solid var(--fur-border, #e8e4dc); flex-shrink: 0;" loading="lazy">
                  <div style="flex: 1; min-width: 0;">
                    <div style="font-size: 0.88rem; font-weight: 600; color: var(--fur-text, #2b2823); line-height: 1.3; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      {{ $item['title'] ?? 'Handcrafted Piece' }}
                    </div>
                    @if(!empty($item['code']))
                      <div style="font-size: 0.72rem; color: var(--fur-text-muted, #766e65);">Code: {{ $item['code'] }}</div>
                    @endif
                    @if(!empty($item['wood']) || !empty($item['finish']))
                      <div style="font-size: 0.72rem; color: var(--fur-text-muted, #766e65); margin-top: 1px;">
                        {{ $item['wood'] ?? '' }}{{ (!empty($item['wood']) && !empty($item['finish'])) ? ' &bull; ' : '' }}{{ $item['finish'] ?? '' }}
                      </div>
                    @endif
                  </div>
                  <div style="text-align: right; flex-shrink: 0;">
                    <span style="display: block; font-size: 0.8rem; font-weight: 700; color: var(--fur-primary, #9a7b4f);">
                      Qty: {{ $itemQty }}
                    </span>
                    <span style="font-size: 0.72rem; color: var(--fur-text-muted, #766e65);">
                      {{ round($itemCbm, 2) }} CBM
                    </span>
                  </div>
                </div>
              @endforeach
            @else
              <div id="chk-empty-placeholder" style="text-align: center; padding: 32px 14px; color: var(--fur-text-muted, #766e65);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" style="margin: 0 auto 10px; display: block; opacity: 0.5;">
                  <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                  <line x1="3" y1="6" x2="21" y2="6"></line>
                  <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <p style="font-size: 0.88rem; margin: 0 0 10px 0;">Your quote cart is empty.</p>
                <a href="{{ route('shop') }}" style="display: inline-block; font-size: 0.82rem; font-weight: 600; color: var(--fur-primary, #9a7b4f); text-decoration: underline;">
                  Browse Collections to add pieces &rarr;
                </a>
              </div>
            @endif
          </div>

          <!-- Total Summary -->
          <div style="border-top: 1px solid var(--fur-border, #e8e4dc); padding-top: 14px; display: flex; flex-direction: column; gap: 8px;">
            <div style="display: flex; justify-content: space-between; font-size: 0.84rem; color: var(--fur-text, #2b2823);">
              <span>Total Items:</span>
              <strong id="chk-summary-total-items">{{ $serverTotalItems }} pcs</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 0.84rem; color: var(--fur-text, #2b2823);">
              <span>Total Volume (CBM):</span>
              <strong id="chk-summary-total-cbm">{{ round($serverTotalCbm, 2) }} CBM</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 0.84rem; color: var(--fur-primary, #9a7b4f); font-weight: 600;">
              <span>Enquiry Status:</span>
              <span>Free / On Enquiry</span>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>
</div>

<style>
  @media (max-width: 900px) {
    .chk-grid-layout {
      grid-template-columns: 1fr !important;
    }
    .chk-input-row,
    .chk-input-row-three {
      grid-template-columns: 1fr !important;
    }
  }
</style>
@endsection

@section('modals')
<div class="tft-shop-modal-overlay" id="tft-checkout-success-modal" aria-hidden="true" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); backdrop-filter: blur(6px); z-index: 10000; align-items: center; justify-content: center;">
  <div style="max-width: 520px; width: 92%; background: #ffffff; border-radius: 14px; padding: 40px 32px; text-align: center; box-shadow: 0 25px 60px rgba(0,0,0,0.25);">
    
    <div style="width: 68px; height: 68px; margin: 0 auto 18px; background: rgba(154, 123, 79, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--fur-primary, #9a7b4f);">
      <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
      </svg>
    </div>

    <h2 style="font-family: var(--fur-font-serif, 'Playfair Display', serif); font-size: 1.75rem; font-weight: 600; color: var(--fur-text, #2b2823); margin: 0 0 10px 0;">
      Enquiry Sent Successfully!
    </h2>
    <p style="color: var(--fur-text-muted, #766e65); font-size: 0.9rem; line-height: 1.5; margin: 0 0 18px 0;">
      Thank you for submitting your enquiry. We have received your piece selection and delivery location. Our export manager will contact you with pricing and CBM shipping calculations within 24 hours.
    </p>

    <div style="background: var(--fur-bg-secondary, #faf7f2); border: 1px dashed var(--fur-border, #d8d0c5); padding: 12px 20px; border-radius: 8px; margin-bottom: 24px; display: inline-block;">
      <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--fur-text-muted, #766e65); display: block; margin-bottom: 4px;">Enquiry Reference</span>
      <span id="tft-success-order-id" style="font-family: monospace; font-size: 1.2rem; font-weight: 700; color: var(--fur-primary, #9a7b4f);">BAC-ENQ-10001</span>
    </div>

    <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
      <a href="{{ route('shop') }}" style="display: inline-block; padding: 12px 24px; background: var(--fur-primary, #9a7b4f); color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 0.9rem;">
        Browse More Pieces
      </a>
      <a href="{{ route('home') }}" style="display: inline-block; padding: 12px 22px; background: var(--fur-bg-secondary, #faf7f2); border: 1px solid var(--fur-border, #d8d0c5); color: var(--fur-text, #2b2823); text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 0.9rem;">
        Return to Home
      </a>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
  const form = document.getElementById('tft-checkout-form');
  const submitBtn = document.getElementById('chk-submit-btn');
  const submitBtnText = document.getElementById('chk-submit-btn-text');
  const errorBox = document.getElementById('chk-error-box');
  const successModal = document.getElementById('tft-checkout-success-modal');
  const orderIdEl = document.getElementById('tft-success-order-id');
  const itemsContainer = document.getElementById('chk-items-list');
  const totalItemsEl = document.getElementById('chk-summary-total-items');
  const totalCbmEl = document.getElementById('chk-summary-total-cbm');
  const summaryInput = document.getElementById('chk-cart-items-summary');

  // Sync with client-side localStorage / theme cart if present
  function syncClientCart() {
    let localItems = [];
    try {
      const stored = localStorage.getItem('fur_quote_cart') || localStorage.getItem('fur_theme_cart');
      if (stored) localItems = JSON.parse(stored);
    } catch (e) {}

    if ((!localItems || localItems.length === 0) && window.FUR_Theme && window.FUR_Theme.state && window.FUR_Theme.state.cart) {
      localItems = window.FUR_Theme.state.cart;
    }

    if (localItems && localItems.length > 0 && itemsContainer) {
      let html = '';
      let totalQty = 0;
      let totalCbm = 0;
      let summaryText = '';

      localItems.forEach((item, idx) => {
        const qty = parseInt(item.quantity, 10) || 1;
        const cbmVal = parseFloat(item.cbm) || 0.45;
        const lineCbm = cbmVal * qty;
        totalQty += qty;
        totalCbm += lineCbm;
        const img = item.image || item.thumb || '{{ asset("assets/img/fur_prod_vase.png") }}';
        const title = item.title || item.name || 'Furniture Piece';
        const code = item.code ? `Code: ${item.code}` : '';
        const meta = [item.wood, item.finish].filter(Boolean).join(' &bull; ');

        summaryText += `${idx + 1}. ${title} ${code ? '[' + code + ']' : ''} | Qty: ${qty} | CBM: ${lineCbm.toFixed(2)}\n`;

        html += `
          <div class="chk-item-card" style="display: flex; gap: 14px; padding: 12px; background: var(--fur-bg-secondary, #faf7f2); border-radius: 8px; border: 1px solid var(--fur-border, #ece7e0); align-items: center;">
            <img src="${img}" alt="${title}" style="width: 64px; height: 64px; object-fit: cover; border-radius: 6px; border: 1px solid var(--fur-border, #e8e4dc); flex-shrink: 0;" loading="lazy">
            <div style="flex: 1; min-width: 0;">
              <div style="font-size: 0.88rem; font-weight: 600; color: var(--fur-text, #2b2823); line-height: 1.3; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                ${title}
              </div>
              ${code ? `<div style="font-size: 0.72rem; color: var(--fur-text-muted, #766e65);">${code}</div>` : ''}
              ${meta ? `<div style="font-size: 0.72rem; color: var(--fur-text-muted, #766e65); margin-top: 1px;">${meta}</div>` : ''}
            </div>
            <div style="text-align: right; flex-shrink: 0;">
              <span style="display: block; font-size: 0.8rem; font-weight: 700; color: var(--fur-primary, #9a7b4f);">
                Qty: ${qty}
              </span>
              <span style="font-size: 0.72rem; color: var(--fur-text-muted, #766e65);">
                ${lineCbm.toFixed(2)} CBM
              </span>
            </div>
          </div>
        `;
      });

      itemsContainer.innerHTML = html;
      if (totalItemsEl) totalItemsEl.textContent = `${totalQty} pcs`;
      if (totalCbmEl) totalCbmEl.textContent = `${totalCbm.toFixed(2)} CBM`;
      if (summaryInput) summaryInput.value = summaryText;
    }
  }

  syncClientCart();

  // Handle Checkout submission
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const name = document.getElementById('chk-name')?.value.trim();
      const email = document.getElementById('chk-email')?.value.trim();
      const address = document.getElementById('chk-address')?.value.trim();
      const city = document.getElementById('chk-city')?.value.trim();
      const state = document.getElementById('chk-state')?.value.trim();
      const pincode = document.getElementById('chk-pincode')?.value.trim();
      const country = document.getElementById('chk-country')?.value.trim();

      if (!name || !email || !address || !city || !state || !pincode || !country) {
        if (errorBox) {
          errorBox.textContent = 'Please fill in all required fields (Name, Email, Address, City, State, Pincode, and Country).';
          errorBox.style.display = 'block';
        }
        return;
      }

      if (errorBox) errorBox.style.display = 'none';
      if (submitBtn) submitBtn.disabled = true;
      if (submitBtnText) submitBtnText.textContent = 'Submitting Enquiry...';

      const formData = new FormData(form);

      fetch(form.action || '{{ route("checkout.submit") }}', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) submitBtn.disabled = false;
        if (submitBtnText) submitBtnText.textContent = 'Send Furniture Enquiry (No Payment Required)';

        if (data.success) {
          // Clear cart in storage and theme
          try {
            localStorage.removeItem('fur_quote_cart');
            localStorage.removeItem('fur_theme_cart');
          } catch(err) {}

          if (window.FUR_Theme && window.FUR_Theme.state) {
            window.FUR_Theme.state.cart = [];
            if (typeof window.FUR_Theme.renderCart === 'function') window.FUR_Theme.renderCart();
          }

          if (orderIdEl) {
            orderIdEl.textContent = data.order_ref || ('BAC-ENQ-' + (data.order_id || Math.floor(10000 + Math.random() * 90000)));
          }

          if (successModal) {
            successModal.style.display = 'flex';
            successModal.setAttribute('aria-hidden', 'false');
          }
        } else {
          if (errorBox) {
            errorBox.textContent = data.message || 'Error submitting enquiry. Please check your details.';
            errorBox.style.display = 'block';
          }
        }
      })
      .catch(err => {
        console.error('Checkout error:', err);
        if (submitBtn) submitBtn.disabled = false;
        if (submitBtnText) submitBtnText.textContent = 'Send Furniture Enquiry (No Payment Required)';
        if (errorBox) {
          errorBox.textContent = 'An error occurred while sending your enquiry. Please try again.';
          errorBox.style.display = 'block';
        }
      });

    });
  }
})();
</script>
@endpush
