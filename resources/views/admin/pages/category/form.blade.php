@include('admin.flash-msg')

<div class="row g-4 justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-diagram-3 text-primary"></i> Category Details
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('title', 'Category Title', ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control form-control-lg title', 'placeholder' => 'e.g. Wooden Dining Tables', 'data-target' => '#slug', 'required' => 'required']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('slug', 'URL Slug', ['class' => 'form-label']) }}
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted small"><i class="bi bi-link-45deg"></i></span>
                        {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'auto-generated-slug']) }}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        {{ Form::label('description', 'Category Description', ['class' => 'form-label mb-0']) }}
                        <span class="badge bg-light text-muted border">Optional</span>
                    </div>
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Write a brief description or overview for this product category...']) }}
                    <div class="form-text">Displayed on category collection pages and for SEO contextual relevance.</div>
                </div>
            </div>
        </div>

        <!-- SEO Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-search text-primary"></i> Search Engine Optimization (SEO)
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('seo_title', 'SEO Meta Title', ['class' => 'form-label']) }}
                    {{ Form::text('seo_title', null, ['class' => 'form-control', 'placeholder' => 'e.g. Handcrafted Wooden Dining Tables | Bharat Art & Craft']) }}
                    <div class="form-text">Recommended: 50-60 characters.</div>
                </div>

                <div class="mb-3">
                    {{ Form::label('seo_keywords', 'SEO Meta Keywords', ['class' => 'form-label']) }}
                    {{ Form::text('seo_keywords', null, ['class' => 'form-control', 'placeholder' => 'dining tables, solid wood, sheesham wood tables, export handicrafts']) }}
                    <div class="form-text">Comma-separated keywords for search engines.</div>
                </div>

                <div class="mb-0">
                    {{ Form::label('seo_description', 'SEO Meta Description', ['class' => 'form-label']) }}
                    {{ Form::textarea('seo_description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Brief meta snippet that appears in Google search engine result snippets.']) }}
                    <div class="form-text">Recommended: 150-160 characters.</div>
                </div>
            </div>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-light border px-4">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ !empty($category->id) ? 'Update Category' : 'Save Category' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
