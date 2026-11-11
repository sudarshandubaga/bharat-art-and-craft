<div class="fur-modal-overlay" id="fur-consultation-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="fur-consultation-title">
  
  <div class="fur-custom-modal">
    
    <!-- Close Button -->
    <button class="fur-custom-modal__close" id="fur-consultation-close" aria-label="Close modal" type="button">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>

    <!-- Modal Content -->
    <div class="fur-custom-modal__body">
      
      <!-- Header -->
      <div class="fur-custom-modal__header">
        <div class="fur-custom-modal__eyebrow">
          <span class="fur-custom-modal__eyebrow-dot"></span>
          <span>Bespoke Solid Woodcraft Atelier</span>
        </div>
        <h3 class="fur-custom-modal__title" id="fur-consultation-title">Customized Furniture Enquiry</h3>
        <p class="fur-custom-modal__desc">
          Share your sketch, photo, or target dimensions. Our master woodcrafters will review your specifications and provide a detailed quotation.
        </p>
      </div>

      <!-- FORM WITH EXACTLY 6 FIELDS IN A BEAUTIFULLY BALANCED GRID -->
      <form id="fur-consultation-form" class="fur-custom-form" action="{{ route('consultation.submit') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- Row 1: Name & Email -->
        <div class="fur-custom-form__grid">
          
          <!-- 1. Name -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="consult-name">
              Full Name <span class="fur-custom-form__req">*</span>
            </label>
            <div class="fur-custom-form__input-wrap">
              <svg class="fur-custom-form__input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <input type="text" id="consult-name" name="name" class="fur-custom-form__input" required placeholder="e.g. Ramesh Patel" autocomplete="name">
            </div>
          </div>

          <!-- 2. Email -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="consult-email">
              Email Address <span class="fur-custom-form__req">*</span>
            </label>
            <div class="fur-custom-form__input-wrap">
              <svg class="fur-custom-form__input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              <input type="email" id="consult-email" name="email" class="fur-custom-form__input" required placeholder="e.g. ramesh@example.com" autocomplete="email">
            </div>
          </div>

        </div>

        <!-- Row 2: Phone No. & Dimension -->
        <div class="fur-custom-form__grid">
          
          <!-- 3. Phone No. (optional) -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="consult-phone">
              <span>Phone / WhatsApp</span>
              <span class="fur-custom-form__opt">Optional</span>
            </label>
            <div class="fur-custom-form__input-wrap">
              <svg class="fur-custom-form__input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <input type="tel" id="consult-phone" name="phone" class="fur-custom-form__input" placeholder="e.g. +91 98765 43210" autocomplete="tel">
            </div>
          </div>

          <!-- 4. Dimension -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="consult-dimension">
              <span>Dimensions</span>
              <span class="fur-custom-form__hint">L &times; W &times; H</span>
            </label>
            <div class="fur-custom-form__input-wrap">
              <svg class="fur-custom-form__input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21.3 8.7 8.7 21.3c-1 1-2.5 1-3.4 0l-2.6-2.6c-1-1-1-2.5 0-3.4L15.3 2.7c1-1 2.5-1 3.4 0l2.6 2.6c1 1 1 2.5 0 3.4Z"></path>
                <path d="m14.5 3.5 2 2"></path>
                <path d="m11.5 6.5 2 2"></path>
                <path d="m8.5 9.5 2 2"></path>
                <path d="m5.5 12.5 2 2"></path>
              </svg>
              <input type="text" id="consult-dimension" name="dimension" class="fur-custom-form__input" placeholder="e.g. 72&quot;L &times; 36&quot;W &times; 30&quot;H">
            </div>
          </div>

        </div>

        <!-- 5. Upload Design (image with resize & webp) -->
        <div class="fur-custom-form__field">
          <div class="fur-custom-form__label-bar">
            <label class="fur-custom-form__label" for="consult-design-file">
              Upload Design / Blueprint / Photo
            </label>
            <span class="fur-custom-badge">Auto-Resize &bull; WebP 85%</span>
          </div>

          <!-- Dropzone Container -->
          <div id="consult-dropzone" class="fur-dropzone">
            <input type="file" id="consult-design-file" class="fur-dropzone__input" accept="image/*">
            <input type="hidden" id="consult-design-base64" name="design_image_base64" value="">

            <!-- Default Prompt State -->
            <div id="consult-dropzone-prompt" class="fur-dropzone__prompt">
              <div class="fur-dropzone__icon-circle">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="17 8 12 3 7 8"></polyline>
                  <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
              </div>
              <div class="fur-dropzone__text">
                <span class="fur-dropzone__action">Click to upload</span> or drag and drop your design
              </div>
              <div class="fur-dropzone__subtext">
                PNG, JPG, WEBP &bull; Automatically converted to optimized WebP
              </div>
            </div>

            <!-- Live Converted Preview State -->
            <div id="consult-dropzone-preview" class="fur-dropzone__preview" style="display: none;">
              <div class="fur-dropzone__thumb-wrap">
                <img id="consult-preview-img" class="fur-dropzone__thumb" src="" alt="Custom design preview">
              </div>
              <div class="fur-dropzone__meta">
                <div id="consult-preview-name" class="fur-dropzone__filename"></div>
                <div class="fur-dropzone__stats">
                  <span id="consult-preview-meta" class="fur-dropzone__dims"></span>
                  <span class="fur-dropzone__pill">&check; WebP Ready</span>
                </div>
              </div>
              <button type="button" id="consult-preview-remove" class="fur-dropzone__remove-btn" title="Remove design">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="3 6 5 6 21 6"></polyline>
                  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                </svg>
                <span>Remove</span>
              </button>
            </div>

          </div>
        </div>

        <!-- 6. Specification -->
        <div class="fur-custom-form__field">
          <label class="fur-custom-form__label" for="consult-specification">
            Custom Specifications &amp; Notes
          </label>
          <textarea id="consult-specification" name="specification" class="fur-custom-form__textarea" rows="3" placeholder="Specify wood species (Teak, Sheesham, Oak), polish tone, joinery details, fabric, or specific design notes..."></textarea>
        </div>

        <!-- Error Message Alert -->
        <div id="fur-consultation-error" class="fur-custom-alert" style="display: none;"></div>

        <!-- Submit Button Section -->
        <div class="fur-custom-form__submit-wrap">
          <button type="submit" id="fur-consultation-submit-btn" class="fur-custom-submit-btn">
            <span id="fur-consultation-btn-text">Submit Customized Enquiry</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </button>
          
          <!-- Trust micro-badges -->
          <div class="fur-custom-trust-row">
            <span class="fur-custom-trust-item">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
              100% Solid Wood
            </span>
            <span class="fur-custom-trust-item">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              24-Hr Quotation
            </span>
            <span class="fur-custom-trust-item">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
              No Advance Payment
            </span>
          </div>
        </div>

      </form>

      <!-- SUCCESS CONFIRMATION STATE -->
      <div id="fur-consultation-success" class="fur-custom-success" style="display: none;">
        <div class="fur-custom-success__icon-wrap">
          <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
        </div>
        <h4 class="fur-custom-success__title">Customized Enquiry Received!</h4>
        <p class="fur-custom-success__desc">
          Thank you for choosing <strong>Bharat Art &amp; Craft</strong>. Our master craftsmen will evaluate your design, dimensions, and specifications. We will send you a detailed timber proposal and 3D outline within 24 hours.
        </p>
        <div class="fur-custom-success__ref-card">
          <span class="fur-custom-success__ref-label">Enquiry Reference ID</span>
          <span id="fur-consultation-ref-id" class="fur-custom-success__ref-num">BAC-CUST-10001</span>
        </div>
        <div class="fur-custom-success__action">
          <button type="button" id="fur-consultation-done-btn" class="fur-custom-submit-btn" style="max-width: 200px; margin: 0 auto;">
            Done
          </button>
        </div>
      </div>

    </div>

  </div>
