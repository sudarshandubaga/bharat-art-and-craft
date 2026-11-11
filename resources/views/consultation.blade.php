@extends('layouts.app')

@section('title', 'Customized Furniture Enquiry — Bharat Art & Craft')
@section('meta_description', 'Submit your custom furniture design, drawing, or dimensions. Handcrafted in pure solid wood by our master artisans.')

@section('content')
  <div style="background: var(--fur-bg-secondary, #faf7f2); padding: 50px 20px 80px; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 680px; width: 100%; background: #ffffff; border: 1px solid rgba(197, 168, 128, 0.35); border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.06); padding: 40px 36px;">
      
      <header style="margin-bottom: 26px; text-align: center; border-bottom: 1px solid #f0eae1; padding-bottom: 20px;">
        <div style="display: inline-flex; align-items: center; gap: 7px; padding: 4px 12px; background: rgba(154, 123, 79, 0.09); border: 1px solid rgba(154, 123, 79, 0.22); border-radius: 50px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: #9a7b4f; margin-bottom: 10px;">
          <span style="width: 6px; height: 6px; border-radius: 50%; background: #9a7b4f; display: inline-block;"></span>
          <span>Bespoke Solid Woodcraft Atelier</span>
        </div>
        <h1 style="font-family: var(--fur-font-serif, 'Playfair Display', Georgia, serif); font-size: 2rem; font-weight: 600; color: #24201c; margin: 0 0 10px 0; line-height: 1.25;">
          Customized Furniture Enquiry
        </h1>
        <p style="font-size: 0.9rem; line-height: 1.55; color: #70685e; margin: 0 auto; max-width: 500px;">
          Share your sketch, photo, or target dimensions. Our master woodcrafters will review your specifications and provide a detailed quotation.
        </p>
      </header>

      @if(session('success'))
        <div style="background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; padding: 14px 18px; border-radius: 8px; margin-bottom: 24px; font-weight: 600; text-align: center;">
          {{ session('success') }}
        </div>
      @endif

      <!-- Button to open popup modal -->
      <div style="text-align: center; margin-bottom: 24px;">
        <button type="button" onclick="window.openCustomEnquiryModal && window.openCustomEnquiryModal()" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: #9a7b4f; color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 14px rgba(154, 123, 79, 0.25);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 20h9"></path>
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
          </svg>
          <span>Open In Popup Modal</span>
        </button>
      </div>

      <div style="position: relative; text-align: center; margin: 24px 0 28px;">
        <span style="background: #ffffff; padding: 0 14px; position: relative; z-index: 1; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.1em; color: #8c8378; font-weight: 600;">
          or submit on this page
        </span>
        <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e8e4dc; z-index: 0;"></div>
      </div>

      <!-- PAGE-LEVEL 6-FIELD FORM (ELEGANT 2-COLUMN GRID) -->
      <form action="{{ route('consultation.submit') }}" method="POST" enctype="multipart/form-data" id="consultation-page-form" class="fur-custom-form">
        @csrf

        <!-- Row 1: Name & Email -->
        <div class="fur-custom-form__grid">
          <!-- 1. Name -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="page-consult-name">
              Full Name <span class="fur-custom-form__req">*</span>
            </label>
            <div class="fur-custom-form__input-wrap">
              <svg class="fur-custom-form__input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <input type="text" id="page-consult-name" name="name" class="fur-custom-form__input" required placeholder="e.g. Ramesh Patel">
            </div>
          </div>

          <!-- 2. Email -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="page-consult-email">
              Email Address <span class="fur-custom-form__req">*</span>
            </label>
            <div class="fur-custom-form__input-wrap">
              <svg class="fur-custom-form__input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              <input type="email" id="page-consult-email" name="email" class="fur-custom-form__input" required placeholder="e.g. ramesh@example.com">
            </div>
          </div>
        </div>

        <!-- Row 2: Phone & Dimension -->
        <div class="fur-custom-form__grid">
          <!-- 3. Phone No. -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="page-consult-phone">
              <span>Phone / WhatsApp</span>
              <span class="fur-custom-form__opt">Optional</span>
            </label>
            <div class="fur-custom-form__input-wrap">
              <svg class="fur-custom-form__input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <input type="tel" id="page-consult-phone" name="phone" class="fur-custom-form__input" placeholder="e.g. +91 98765 43210">
            </div>
          </div>

          <!-- 4. Dimension -->
          <div class="fur-custom-form__field">
            <label class="fur-custom-form__label" for="page-consult-dimension">
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
              <input type="text" id="page-consult-dimension" name="dimension" class="fur-custom-form__input" placeholder="e.g. 72&quot;L &times; 36&quot;W &times; 30&quot;H">
            </div>
          </div>
        </div>

        <!-- 5. Upload Design (image with resize & webp) -->
        <div class="fur-custom-form__field">
          <div class="fur-custom-form__label-bar">
            <label class="fur-custom-form__label" for="page-consult-design-file">
              Upload Design / Blueprint / Photo
            </label>
            <span class="fur-custom-badge">Auto-Resize &bull; WebP 85%</span>
          </div>

          <div id="page-consult-dropzone" class="fur-dropzone">
            <input type="file" id="page-consult-design-file" class="fur-dropzone__input" accept="image/*">
            <input type="hidden" id="page-consult-design-base64" name="design_image_base64" value="">

            <div id="page-drop-prompt" class="fur-dropzone__prompt">
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

            <div id="page-drop-preview" class="fur-dropzone__preview" style="display: none;">
              <div class="fur-dropzone__thumb-wrap">
                <img id="page-preview-img" class="fur-dropzone__thumb" src="" alt="Design preview">
              </div>
              <div class="fur-dropzone__meta">
                <div id="page-preview-name" class="fur-dropzone__filename"></div>
                <div class="fur-dropzone__stats">
                  <span id="page-preview-meta" class="fur-dropzone__dims"></span>
                  <span class="fur-dropzone__pill">&check; WebP Ready</span>
                </div>
              </div>
              <button type="button" id="page-preview-remove" class="fur-dropzone__remove-btn" title="Remove design">
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
          <label class="fur-custom-form__label" for="page-consult-specification">
            Custom Specifications &amp; Notes
          </label>
          <textarea id="page-consult-specification" name="specification" class="fur-custom-form__textarea" rows="3" placeholder="Specify wood species (Teak, Sheesham, Oak), polish tone, joinery details, fabric, or specific design notes..."></textarea>
        </div>

        <!-- Submit Button -->
        <div class="fur-custom-form__submit-wrap">
          <button type="submit" class="fur-custom-submit-btn">
            <span>Submit Customized Enquiry</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </button>
          
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

    </div>
  </div>

  <script>
    (function() {
      const fileInput = document.getElementById('page-consult-design-file');
      const base64Input = document.getElementById('page-consult-design-base64');
      const dropzone = document.getElementById('page-consult-dropzone');
      const dropPrompt = document.getElementById('page-drop-prompt');
      const dropPreview = document.getElementById('page-drop-preview');
      const previewImg = document.getElementById('page-preview-img');
      const previewName = document.getElementById('page-preview-name');
      const previewMeta = document.getElementById('page-preview-meta');
      const removeBtn = document.getElementById('page-preview-remove');

      if (!fileInput) return;

      function process(file) {
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = function(evt) {
          const img = new Image();
          img.onload = function() {
            const MAX = 1200;
            let w = img.width;
            let h = img.height;
            if (w > MAX || h > MAX) {
              if (w > h) { h = Math.round((h * MAX) / w); w = MAX; }
              else { w = Math.round((w * MAX) / h); h = MAX; }
            }
            const canvas = document.createElement('canvas');
            canvas.width = w; canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, w, h);
            let webp = canvas.toDataURL('image/webp', 0.85);
            if (!webp.startsWith('data:image/webp')) webp = canvas.toDataURL('image/jpeg', 0.85);

            const sizeKb = Math.round(((webp.length - (webp.indexOf(',') + 1)) * 3) / 4 / 1024);
            base64Input.value = webp;
            previewImg.src = webp;
            previewName.textContent = file.name;
            previewMeta.textContent = `${w} \u00D7 ${h} px \u2022 ${sizeKb} KB (WebP)`;
            dropPrompt.style.display = 'none';
            dropPreview.style.display = 'flex';
          };
          img.src = evt.target.result;
        };
        reader.readAsDataURL(file);
      }

      fileInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) process(e.target.files[0]);
      });

      if (dropzone) {
        ['dragenter', 'dragover'].forEach(n => dropzone.addEventListener(n, e => {
          e.preventDefault();
          dropzone.classList.add('fur-dropzone--dragover');
        }));
        ['dragleave', 'drop'].forEach(n => dropzone.addEventListener(n, e => {
          e.preventDefault();
          dropzone.classList.remove('fur-dropzone--dragover');
        }));
        dropzone.addEventListener('drop', e => {
          if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0]) {
            process(e.dataTransfer.files[0]);
          }
        });
      }

      if (removeBtn) {
        removeBtn.addEventListener('click', function(e) {
          e.stopPropagation();
          fileInput.value = '';
          base64Input.value = '';
          previewImg.src = '';
          dropPreview.style.display = 'none';
          dropPrompt.style.display = 'flex';
        });
      }
    })();
  </script>
@endsection
