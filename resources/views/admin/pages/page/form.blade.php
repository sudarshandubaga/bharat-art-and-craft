@include('admin.flash-msg')

<div class="row g-4">
    <!-- Left Column: Content -->
    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-file-earmark-text text-primary"></i> Page Details
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('title', 'Page Title', ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control form-control-lg title', 'placeholder' => 'e.g. About Our Craftsmanship', 'data-target' => '#slug', 'required' => 'required']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('slug', 'URL Slug', ['class' => 'form-label']) }}
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted small"><i class="bi bi-link-45deg"></i></span>
                        {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'about-us']) }}
                    </div>
                </div>

                <div class="mb-0">
                    {{ Form::label('excerpt', 'Page Content', ['class' => 'form-label']) }}
                    {{ Form::textarea('excerpt', null, ['class' => 'form-control myEditor', 'rows' => 10, 'placeholder' => 'Enter page content...']) }}
                </div>
            </div>
        </div>

        <!-- SEO Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-search text-primary"></i> Page SEO Meta
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('meta_title', 'Meta Title', ['class' => 'form-label']) }}
                    {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'SEO Title']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('meta_keywords', 'Meta Keywords', ['class' => 'form-label']) }}
                    {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'keywords, separated, by, commas']) }}
                </div>
                <div class="mb-0">
                    {{ Form::label('meta_description', 'Meta Description', ['class' => 'form-label']) }}
                    {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'SEO description...']) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Image & Publishing -->
    <div class="col-lg-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-image text-primary"></i> Page Header Image
                </h5>
            </div>
            <div class="card-body">
                @include('admin.components.image-dropzone', [
                    'name' => 'image',
                    'label' => 'Banner Image',
                    'current' => !empty($page->image) ? asset('images/pages/' . $page->image) : null,
                    'aspectRatio' => '16/9',
                    'help' => 'Wide header banner ratio (16:9) recommended.'
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
                        {{ !empty($page->id) ? 'Update Page' : 'Save Page' }}
                    </button>
                    <a href="{{ route('admin.page.index') }}" class="btn btn-light border">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
