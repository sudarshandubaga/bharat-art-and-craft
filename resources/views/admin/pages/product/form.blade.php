@include('admin.flash-msg')

<div class="row g-4">
    <!-- Left Column: Main Product Details -->
    <div class="col-lg-8">
        <!-- Card 1: General Information -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-info-circle text-primary"></i> General Information
                </h5>
            </div>
            <div class="card-body">
                <!-- Title & Slug -->
                <div class="mb-3">
                    {{ Form::label('title', 'Product Title', ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control form-control-lg title', 'placeholder' => 'Enter Product Title', 'data-target' => '#slug', 'required' => 'required']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('slug', 'URL Slug', ['class' => 'form-label']) }}
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted small"><i class="bi bi-link-45deg"></i></span>
                        {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'auto-generated-slug']) }}
                    </div>
                </div>

                <!-- Category, Wood & Finish Dropdowns -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        {{ Form::label('category_id', 'Category', ['class' => 'form-label']) }}
                        {{ Form::select('category_id', $categories, null, ['class' => 'form-select', 'id' => 'category_id', 'placeholder' => '-- Select Category --']) }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('wood_id', 'Wood Species', ['class' => 'form-label']) }}
                        {{ Form::select('wood_id', $woods, null, ['class' => 'form-select', 'id' => 'wood_id', 'placeholder' => '-- Select Wood --']) }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('finish_id', 'Finish & Polish', ['class' => 'form-label']) }}
                        {{ Form::select('finish_id', $finishes, null, ['class' => 'form-select', 'id' => 'finish_id', 'placeholder' => '-- Select Finish --']) }}
                    </div>
                </div>

                <!-- Specifications: Code, CBM, Quantity, Price, Material -->
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        {{ Form::label('code', 'Product Code / SKU', ['class' => 'form-label']) }}
                        {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'e.g. BAC-001', 'required' => 'required']) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('price', 'Price (USD / INR)', ['class' => 'form-label']) }}
                        {{ Form::number('price', null, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => '499.00']) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('material', 'Primary Material', ['class' => 'form-label']) }}
                        {{ Form::text('material', null, ['class' => 'form-control', 'placeholder' => 'e.g. Solid White Oak']) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('cbm', 'CBM Volume', ['class' => 'form-label']) }}
                        {{ Form::text('cbm', null, ['class' => 'form-control', 'placeholder' => 'e.g. 0.45']) }}
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        {{ Form::label('quantity', 'Stock Quantity', ['class' => 'form-label']) }}
                        {{ Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => '1']) }}
                    </div>
                    <div class="col-md-8">
                        {{ Form::label('excerpt', 'Short Summary', ['class' => 'form-label']) }}
                        {{ Form::text('excerpt', null, ['class' => 'form-control', 'placeholder' => 'Brief highlight for cards and catalog']) }}
                    </div>
                </div>

                <!-- Featured Product Toggle -->
                <div class="mb-2 p-3 bg-light rounded-3 border">
                    <label class="form-label d-block fw-bold mb-2">Featured on Homepage?</label>
                    <div class="d-flex align-items-center gap-4">
                        <div class="form-check">
                            {{ Form::radio('featured_product', 'Y', true, ['id' => 'inlineRadio1', 'class' => 'form-check-input']) }}
                            {{ Form::label('inlineRadio1', 'Yes, feature this product', ['class' => 'form-check-label fw-semibold text-success']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::radio('featured_product', 'N', false, ['id' => 'inlineRadio2', 'class' => 'form-check-input']) }}
                            {{ Form::label('inlineRadio2', 'No, standard product', ['class' => 'form-check-label fw-semibold text-muted']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Detailed Description -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-text-paragraph text-primary"></i> Description & Overview
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-0">
                    {{ Form::textarea('description', null, ['class' => 'form-control myEditor', 'rows' => 10, 'placeholder' => 'Write detailed product description...']) }}
                </div>
            </div>
        </div>

        <!-- Card 3: Search Engine Optimization (SEO) -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-search text-primary"></i> Search Engine Optimization (SEO)
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('meta_title', 'Meta Title', ['class' => 'form-label']) }}
                    {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter SEO Meta Title']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('meta_keywords', 'Meta Keywords', ['class' => 'form-label']) }}
                    {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'wooden furniture, handcrafted table, etc.']) }}
                </div>
                <div class="mb-0">
                    {{ Form::label('meta_description', 'Meta Description', ['class' => 'form-label']) }}
                    {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter brief meta summary for search engines']) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Media, Cropper & Publishing -->
    <div class="col-lg-4">
        <!-- Card 4: Product Image with Dropzone & Cropper -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-image text-primary"></i> Main Product Image
                </h5>
            </div>
            <div class="card-body">
                @include('admin.components.image-dropzone', [
                    'name' => 'image',
                    'label' => 'Main Product Image',
                    'current' => !empty($product->image) ? asset('images/products/' . $product->image) : null,
                    'aspectRatio' => '1/1',
                    'help' => 'Square ratio (1:1) recommended. Primary image shown on cards and thumbnails.'
                ])
            </div>
        </div>

        <!-- Card 4.5: Multiple Product Gallery Images -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-images text-primary me-2"></i> Additional Gallery Images
                        </h5>
                    </div>
                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">
                        <i class="bi bi-crop me-1"></i> Drag & Drop + Crop / WebP
                    </span>
                </div>
            </div>
            <div class="card-body">
                <!-- Gallery Drag & Drop Area (HTML label natively triggers file input on click) -->
                <label for="galleryFileInput" class="gallery-dropzone-container d-block" id="galleryDropzoneContainer">
                    <div class="dropzone-icon-box">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <div class="dropzone-title">
                        Drag & drop gallery images here, or <span>browse files</span>
                    </div>
                    <p class="dropzone-desc mt-1">Select multiple images (JPG, PNG, WebP). Drag & drop to queue, then crop or adjust each image.</p>
                </label>
                <!-- Native input placed outside label to prevent any event recursion -->
                <input type="file" id="galleryFileInput" class="d-none" multiple accept="image/*">

                <!-- Newly Staged / Queued Images Grid -->
                <div id="galleryStagedSection" class="d-none mt-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label class="form-label fw-bold small text-uppercase text-muted mb-0">
                            <i class="bi bi-card-image me-1"></i> Queued Gallery Photos (<span id="stagedCount">0</span>)
                        </label>
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="btnClearAllStaged">
                            <i class="bi bi-trash3 me-1"></i> Clear All
                        </button>
                    </div>
                    <div class="row g-2" id="galleryStagedGrid"></div>
                </div>

                @if(!empty($product) && $product->images->isNotEmpty())
                    <div class="border-top pt-3 mt-3">
                        <label class="form-label fw-semibold mb-2">
                            <i class="bi bi-collection-play me-1 text-primary"></i> Existing Gallery Photos ({{ $product->images->count() }})
                        </label>
                        <div class="row g-2 mb-2" id="product-gallery-preview-grid">
                            @foreach($product->images as $galImg)
                                <div class="col-4 position-relative gallery-item-wrap" id="gallery-item-{{ $galImg->id }}">
                                    <div class="border rounded p-1 bg-light text-center position-relative">
                                        <img src="{{ $galImg->image_url }}" alt="Gallery Image" class="img-fluid rounded" style="height: 75px; object-fit: cover; width: 100%;">
                                        <button type="button" class="btn btn-sm btn-danger py-0 px-1 position-absolute top-0 end-0 m-1 rounded-circle"
                                                onclick="deleteGalleryImage({{ $galImg->id }})" title="Delete image" style="font-size: 0.75rem; line-height: 1;">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <script>
                        function deleteGalleryImage(id) {
                            if (!confirm('Are you sure you want to remove this gallery image?')) return;
                            fetch('{{ url("admin/product/gallery-image") }}/' + id, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            }).then(res => res.json()).then(data => {
                                if (data.success) {
                                    const el = document.getElementById('gallery-item-' + id);
                                    if (el) el.remove();
                                }
                            }).catch(err => {
                                console.error(err);
                                alert('Error deleting image.');
                            });
                        }
                    </script>
                @endif
            </div>

            <!-- Self-contained Gallery Dropzone & Crop Handler -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const fileInput = document.getElementById('galleryFileInput');
                    const dropzone = document.getElementById('galleryDropzoneContainer');
                    const stagedSection = document.getElementById('galleryStagedSection');
                    const stagedGrid = document.getElementById('galleryStagedGrid');
                    const stagedCount = document.getElementById('stagedCount');
                    const clearBtn = document.getElementById('btnClearAllStaged');

                    if (!fileInput || !dropzone || !stagedGrid) return;

                    let stagedCounter = 0;

                    function updateCount() {
                        const count = stagedGrid.querySelectorAll('.gallery-staged-card').length;
                        if (stagedCount) stagedCount.textContent = count;
                        if (stagedSection) {
                            if (count > 0) stagedSection.classList.remove('d-none');
                            else stagedSection.classList.add('d-none');
                        }
                    }

                    if (clearBtn) {
                        clearBtn.addEventListener('click', function (e) {
                            e.preventDefault();
                            stagedGrid.innerHTML = '';
                            updateCount();
                        });
                    }

                    // Drag & drop highlights
                    ['dragenter', 'dragover'].forEach(function (evt) {
                        dropzone.addEventListener(evt, function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            dropzone.classList.add('is-dragover');
                        });
                    });

                    ['dragleave', 'dragend'].forEach(function (evt) {
                        dropzone.addEventListener(evt, function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            dropzone.classList.remove('is-dragover');
                        });
                    });

                    dropzone.addEventListener('drop', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        dropzone.classList.remove('is-dragover');
                        const dt = e.dataTransfer;
                        if (dt && dt.files && dt.files.length) {
                            processFiles(dt.files);
                        }
                    });

                    fileInput.addEventListener('change', function () {
                        if (this.files && this.files.length) {
                            processFiles(this.files);
                            this.value = '';
                        }
                    });

                    function processFiles(fileList) {
                        const imageFiles = Array.from(fileList).filter(function (f) {
                            return f.type && (f.type.startsWith('image/') || f.type.indexOf('image') !== -1);
                        });

                        if (!imageFiles.length) {
                            alert('Please select valid image files (JPG, PNG, WebP).');
                            return;
                        }

                        let processed = 0;
                        const total = imageFiles.length;

                        imageFiles.forEach(function (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const dataUrl = e.target.result;
                                stagedCounter++;
                                const cardId = 'staged-card-' + stagedCounter;
                                const sizeKb = (file.size / 1024).toFixed(1) + ' KB';

                                const col = document.createElement('div');
                                col.className = 'col-12 gallery-staged-card';
                                col.id = cardId;
                                col.innerHTML = `
                                    <input type="hidden" name="gallery_images_base64[]" class="gallery-item-input" value="${dataUrl}">
                                    <div class="card border p-2 shadow-sm bg-white">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative flex-shrink-0" style="width: 72px; height: 72px; border-radius: 8px; overflow: hidden; background: #f8fafc; border: 1px solid #e2e8f0;">
                                                <img src="${dataUrl}" alt="${file.name}" class="gallery-item-thumb w-100 h-100" style="object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 min-w-0">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <span class="fw-bold text-dark text-truncate small gallery-item-name" title="${file.name}">${file.name}</span>
                                                    <button type="button" class="btn btn-link text-danger p-0 border-0 btn-remove-staged" data-target="#${cardId}" title="Remove this photo">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                                    <span class="badge bg-light text-secondary border gallery-item-status" style="font-size: 0.7rem;">
                                                        <i class="bi bi-clock me-1"></i> Original
                                                    </span>
                                                    <span class="text-muted small gallery-item-dims" style="font-size: 0.75rem;">Detecting...</span>
                                                    <span class="text-muted small gallery-item-size" style="font-size: 0.75rem;">${sizeKb}</span>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-xs btn-outline-primary py-1 px-2 btn-crop-gallery-item" data-target="#${cardId}" style="font-size: 0.75rem;">
                                                        <i class="bi bi-crop me-1"></i> Crop & Resize (WebP)
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                stagedGrid.appendChild(col);
                                updateCount();

                                const img = new Image();
                                img.onload = function () {
                                    const dimsEl = col.querySelector('.gallery-item-dims');
                                    if (dimsEl) dimsEl.textContent = img.naturalWidth + ' × ' + img.naturalHeight + ' px';
                                };
                                img.src = dataUrl;

                                processed++;
                                if (processed === total) {
                                    if (total === 1 && typeof window.openCropModalForGallery === 'function') {
                                        window.openCropModalForGallery($(col), dataUrl, file.name);
                                    }
                                }
                            };
                            reader.readAsDataURL(file);
                        });
                    }

                    // Delegate remove and crop buttons
                    document.addEventListener('click', function (e) {
                        const removeBtn = e.target.closest('.btn-remove-staged');
                        if (removeBtn) {
                            e.preventDefault();
                            e.stopPropagation();
                            const targetSelector = removeBtn.getAttribute('data-target');
                            const target = document.querySelector(targetSelector);
                            if (target) {
                                target.remove();
                                updateCount();
                            }
                            return;
                        }

                        const cropBtn = e.target.closest('.btn-crop-gallery-item');
                        if (cropBtn) {
                            e.preventDefault();
                            e.stopPropagation();
                            const targetSelector = cropBtn.getAttribute('data-target');
                            const card = document.querySelector(targetSelector);
                            if (!card) return;

                            const input = card.querySelector('.gallery-item-input');
                            const thumb = card.querySelector('.gallery-item-thumb');
                            const nameEl = card.querySelector('.gallery-item-name');
                            const dataUrl = input ? input.value : (thumb ? thumb.src : '');
                            const filename = nameEl ? nameEl.textContent.trim() : 'gallery-image.jpg';

                            if (typeof window.openCropModalForGallery === 'function') {
                                window.openCropModalForGallery($(card), dataUrl, filename);
                            }
                        }
                    });
                });
            </script>
        </div>

        <!-- Card 5: Actions & Publishing -->
        <div class="card mb-4 shadow-sm border-primary-subtle">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-send-check text-success"></i> Publishing
                </h5>
            </div>
            <div class="card-body">
                @if(!empty($product->id))
                    <div class="small text-muted mb-3 d-flex flex-column gap-1">
                        <div><strong>Created:</strong> {{ $product->created_at ? $product->created_at->format('M d, Y h:i A') : 'N/A' }}</div>
                        <div><strong>Last Updated:</strong> {{ $product->updated_at ? $product->updated_at->format('M d, Y h:i A') : 'N/A' }}</div>
                    </div>
                @endif

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ !empty($product->id) ? 'Update Product' : 'Save Product' }}
                    </button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-light border">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
