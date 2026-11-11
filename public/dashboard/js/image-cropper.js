/**
 * Stage Art & Craft - Dropzone & Cropper.js Integration
 * Handles image drag & drop, file selection, cropping popup, and syncing to form input.
 */

(function ($) {
    'use strict';

    let cropper = null;
    let activeDropzone = null;
    let activeInputId = null;
    let activeGalleryCard = null;
    let stagedUid = 0;
    let currentFile = null;
    let currentImageSrc = null;
    let currentAspectRatio = NaN;
    let scaleX = 1;

    // Helper: Convert DataURL (base64) to Blob synchronously and safely
    function dataURLtoBlob(dataurl) {
        try {
            const arr = dataurl.split(',');
            const mimeMatch = arr[0].match(/:(.*?);/);
            const mime = mimeMatch ? mimeMatch[1] : 'image/jpeg';
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], { type: mime });
        } catch (e) {
            console.error('dataURLtoBlob failed:', e);
            return null;
        }
    }

    // Helper: Safely destroy Cropper instance
    function destroyCropper() {
        if (cropper) {
            try {
                cropper.destroy();
            } catch (e) {
                console.warn('Error destroying cropper:', e);
            }
            cropper = null;
        }
    }

    // Initialize when DOM is ready
    $(document).ready(function () {
        initDropzones();
        initGalleryDropzone();
        initCropModalControls();
    });

    /**
     * Bind dropzone event listeners
     */
    function initDropzones() {
        // Prevent default drag behaviors for entire window
        window.addEventListener('dragover', function (e) { e.preventDefault(); }, false);
        window.addEventListener('drop', function (e) { e.preventDefault(); }, false);

        // Click on dropzone container triggers file picker
        $(document).on('click', '.dropzone-container', function (e) {
            // Avoid triggering when clicking buttons inside preview
            if ($(e.target).closest('.dropzone-preview-actions').length || $(e.target).closest('button').length) {
                return;
            }
            activeDropzone = $(this);
            const targetInputId = $(this).data('target-input');
            activeInputId = targetInputId;

            const input = document.getElementById(targetInputId);
            if (input) {
                // Clear input value so selecting the same file triggers change event
                input.value = '';
                input.click();
            }
        });

        // Dragover & Dragenter
        $(document).on('dragover dragenter', '.dropzone-container', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('is-dragover');
        });

        // Dragleave & Dragend
        $(document).on('dragleave dragend drop', '.dropzone-container', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('is-dragover');
        });

        // Drop event
        $(document).on('drop', '.dropzone-container', function (e) {
            e.preventDefault();
            e.stopPropagation();
            activeDropzone = $(this);
            activeInputId = $(this).data('target-input');

            const files = e.originalEvent.dataTransfer ? e.originalEvent.dataTransfer.files : null;
            if (files && files.length > 0) {
                handleFileSelection($(this), files[0]);
            }
        });

        // Native file input change
        $(document).on('change', '.dropzone-file-input', function () {
            if (this.files && this.files.length > 0) {
                const dropzone = $(this).closest('.dropzone-wrapper').find('.dropzone-container');
                activeDropzone = dropzone;
                activeInputId = this.id;
                handleFileSelection(dropzone, this.files[0]);
            }
        });

        // Change / Replace Image button
        $(document).on('click', '.btn-change-image', function (e) {
            e.stopPropagation();
            const wrapper = $(this).closest('.dropzone-wrapper');
            activeDropzone = wrapper.find('.dropzone-container');
            const fileInput = wrapper.find('.dropzone-file-input')[0];
            if (fileInput) {
                activeInputId = fileInput.id;
                fileInput.value = '';
                fileInput.click();
            }
        });

        // Re-crop button
        $(document).on('click', '.btn-recrop-image', function (e) {
            e.stopPropagation();
            const wrapper = $(this).closest('.dropzone-wrapper');
            const dropzone = wrapper.find('.dropzone-container');
            activeDropzone = dropzone;
            const fileInput = wrapper.find('.dropzone-file-input')[0];
            if (fileInput) {
                activeInputId = fileInput.id;
            }

            const previewImg = wrapper.find('.dropzone-preview-img-wrap img');
            const imgSrc = previewImg.attr('src');
            const filename = wrapper.find('.dropzone-preview-filename').text().trim() || 'image.jpg';

            if (imgSrc) {
                // If remote or relative URL, fetch as blob URL to prevent canvas security tainting
                if (imgSrc.startsWith('http://') || imgSrc.startsWith('https://') || imgSrc.startsWith('/')) {
                    fetch(imgSrc)
                        .then(function (res) { return res.blob(); })
                        .then(function (blob) {
                            const blobUrl = URL.createObjectURL(blob);
                            openCropModal(blobUrl, filename);
                        })
                        .catch(function () {
                            openCropModal(imgSrc, filename);
                        });
                } else {
                    openCropModal(imgSrc, filename);
                }
            }
        });

        // Remove Image button
        $(document).on('click', '.btn-remove-image', function (e) {
            e.stopPropagation();
            const wrapper = $(this).closest('.dropzone-wrapper');
            const fileInput = wrapper.find('.dropzone-file-input')[0];
            const base64Input = wrapper.find('.dropzone-base64-input');
            const dropzone = wrapper.find('.dropzone-container');
            const previewCard = wrapper.find('.dropzone-preview-card');

            if (fileInput) fileInput.value = '';
            if (base64Input.length) base64Input.val('');
            currentFile = null;
            currentImageSrc = null;

            previewCard.addClass('d-none');
            dropzone.removeClass('d-none');
        });
    }

    /**
     * Handle file selection and prepare for crop modal
     */
    function handleFileSelection(dropzone, file) {
        if (!file || !file.type.match(/^image\//)) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File',
                    text: 'Please select an image file (JPG, PNG, WebP, etc.).'
                });
            } else {
                alert('Please select an image file.');
            }
            return;
        }

        currentFile = file;
        activeDropzone = dropzone;
        activeInputId = dropzone.data('target-input');

        const reader = new FileReader();
        reader.onload = function (e) {
            openCropModal(e.target.result, file.name);
        };
        reader.readAsDataURL(file);
    }

    /**
     * Parse aspect ratio string to float
     */
    function parseAspectRatio(ratioStr) {
        if (!ratioStr || ratioStr === 'free') return NaN;
        if (ratioStr === '1/1' || ratioStr === '1:1') return 1;
        if (ratioStr === '4/3' || ratioStr === '4:3') return 4 / 3;
        if (ratioStr === '16/9' || ratioStr === '16:9') return 16 / 9;
        if (ratioStr === '3/2' || ratioStr === '3:2') return 3 / 2;
        return NaN;
    }

    /**
     * Open Crop Modal and setup Cropper.js
     */
    function openCropModal(imageSrc, filename) {
        const modalEl = document.getElementById('imageCropModal');
        if (!modalEl) {
            console.error('imageCropModal element not found in DOM.');
            return;
        }

        destroyCropper();

        scaleX = 1;
        currentImageSrc = imageSrc;

        // Reset workspace with fresh, clean image element
        const workspace = modalEl.querySelector('.cropper-workspace');
        if (workspace) {
            workspace.innerHTML = `<img id="cropModalImage" src="${imageSrc}" alt="Target Image" crossorigin="anonymous" style="display: block; max-width: 100%;">`;
        }

        // Determine default aspect ratio
        const ratioAttr = activeDropzone ? activeDropzone.data('aspect-ratio') : 'free';
        currentAspectRatio = parseAspectRatio(ratioAttr);

        // Update active aspect ratio button in modal
        $('.cropper-aspect-btn').removeClass('active');
        const activeBtn = $(`.cropper-aspect-btn[data-ratio="${ratioAttr}"]`);
        if (activeBtn.length) {
            activeBtn.addClass('active');
        } else {
            $('.cropper-aspect-btn[data-ratio="free"]').addClass('active');
        }

        // Reset mode button
        $('.cropper-mode-btn').removeClass('active');
        $('#btnModeCrop').addClass('active');

        // Update modal title filename
        $('#cropModalFilename').text(filename || 'image.jpg');

        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

        // If modal is already shown (e.g. re-crop while open), start immediately
        if (modalEl.classList.contains('show')) {
            startCropper();
        }
    }

    /**
     * Initialize Cropper on the image
     */
    function startCropper() {
        const cropImage = document.getElementById('cropModalImage');
        if (!cropImage) return;

        destroyCropper();

        if (typeof Cropper === 'undefined') {
            console.error('Cropper.js library is not loaded!');
            return;
        }

        cropper = new Cropper(cropImage, {
            aspectRatio: currentAspectRatio,
            viewMode: 1,
            dragMode: 'crop',
            autoCrop: true,
            autoCropArea: 0.85,
            responsive: true,
            restore: false,
            checkCrossOrigin: false,
            guides: true,
            center: true,
            highlight: true,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: true,
            preview: '.crop-preview-box',
            ready: function () {
                try {
                    const data = this.cropper.getData();
                    $('#cropDimensions').text(Math.round(data.width) + ' × ' + Math.round(data.height) + ' px');
                } catch (e) {}
            },
            crop: function (event) {
                const data = event.detail;
                $('#cropDimensions').text(Math.round(data.width) + ' × ' + Math.round(data.height) + ' px');
            }
        });
    }

    /**
     * Controls inside Crop Modal
     */
    function initCropModalControls() {
        const modalEl = document.getElementById('imageCropModal');
        if (!modalEl) return;

        // When modal is fully visible and rendered in DOM, initialize Cropper
        modalEl.addEventListener('shown.bs.modal', function () {
            const cropImage = document.getElementById('cropModalImage');
            if (!cropImage) return;

            if (cropImage.complete && cropImage.naturalWidth > 0) {
                startCropper();
            } else {
                cropImage.onload = function () {
                    startCropper();
                };
                // Fallback timeout in case onload already passed
                setTimeout(function () {
                    if (!cropper) startCropper();
                }, 150);
            }
        });

        // Clean up cropper when modal is hidden
        modalEl.addEventListener('hidden.bs.modal', function () {
            destroyCropper();
            activeGalleryCard = null;
            window.__activeGalleryCard = null;
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css({ overflow: '', paddingRight: '' });
        });

        // Cancel / Close X click handling
        $(document).on('click', '#btnModalCancel, #btnModalCloseX', function () {
            if (activeGalleryCard || window.__activeGalleryCard) {
                activeGalleryCard = null;
                window.__activeGalleryCard = null;
                return;
            }

            let wrapper = (activeDropzone && activeDropzone.length) 
                ? activeDropzone.closest('.dropzone-wrapper') 
                : (activeInputId ? $('#' + activeInputId).closest('.dropzone-wrapper') : null);

            if (wrapper) {
                const previewCard = wrapper.find('.dropzone-preview-card');
                // If dropzone was empty and user cancelled, clear the staged file
                if (previewCard.hasClass('d-none')) {
                    const fileInput = wrapper.find('.dropzone-file-input')[0];
                    if (fileInput) fileInput.value = '';
                    wrapper.find('.dropzone-base64-input').val('');
                }
            }
        });

        // Aspect ratio buttons
        $(document).on('click', '.cropper-aspect-btn', function () {
            $('.cropper-aspect-btn').removeClass('active');
            $(this).addClass('active');

            const ratio = $(this).data('ratio');
            currentAspectRatio = parseAspectRatio(ratio);
            if (cropper) {
                cropper.setAspectRatio(currentAspectRatio);
            }
        });

        // Mode: Crop Box vs Move
        $(document).on('click', '#btnModeCrop', function () {
            $('.cropper-mode-btn').removeClass('active');
            $(this).addClass('active');
            if (cropper) cropper.setDragMode('crop');
        });

        $(document).on('click', '#btnModeMove', function () {
            $('.cropper-mode-btn').removeClass('active');
            $(this).addClass('active');
            if (cropper) cropper.setDragMode('move');
        });

        // Rotate Left
        $(document).on('click', '#btnCropRotateLeft', function () {
            if (cropper) cropper.rotate(-90);
        });

        // Rotate Right
        $(document).on('click', '#btnCropRotateRight', function () {
            if (cropper) cropper.rotate(90);
        });

        // Flip Horizontal
        $(document).on('click', '#btnCropFlipH', function () {
            if (cropper) {
                scaleX = -scaleX;
                cropper.scaleX(scaleX);
            }
        });

        // Zoom In
        $(document).on('click', '#btnCropZoomIn', function () {
            if (cropper) cropper.zoom(0.1);
        });

        // Zoom Out
        $(document).on('click', '#btnCropZoomOut', function () {
            if (cropper) cropper.zoom(-0.1);
        });

        // Reset
        $(document).on('click', '#btnCropReset', function () {
            if (cropper) {
                scaleX = 1;
                cropper.reset();
            }
        });

        // Skip Crop - Use original image directly
        $(document).on('click', '#btnSkipCrop', function () {
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);

            const targetGalleryCard = (activeGalleryCard && activeGalleryCard.length) ? activeGalleryCard : (window.__activeGalleryCard ? $(window.__activeGalleryCard) : null);
            if (targetGalleryCard && targetGalleryCard.length) {
                targetGalleryCard.find('.gallery-item-status')
                    .html('<i class="bi bi-clock me-1"></i> Original')
                    .removeClass('bg-success-subtle text-success')
                    .addClass('bg-light text-secondary border');
                activeGalleryCard = null;
                window.__activeGalleryCard = null;
                modalInstance.hide();
                return;
            }

            let wrapper = (activeDropzone && activeDropzone.length) 
                ? activeDropzone.closest('.dropzone-wrapper') 
                : (activeInputId ? $('#' + activeInputId).closest('.dropzone-wrapper') : $('.dropzone-wrapper').first());

            if (!wrapper || !wrapper.length) {
                modalInstance.hide();
                return;
            }

            const dropzone = wrapper.find('.dropzone-container');
            const previewCard = wrapper.find('.dropzone-preview-card');
            const base64Input = wrapper.find('.dropzone-base64-input');

            if (currentImageSrc && currentImageSrc.startsWith('data:')) {
                base64Input.val(currentImageSrc);
            }

            const fileName = (currentFile && currentFile.name) ? currentFile.name : 'original-image.jpg';

            previewCard.find('.dropzone-preview-img-wrap img').attr('src', currentImageSrc || '');
            previewCard.find('.dropzone-preview-filename').text(fileName);
            previewCard.find('.dropzone-preview-dimensions').text('Original');
            previewCard.find('.dropzone-preview-size').text(currentFile ? (currentFile.size / 1024).toFixed(1) + ' KB' : '');

            dropzone.addClass('d-none');
            previewCard.removeClass('d-none');

            modalInstance.hide();
        });

        // Apply Crop Button
        $(document).on('click', '#btnApplyCrop', function () {
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);

            let croppedBase64 = null;
            let canvasW = 800;
            let canvasH = 800;

            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    maxWidth: 2400,
                    maxHeight: 2400,
                    fillColor: '#ffffff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });

                if (canvas) {
                    canvasW = canvas.width;
                    canvasH = canvas.height;
                    try {
                        croppedBase64 = canvas.toDataURL('image/webp', 0.90);
                        if (!croppedBase64.startsWith('data:image/webp')) {
                            croppedBase64 = canvas.toDataURL('image/jpeg', 0.92);
                        }
                    } catch (e) {
                        croppedBase64 = canvas.toDataURL('image/jpeg', 0.92);
                    }
                }
            }

            // Fallback if canvas was unavailable
            if (!croppedBase64) {
                croppedBase64 = currentImageSrc;
            }

            if (!croppedBase64) {
                alert('Please select an image area to crop.');
                return;
            }

            // Case A: Gallery Staged Item Crop
            const targetGalleryCard = (activeGalleryCard && activeGalleryCard.length) ? activeGalleryCard : (window.__activeGalleryCard ? $(window.__activeGalleryCard) : null);
            if (targetGalleryCard && targetGalleryCard.length) {
                targetGalleryCard.find('.gallery-item-thumb').attr('src', croppedBase64);
                targetGalleryCard.find('.gallery-item-input').val(croppedBase64);
                targetGalleryCard.find('.gallery-item-dims').text(canvasW + ' × ' + canvasH + ' px');

                const approxKb = (Math.round((croppedBase64.length * 3 / 4) / 1024));
                targetGalleryCard.find('.gallery-item-size').text(approxKb + ' KB');

                targetGalleryCard.find('.gallery-item-status')
                    .html('<i class="bi bi-check2-circle me-1"></i> Cropped & WebP Ready')
                    .removeClass('bg-light text-secondary')
                    .addClass('bg-success-subtle text-success border border-success-subtle');

                activeGalleryCard = null;
                window.__activeGalleryCard = null;
                modalInstance.hide();

                if (typeof Swal !== 'undefined') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Gallery image cropped & resized!'
                    });
                }
                return;
            }

            // Case B: Single Image Dropzone (e.g. Main Product Image)
            let wrapper = (activeDropzone && activeDropzone.length) 
                ? activeDropzone.closest('.dropzone-wrapper') 
                : (activeInputId ? $('#' + activeInputId).closest('.dropzone-wrapper') : $('.dropzone-wrapper').first());

            if (!wrapper || !wrapper.length) {
                console.error('Cannot locate dropzone wrapper.');
                modalInstance.hide();
                return;
            }

            const dropzone = wrapper.find('.dropzone-container');
            const previewCard = wrapper.find('.dropzone-preview-card');
            const fileInput = wrapper.find('.dropzone-file-input')[0];
            const base64Input = wrapper.find('.dropzone-base64-input');

            // Convert to Blob synchronously
            const blob = dataURLtoBlob(croppedBase64);
            const origName = (currentFile && currentFile.name) ? currentFile.name : 'cropped-image.jpg';
            const fileName = origName.replace(/\.[^/.]+$/, "") + ".jpg";

            if (blob) {
                const croppedFile = new File([blob], fileName, {
                    type: blob.type || 'image/jpeg',
                    lastModified: Date.now()
                });

                // Assign to native file input via DataTransfer
                if (fileInput && window.DataTransfer) {
                    try {
                        const dt = new DataTransfer();
                        dt.items.add(croppedFile);
                        fileInput.files = dt.files;
                    } catch (e) {
                        console.warn('DataTransfer assignment not supported, relying on base64 fallback', e);
                    }
                }
            }

            // Assign to base64 fallback input
            if (base64Input.length) {
                base64Input.val(croppedBase64);
            }

            // Update Preview UI
            previewCard.find('.dropzone-preview-img-wrap img').attr('src', croppedBase64);
            previewCard.find('.dropzone-preview-filename').text(fileName);
            previewCard.find('.dropzone-preview-dimensions').text(canvasW + ' × ' + canvasH + ' px');
            if (blob) {
                previewCard.find('.dropzone-preview-size').text((blob.size / 1024).toFixed(1) + ' KB');
            }

            dropzone.addClass('d-none');
            previewCard.removeClass('d-none');

            // Close modal
            modalInstance.hide();

            // Feedback notification
            if (typeof Swal !== 'undefined') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Image cropped & applied!'
                });
            }
        });
    }

    /**
     * Open Crop Modal specifically for a gallery card item
     */
    function openCropModalForGallery(cardEl, imageSrc, filename) {
        activeGalleryCard = $(cardEl);
        window.__activeGalleryCard = activeGalleryCard;
        activeDropzone = null;
        activeInputId = null;
        currentFile = { name: filename || 'gallery-image.jpg' };
        openCropModal(imageSrc, filename || 'gallery-image.jpg');
    }

    /**
     * Gallery Drag & Drop and Queue Management
     */
    function initGalleryDropzone() {
        // Dragover & Dragenter (using document delegation)
        $(document).on('dragover dragenter', '#galleryDropzoneContainer', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('is-dragover');
        });

        // Dragleave & Dragend
        $(document).on('dragleave dragend', '#galleryDropzoneContainer', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('is-dragover');
        });

        // Drop event
        $(document).on('drop', '#galleryDropzoneContainer', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('is-dragover');
            const files = e.originalEvent.dataTransfer ? e.originalEvent.dataTransfer.files : null;
            if (files && files.length > 0) {
                handleGalleryFiles(files);
            }
        });

        // File input change
        $(document).on('change', '#galleryFileInput', function () {
            if (this.files && this.files.length > 0) {
                handleGalleryFiles(this.files);
                this.value = ''; // Reset so user can choose again or add more
            }
        });

        // Click "Crop & Resize" button on a staged gallery card
        $(document).on('click', '.btn-crop-gallery-item', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const targetSelector = $(this).data('target');
            const card = $(targetSelector);
            if (!card.length) return;

            const currentVal = card.find('.gallery-item-input').val() || card.find('.gallery-item-thumb').attr('src');
            const filename = card.find('.gallery-item-name').text().trim() || 'gallery-image.jpg';
            openCropModalForGallery(card, currentVal, filename);
        });

        // Remove staged gallery card
        $(document).on('click', '.btn-remove-staged', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const targetSelector = $(this).data('target');
            $(targetSelector).fadeOut(150, function () {
                $(this).remove();
                updateStagedCount();
            });
        });

        // Clear all staged gallery items
        $(document).on('click', '#btnClearAllStaged', function (e) {
            e.preventDefault();
            $('#galleryStagedGrid').empty();
            updateStagedCount();
        });
    }

    function handleGalleryFiles(fileList) {
        if (!fileList || !fileList.length) return;

        const validFiles = [];
        for (let i = 0; i < fileList.length; i++) {
            const f = fileList[i];
            if (f.type && (f.type.match(/^image\//) || f.type.indexOf('image/') !== -1)) {
                validFiles.push(f);
            }
        }

        if (validFiles.length === 0) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Files',
                    text: 'Please select valid image files (JPG, PNG, WebP).'
                });
            } else {
                alert('Please select valid image files.');
            }
            return;
        }

        let processed = 0;
        const total = validFiles.length;

        validFiles.forEach(function (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const dataUrl = e.target.result;
                stagedUid++;
                const cardId = 'staged-card-' + stagedUid;
                const sizeKb = (file.size / 1024).toFixed(1) + ' KB';

                const cardHtml = `
                    <div class="col-12 gallery-staged-card" id="${cardId}">
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
                    </div>
                `;
                $('#galleryStagedGrid').append(cardHtml);
                updateStagedCount();

                // Compute dimensions asynchronously
                const tempImg = new Image();
                tempImg.onload = function () {
                    $('#' + cardId).find('.gallery-item-dims').text(tempImg.naturalWidth + ' × ' + tempImg.naturalHeight + ' px');
                };
                tempImg.src = dataUrl;

                processed++;
                if (processed === total) {
                    // If single image dropped/selected, open crop modal right away
                    if (total === 1) {
                        openCropModalForGallery($('#' + cardId), dataUrl, file.name);
                    } else if (typeof Swal !== 'undefined') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'info',
                            title: `${total} gallery images queued. Click 'Crop & Resize' to adjust any photo.`
                        });
                    }
                }
            };
            reader.readAsDataURL(file);
        });
    }

    function updateStagedCount() {
        const count = $('#galleryStagedGrid .gallery-staged-card').length;
        $('#stagedCount').text(count);
        if (count > 0) {
            $('#galleryStagedSection').removeClass('d-none');
        } else {
            $('#galleryStagedSection').addClass('d-none');
        }
    }

    // Expose helpers globally
    window.openCropModalForGallery = openCropModalForGallery;
    window.handleGalleryFiles = handleGalleryFiles;

})(jQuery);
