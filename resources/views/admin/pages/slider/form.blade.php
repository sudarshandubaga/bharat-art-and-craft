@include('admin.flash-msg')

<div class="row g-4">
    <!-- Left Column: Content -->
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-images text-primary"></i> Slide Content
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('title', 'Slide Headline / Title', ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'e.g. Handcrafted Wooden Perfection', 'required' => 'required']) }}
                </div>

                <div class="mb-0">
                    {{ Form::label('description', 'Subtitle / Short Description', ['class' => 'form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter a captivating caption for the slider banner...']) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Banner Image & Publishing -->
    <div class="col-lg-5">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-image text-primary"></i> Banner Slide Image
                </h5>
            </div>
            <div class="card-body">
                @include('admin.components.image-dropzone', [
                    'name' => 'image',
                    'label' => 'Banner Image',
                    'current' => !empty($slider->image) ? asset('images/sliders/' . $slider->image) : null,
                    'aspectRatio' => '16/9',
                    'help' => 'Widescreen ratio (16:9) recommended. e.g. 1920x1080px or 1280x720px.'
                ])
            </div>
        </div>

        <div class="card mb-4 shadow-sm border-primary-subtle">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-send-check text-success"></i> Publishing
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ !empty($slider->id) ? 'Update Slide' : 'Save Slide' }}
                    </button>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-light border">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>