</div>

<style>
  /* ==========================================================================
     PREMIUM BESPOKE CONSULTATION POPUP MODAL STYLES
     ========================================================================== */
  #fur-consultation-modal.fur-modal-overlay {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(18, 15, 12, 0.65);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 16px;
    box-sizing: border-box;
    opacity: 0;
    transition: opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }

  #fur-consultation-modal.fur-modal-overlay.fur-modal-overlay--open {
    display: flex;
    opacity: 1;
  }

  .fur-custom-modal {
    position: relative;
    max-width: 660px;
    width: 100%;
    max-height: calc(100vh - 32px);
    overflow-y: auto;
    background: #ffffff;
    border: 1px solid rgba(197, 168, 128, 0.35);
    border-radius: 16px;
    box-shadow: 0 28px 75px rgba(18, 15, 12, 0.32), 0 0 1px rgba(0, 0, 0, 0.15);
    box-sizing: border-box;
    transform: scale(0.97) translateY(8px);
    transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }

  #fur-consultation-modal.fur-modal-overlay--open .fur-custom-modal {
    transform: scale(1) translateY(0);
  }

  /* Custom subtle scrollbar */
  .fur-custom-modal::-webkit-scrollbar {
    width: 6px;
  }
  .fur-custom-modal::-webkit-scrollbar-thumb {
    background: #d8cfc4;
    border-radius: 4px;
  }

  /* Close Button */
  .fur-custom-modal__close {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f6f3ee;
    border: 1px solid #e8e1d7;
    color: #635b51;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    z-index: 10;
  }
  .fur-custom-modal__close:hover {
    background: #e9e2d6;
    color: #1e1b18;
    transform: rotate(90deg);
  }

  .fur-custom-modal__body {
    padding: 36px 36px 32px;
  }

  /* Header */
  .fur-custom-modal__header {
    text-align: center;
    margin-bottom: 24px;
    padding-bottom: 18px;
    border-bottom: 1px solid #f0eae1;
  }

  .fur-custom-modal__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 4px 12px;
    background: rgba(154, 123, 79, 0.09);
    border: 1px solid rgba(154, 123, 79, 0.22);
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #9a7b4f;
    margin-bottom: 10px;
  }

  .fur-custom-modal__eyebrow-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #9a7b4f;
    display: inline-block;
  }

  .fur-custom-modal__title {
    font-family: var(--fur-font-serif, 'Playfair Display', Georgia, serif);
    font-size: 1.85rem;
    font-weight: 600;
    color: #24201c;
    margin: 0 0 8px 0;
    line-height: 1.25;
    letter-spacing: -0.01em;
  }

  .fur-custom-modal__desc {
    font-size: 0.88rem;
    line-height: 1.55;
    color: #70685e;
    margin: 0 auto;
    max-width: 520px;
  }

  /* Form */
  .fur-custom-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .fur-custom-form__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .fur-custom-form__field {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .fur-custom-form__label-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .fur-custom-form__label {
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #38322b;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .fur-custom-form__req {
    color: #c94a29;
    font-weight: 700;
    margin-left: 2px;
  }

  .fur-custom-form__opt {
    font-size: 0.7rem;
    font-weight: 500;
    text-transform: lowercase;
    color: #8c8378;
    background: #f4efe8;
    padding: 1px 7px;
    border-radius: 4px;
  }

  .fur-custom-form__hint {
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: none;
    color: #8c8378;
  }

  .fur-custom-badge {
    font-size: 0.7rem;
    font-weight: 600;
    color: #9a7b4f;
    background: rgba(154, 123, 79, 0.1);
    border: 1px solid rgba(154, 123, 79, 0.2);
    padding: 2px 8px;
    border-radius: 4px;
    letter-spacing: 0.02em;
  }

  /* Inputs */
  .fur-custom-form__input-wrap {
    position: relative;
    display: flex;
    align-items: center;
  }

  .fur-custom-form__input-icon {
    position: absolute;
    left: 14px;
    color: #999084;
    pointer-events: none;
    transition: color 0.2s ease;
  }

  .fur-custom-form__input {
    width: 100%;
    padding: 12px 14px 12px 40px;
    font-size: 0.9rem;
    font-family: inherit;
    border: 1.5px solid #ded6ca;
    border-radius: 8px;
    background: #faf7f2;
    color: #24201c;
    box-sizing: border-box;
    transition: all 0.2s ease;
    outline: none;
  }

  .fur-custom-form__input:focus {
    border-color: #9a7b4f;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(154, 123, 79, 0.15);
  }

  .fur-custom-form__input-wrap:focus-within .fur-custom-form__input-icon {
    color: #9a7b4f;
  }

  .fur-custom-form__textarea {
    width: 100%;
    padding: 12px 14px;
    font-size: 0.9rem;
    font-family: inherit;
    border: 1.5px solid #ded6ca;
    border-radius: 8px;
    background: #faf7f2;
    color: #24201c;
    box-sizing: border-box;
    line-height: 1.5;
    resize: vertical;
    transition: all 0.2s ease;
    outline: none;
  }

  .fur-custom-form__textarea:focus {
    border-color: #9a7b4f;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(154, 123, 79, 0.15);
  }

  /* Dropzone */
  .fur-dropzone {
    position: relative;
    border: 2px dashed #d5cbbe;
    border-radius: 10px;
    background: #faf7f3;
    padding: 18px 16px;
    text-align: center;
    cursor: pointer;
    transition: all 0.25s ease;
  }

  .fur-dropzone:hover {
    border-color: #9a7b4f;
    background: rgba(154, 123, 79, 0.04);
  }

  .fur-dropzone--dragover {
    border-color: #9a7b4f !important;
    background: rgba(154, 123, 79, 0.09) !important;
    box-shadow: 0 0 0 4px rgba(154, 123, 79, 0.12);
  }

  .fur-dropzone__input {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 5;
  }

  .fur-dropzone__prompt {
    pointer-events: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
  }

  .fur-dropzone__icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #eee8de;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9a7b4f;
    margin-bottom: 4px;
    transition: transform 0.2s ease;
  }

  .fur-dropzone:hover .fur-dropzone__icon-circle {
    transform: translateY(-2px);
    background: rgba(154, 123, 79, 0.15);
  }

  .fur-dropzone__text {
    font-size: 0.88rem;
    font-weight: 600;
    color: #38322b;
  }

  .fur-dropzone__action {
    color: #9a7b4f;
    text-decoration: underline;
    font-weight: 700;
  }

  .fur-dropzone__subtext {
    font-size: 0.75rem;
    color: #82786d;
  }

  /* Dropzone Preview Card */
  .fur-dropzone__preview {
    display: flex;
    align-items: center;
    gap: 14px;
    text-align: left;
    background: #ffffff;
    border: 1px solid #e2dacd;
    border-radius: 8px;
    padding: 10px 14px;
  }

  .fur-dropzone__thumb-wrap {
    width: 58px;
    height: 58px;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #ded6ca;
    flex-shrink: 0;
    background: #f6f3ee;
  }

  .fur-dropzone__thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .fur-dropzone__meta {
    flex: 1;
    min-width: 0;
  }

  .fur-dropzone__filename {
    font-size: 0.85rem;
    font-weight: 600;
    color: #24201c;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .fur-dropzone__stats {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 4px;
    flex-wrap: wrap;
  }

  .fur-dropzone__dims {
    font-size: 0.74rem;
    color: #7d7367;
  }

  .fur-dropzone__pill {
    display: inline-flex;
    align-items: center;
    font-size: 0.68rem;
    font-weight: 700;
    color: #1b6329;
    background: #e8f5e9;
    padding: 1px 7px;
    border-radius: 3px;
    border: 1px solid #c8e6c9;
  }

  .fur-dropzone__remove-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fdf2f0;
    border: 1px solid #f6cfc7;
    color: #b7381d;
    cursor: pointer;
    padding: 7px 11px;
    border-radius: 6px;
    font-size: 0.78rem;
    font-weight: 600;
    transition: all 0.15s ease;
    flex-shrink: 0;
    z-index: 10;
  }

  .fur-dropzone__remove-btn:hover {
    background: #b7381d;
    color: #ffffff;
    border-color: #b7381d;
  }

  /* Alerts */
  .fur-custom-alert {
    background: #fdf2f0;
    border: 1px solid #f6cfc7;
    color: #b7381d;
    padding: 11px 14px;
    border-radius: 8px;
    font-size: 0.84rem;
    line-height: 1.4;
  }

  /* Submit CTA */
  .fur-custom-form__submit-wrap {
    margin-top: 6px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .fur-custom-submit-btn {
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 28px;
    background: #9a7b4f;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 0.98rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 14px rgba(154, 123, 79, 0.28);
  }

  .fur-custom-submit-btn:hover {
    background: #84683f;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(154, 123, 79, 0.35);
  }

  .fur-custom-submit-btn:active {
    transform: translateY(0);
  }

  .fur-custom-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
  }

  .fur-custom-trust-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 18px;
    flex-wrap: wrap;
    padding-top: 2px;
  }

  .fur-custom-trust-item {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.75rem;
    color: #7d7367;
    font-weight: 500;
  }

  .fur-custom-trust-item svg {
    color: #9a7b4f;
  }

  /* Success State */
  .fur-custom-success {
    text-align: center;
    padding: 24px 12px 12px;
  }

  .fur-custom-success__icon-wrap {
    width: 68px;
    height: 68px;
    margin: 0 auto 18px;
    background: #f6eedf;
    border: 2px solid rgba(154, 123, 79, 0.25);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9a7b4f;
  }

  .fur-custom-success__title {
    font-family: var(--fur-font-serif, 'Playfair Display', Georgia, serif);
    font-size: 1.7rem;
    font-weight: 600;
    color: #24201c;
    margin: 0 0 10px 0;
  }

  .fur-custom-success__desc {
    color: #6c6358;
    font-size: 0.92rem;
    line-height: 1.6;
    margin: 0 auto 20px;
    max-width: 480px;
  }

  .fur-custom-success__ref-card {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 3px;
    padding: 12px 24px;
    background: #faf7f2;
    border: 1px dashed #cfc5b6;
    border-radius: 8px;
    margin-bottom: 24px;
  }

  .fur-custom-success__ref-label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #857a6e;
    font-weight: 600;
  }

  .fur-custom-success__ref-num {
    font-family: monospace;
    font-size: 1.25rem;
    font-weight: 700;
    color: #9a7b4f;
    letter-spacing: 0.05em;
  }

  /* Responsive Mobile Tweaks */
  @media (max-width: 600px) {
    .fur-custom-modal__body {
      padding: 28px 20px 24px;
    }
    .fur-custom-form__grid {
      grid-template-columns: 1fr;
      gap: 14px;
    }
    .fur-custom-modal__title {
      font-size: 1.5rem;
    }
    .fur-custom-trust-row {
      gap: 12px;
    }
  }
