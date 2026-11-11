@php
    $inputName = $name ?? 'image';
    $inputId = 'dropzone_input_' . str_replace(['[', ']'], ['_', ''], $inputName);
    $inputLabel = $label ?? 'Image';
    $currentImage = $current ?? null;
    $ratio = $aspectRatio ?? '1/1';
    $helpText = $help ?? 'Supported formats: JPG, PNG, WebP. Recommended: 800x800px.';
    $isRequired = !empty($required);
@endphp

<div class="dropzone-wrapper mb-4">
    @if($inputLabel)
        <label class="form-label d-flex align-items-center justify-content-between">
            <span>
                {{ $inputLabel }}
                @if($isRequired && empty($currentImage))
                    <span class="text-danger">*</span>
                @endif
            </span>
            <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">
                <i class="bi bi-crop me-1"></i> Auto Cropper & WebP Optimizer
            </span>
        </label>
    @endif

    <!-- Native file input (hidden, synced automatically with cropped file) -->
    <input type="file" 
           name="{{ $inputName }}" 
           id="{{ $inputId }}" 
           class="d-none dropzone-file-input" 
           accept="image/*"
           data-required="{{ $isRequired && empty($currentImage) ? '1' : '0' }}">

    <!-- Hidden base64 fallback input -->
    <input type="hidden" name="{{ $inputName }}_base64" class="dropzone-base64-input">

    <!-- Dropzone Area (shown when no image is selected / or replaces preview) -->
    <div class="dropzone-container {{ !empty($currentImage) ? 'd-none' : '' }}" 
         data-target-input="{{ $inputId }}" 
         data-aspect-ratio="{{ $ratio }}">
        <div class="dropzone-icon-box">
            <i class="bi bi-cloud-arrow-up"></i>
        </div>
        <div class="dropzone-title">
            Drag & drop image here, or <span>browse file</span>
        </div>
        <p class="dropzone-desc mt-1">{{ $helpText }}</p>
    </div>

    <!-- Dropzone Preview Card (shown when current image exists or image is cropped) -->
    <div class="dropzone-preview-card {{ empty($currentImage) ? 'd-none' : '' }}">
        <div class="dropzone-preview-img-wrap">
            <img src="{{ $currentImage ?? '' }}" alt="Selected image preview">
        </div>
        <div class="dropzone-preview-info">
            <div class="dropzone-preview-filename text-truncate" style="max-width: 280px;">
                {{ !empty($currentImage) ? basename($currentImage) : 'Selected Image' }}
            </div>
            <div class="dropzone-preview-meta">
                <span class="badge bg-success-light text-success border border-success-subtle">
                    <i class="bi bi-check-circle-fill me-1"></i> Ready
                </span>
                <span class="dropzone-preview-dimensions text-muted"></span>
                <span class="dropzone-preview-size text-muted"></span>
            </div>
            <div class="dropzone-preview-actions">
                <button type="button" class="btn btn-sm btn-outline-primary btn-recrop-image" title="Adjust Crop Area">
                    <i class="bi bi-crop me-1"></i> Crop / Adjust
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary btn-change-image" title="Choose another image">
                    <i class="bi bi-arrow-repeat me-1"></i> Replace
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-image" title="Remove selected image">
                    <i class="bi bi-trash3 me-1"></i> Remove
                </button>
            </div>
        </div>
    </div>
</div>
