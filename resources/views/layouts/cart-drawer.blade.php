<aside class="fur-cart-overlay" id="fur-cart-drawer" aria-hidden="true" aria-label="Furniture Quote Drawer">
  <div class="fur-cart-drawer">
    <div class="fur-cart-drawer__header" style="display: flex; justify-content: space-between; align-items: flex-start;">
      <div>
        <h3 style="margin: 0; font-family: var(--fur-font-serif, 'Playfair Display', serif); font-size: 1.25rem;">Quote Cart</h3>
        <p style="margin: 4px 0 0 0; font-size: 0.75rem; color: var(--fur-text-muted);">Selected for quotation &bull; No online payment required</p>
      </div>
      <button class="fur-cart-drawer__close" id="fur-cart-close" aria-label="Close Quote Cart">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Notification Bar for Instant Feedback -->
    <div id="fur-cart-alert" class="fur-cart-alert" style="display: none; padding: 10px 16px; margin: 12px 16px 0; background: color-mix(in srgb, var(--fur-primary, #3d5a1e) 12%, #ffffff); border: 1px solid color-mix(in srgb, var(--fur-primary, #3d5a1e) 30%, transparent); border-radius: 8px; font-size: 0.8125rem; color: var(--fur-primary, #3d5a1e); font-weight: 500; align-items: center; gap: 8px;" role="status">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      <span id="fur-cart-alert-text">Item added to Quote!</span>
    </div>

    <div class="fur-cart-drawer__items" id="fur-cart-items-container">
      <!-- Rendered dynamically -->
    </div>

    <div class="fur-cart-drawer__footer">
      <div class="fur-cart-drawer__summary">
        <span>Total Volume (Est.)</span>
        <span class="fur-cart-drawer__subtotal" id="fur-cart-subtotal" style="font-weight: 700; color: var(--fur-primary, #3d5a1e);">0.00 CBM</span>
      </div>
      <p style="font-size: 0.72rem; color: var(--fur-text-muted); margin: 0 0 12px 0; text-align: center; line-height: 1.4;">
        🔒 Direct workshop quote with custom dimensions and finishes will be provided.
      </p>
      <a href="{{ route('checkout') }}" class="fur-cart-drawer__checkout-btn"
        style="display:block; text-align:center; text-decoration:none;">Proceed to Request Quote &rarr;</a>
      <button class="fur-cart-drawer__clear-btn" id="fur-cart-clear">Clear Quote Selection</button>
    </div>
  </div>
</aside>