</style>

<script>
(function() {
  const modal = document.getElementById('fur-consultation-modal');
  const closeBtn = document.getElementById('fur-consultation-close');
  const doneBtn = document.getElementById('fur-consultation-done-btn');
  const form = document.getElementById('fur-consultation-form');
  const successBlock = document.getElementById('fur-consultation-success');
  const errorBlock = document.getElementById('fur-consultation-error');
  const fileInput = document.getElementById('consult-design-file');
  const base64Input = document.getElementById('consult-design-base64');
  const dropzone = document.getElementById('consult-dropzone');
  const dropPrompt = document.getElementById('consult-dropzone-prompt');
  const dropPreview = document.getElementById('consult-dropzone-preview');
  const previewImg = document.getElementById('consult-preview-img');
  const previewName = document.getElementById('consult-preview-name');
  const previewMeta = document.getElementById('consult-preview-meta');
  const removeBtn = document.getElementById('consult-preview-remove');
  const submitBtn = document.getElementById('fur-consultation-submit-btn');
  const submitBtnText = document.getElementById('fur-consultation-btn-text');

  if (!modal) return;

  // Global Open Modal
  window.openCustomEnquiryModal = function() {
    modal.classList.add('fur-modal-overlay--open');
    modal.style.display = 'flex';
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    if (form) form.style.display = 'flex';
    if (successBlock) successBlock.style.display = 'none';
    if (errorBlock) errorBlock.style.display = 'none';
  };

  // Global Close Modal
  window.closeCustomEnquiryModal = function() {
    modal.classList.remove('fur-modal-overlay--open');
    setTimeout(() => {
      if (!modal.classList.contains('fur-modal-overlay--open')) {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      }
    }, 200);
  };

  if (closeBtn) closeBtn.addEventListener('click', window.closeCustomEnquiryModal);
  if (doneBtn) doneBtn.addEventListener('click', window.closeCustomEnquiryModal);

  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      window.closeCustomEnquiryModal();
    }
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('fur-modal-overlay--open')) {
      window.closeCustomEnquiryModal();
    }
  });

  // Intercept all Customized Enquiry links / buttons across the entire page
  document.addEventListener('click', function(e) {
    const link = e.target.closest('a, button');
    if (!link) return;

    // Skip clicks inside the modal itself
    if (link.closest('#fur-consultation-modal')) return;

    const href = link.getAttribute('href') || '';
    const text = (link.textContent || '').trim().toLowerCase();
    const hasDataAttr = link.hasAttribute('data-open-custom-enquiry') || link.getAttribute('data-tft-click') === 'contact-open-consultation';

    if (
      hasDataAttr ||
      href === '#consultation' ||
      href.includes('/consultation') ||
      text === 'customized enquiry' ||
      text.includes('customized enquiry')
    ) {
      e.preventDefault();
      window.openCustomEnquiryModal();
    }
  });

  // Client-side image resize & WebP conversion via Canvas
  function processImageToWebP(file) {
    if (!file || !file.type.startsWith('image/')) {
      alert('Please upload an image file (JPG, PNG, WEBP).');
      return;
    }

    const reader = new FileReader();
    reader.onload = function(evt) {
      const img = new Image();
      img.onload = function() {
        const MAX_DIM = 1200;
        let width = img.width;
        let height = img.height;

        if (width > MAX_DIM || height > MAX_DIM) {
          if (width > height) {
            height = Math.round((height * MAX_DIM) / width);
            width = MAX_DIM;
          } else {
            width = Math.round((width * MAX_DIM) / height);
            height = MAX_DIM;
          }
        }

        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext('2d');
        ctx.imageSmoothingEnabled = true;
        ctx.imageSmoothingQuality = 'high';
        ctx.drawImage(img, 0, 0, width, height);

        // Convert to WebP format with quality 0.85
        let webpDataUrl = canvas.toDataURL('image/webp', 0.85);

        // Fallback to JPEG if browser doesn't export WebP
        if (!webpDataUrl.startsWith('data:image/webp')) {
          webpDataUrl = canvas.toDataURL('image/jpeg', 0.85);
        }

        // Calculate size in KB
        const base64Length = webpDataUrl.length - (webpDataUrl.indexOf(',') + 1);
        const sizeInKb = Math.round((base64Length * 3) / 4 / 1024);
        const origSizeInKb = Math.round(file.size / 1024);

        if (base64Input) base64Input.value = webpDataUrl;
        if (previewImg) previewImg.src = webpDataUrl;
        if (previewName) previewName.textContent = file.name;
        if (previewMeta) previewMeta.textContent = `${width} &times; ${height} px &bull; ${sizeInKb} KB (from ${origSizeInKb} KB)`;

        if (dropPrompt) dropPrompt.style.display = 'none';
        if (dropPreview) dropPreview.style.display = 'flex';
      };
      img.src = evt.target.result;
    };
    reader.readAsDataURL(file);
  }

  function clearImage() {
    if (fileInput) fileInput.value = '';
    if (base64Input) base64Input.value = '';
    if (previewImg) previewImg.src = '';
    if (dropPreview) dropPreview.style.display = 'none';
    if (dropPrompt) dropPrompt.style.display = 'flex';
  }

  if (fileInput) {
    fileInput.addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        processImageToWebP(e.target.files[0]);
      }
    });
  }

  if (removeBtn) {
    removeBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      clearImage();
    });
  }

  // Drag & drop styling
  if (dropzone) {
    ['dragenter', 'dragover'].forEach(eventName => {
      dropzone.addEventListener(eventName, function(e) {
        e.preventDefault();
        dropzone.classList.add('fur-dropzone--dragover');
      });
    });
    ['dragleave', 'drop'].forEach(eventName => {
      dropzone.addEventListener(eventName, function(e) {
        e.preventDefault();
        dropzone.classList.remove('fur-dropzone--dragover');
      });
    });
    dropzone.addEventListener('drop', function(e) {
      if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0]) {
        processImageToWebP(e.dataTransfer.files[0]);
      }
    });
  }

  // Form submit handler via AJAX
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const name = document.getElementById('consult-name')?.value.trim();
      const email = document.getElementById('consult-email')?.value.trim();

      if (!name || !email) {
        if (errorBlock) {
          errorBlock.textContent = 'Please fill in both your Name and Email address.';
          errorBlock.style.display = 'block';
        }
        return;
      }

      if (errorBlock) errorBlock.style.display = 'none';
      if (submitBtn) submitBtn.disabled = true;
      if (submitBtnText) submitBtnText.textContent = 'Submitting...';

      const formData = new FormData(form);

      fetch(form.action || '{{ route("consultation.submit") }}', {
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
        if (submitBtnText) submitBtnText.textContent = 'Submit Customized Enquiry';

        if (data.success) {
          form.reset();
          clearImage();
          form.style.display = 'none';

          const refEl = document.getElementById('fur-consultation-ref-id');
          if (refEl) {
            refEl.textContent = data.order_ref || ('BAC-CUST-' + (data.order_id || Math.floor(10000 + Math.random() * 90000)));
          }

          if (successBlock) successBlock.style.display = 'block';
        } else {
          if (errorBlock) {
            errorBlock.textContent = data.message || 'Something went wrong. Please check your fields and try again.';
            errorBlock.style.display = 'block';
          }
        }
      })
      .catch(err => {
        console.error('Consultation submission error:', err);
        if (submitBtn) submitBtn.disabled = false;
        if (submitBtnText) submitBtnText.textContent = 'Submit Customized Enquiry';
        if (errorBlock) {
          errorBlock.textContent = 'An error occurred while sending your enquiry. Please check your connection and try again.';
          errorBlock.style.display = 'block';
        }
      });

    });
  }

})();
</script>
