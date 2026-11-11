<!-- Image Crop Modal Popup -->
<div class="modal fade" id="imageCropModal" tabindex="-1" aria-labelledby="imageCropModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <!-- Modal Header -->
            <div class="modal-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="modal-title fw-bold text-white mb-0" id="imageCropModalLabel">
                        <i class="bi bi-crop text-primary me-2"></i> Crop & Adjust Image
                    </h5>
                    <small class="text-white-50" id="cropModalFilename">image.jpg</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnModalCloseX"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 p-lg-4 bg-light">
                <!-- Toolbar: Aspect Ratios & Transform Controls -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                    <!-- Aspect Ratio Presets -->
                    <div class="cropper-toolbar-group">
                        <span class="text-muted small fw-bold px-2"><i class="bi bi-aspect-ratio me-1"></i> Ratio:</span>
                        <button type="button" class="cropper-tool-btn cropper-aspect-btn active" data-ratio="free">Free</button>
                        <button type="button" class="cropper-tool-btn cropper-aspect-btn" data-ratio="1/1">1:1 Square</button>
                        <button type="button" class="cropper-tool-btn cropper-aspect-btn" data-ratio="4/3">4:3 Card</button>
                        <button type="button" class="cropper-tool-btn cropper-aspect-btn" data-ratio="16/9">16:9 Banner</button>
                        <button type="button" class="cropper-tool-btn cropper-aspect-btn" data-ratio="3/2">3:2 Photo</button>
                    </div>

                    <!-- Drag Mode Toggle (Crop Selection Box vs Pan Move) -->
                    <div class="cropper-toolbar-group">
                        <button type="button" class="cropper-tool-btn cropper-mode-btn active" id="btnModeCrop" title="Crop Mode - Drag to select or resize crop box">
                            <i class="bi bi-crop"></i> Crop Box
                        </button>
                        <button type="button" class="cropper-tool-btn cropper-mode-btn" id="btnModeMove" title="Move Mode - Drag to pan image canvas">
                            <i class="bi bi-arrows-move"></i> Pan
                        </button>
                    </div>

                    <!-- Rotate, Flip & Zoom Tools -->
                    <div class="cropper-toolbar-group">
                        <button type="button" class="cropper-tool-btn" id="btnCropRotateLeft" title="Rotate Left 90°">
                            <i class="bi bi-arrow-counterclockwise"></i> -90°
                        </button>
                        <button type="button" class="cropper-tool-btn" id="btnCropRotateRight" title="Rotate Right 90°">
                            <i class="bi bi-arrow-clockwise"></i> +90°
                        </button>
                        <button type="button" class="cropper-tool-btn" id="btnCropFlipH" title="Flip Horizontal">
                            <i class="bi bi-symmetry-vertical"></i> Flip
                        </button>
                        <button type="button" class="cropper-tool-btn" id="btnCropZoomIn" title="Zoom In">
                            <i class="bi bi-zoom-in"></i>
                        </button>
                        <button type="button" class="cropper-tool-btn" id="btnCropZoomOut" title="Zoom Out">
                            <i class="bi bi-zoom-out"></i>
                        </button>
                        <button type="button" class="cropper-tool-btn text-danger" id="btnCropReset" title="Reset Crop">
                            <i class="bi bi-arrow-repeat"></i> Reset
                        </button>
                    </div>
                </div>

                <!-- Crop Canvas & Preview Area -->
                <div class="row g-3 align-items-stretch">
                    <!-- Main Canvas Column -->
                    <div class="col-lg-9">
                        <div class="cropper-workspace shadow-sm">
                            <img id="cropModalImage" src="" alt="Crop image target" crossorigin="anonymous">
                        </div>
                    </div>

                    <!-- Live Preview & Info Column -->
                    <div class="col-lg-3">
                        <div class="bg-white p-3 rounded-3 border shadow-sm h-100 d-flex flex-column justify-content-between text-center">
                            <div>
                                <label class="form-label text-muted small fw-bold d-block mb-3">
                                    <i class="bi bi-eye me-1"></i> LIVE PREVIEW
                                </label>
                                <div class="crop-preview-box"></div>
                                <div class="mt-3">
                                    <span class="badge bg-primary text-white fs-6 py-2 px-3 shadow-sm" id="cropDimensions">-- × -- px</span>
                                </div>
                            </div>
                            <div class="p-2 bg-light rounded text-muted mt-3" style="font-size: 0.76rem;">
                                <i class="bi bi-info-circle text-primary me-1"></i>
                                Adjust the crop box on the left. The image will be converted and optimized to WebP automatically.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white px-4 py-3 border-top d-flex justify-content-between">
                <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal" id="btnModalCancel">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary px-3" id="btnSkipCrop">
                        <i class="bi bi-check2 me-1"></i> Use Original Without Crop
                    </button>
                    <button type="button" class="btn btn-primary px-4 fw-bold shadow-sm" id="btnApplyCrop">
                        <i class="bi bi-check-lg me-1"></i> Crop & Apply Image
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
