@include('admin.flash-msg')

<div class="row g-4">
    <!-- Left Column: Article Content -->
    <div class="col-lg-8">
        <!-- Card 1: Article Details -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-journal-text text-primary"></i> Article Content
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('title', 'Blog Title', ['class' => 'form-label']) }}
                    {{ Form::text('title', null, ['class' => 'form-control form-control-lg title', 'placeholder' => 'Enter blog article title', 'data-target' => '#slug', 'required' => 'required']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('slug', 'URL Slug', ['class' => 'form-label']) }}
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted small"><i class="bi bi-link-45deg"></i></span>
                        {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'auto-generated-slug']) }}
                    </div>
                </div>

                <div class="mb-0">
                    {{ Form::label('excerpt', 'Article Body / Excerpt', ['class' => 'form-label']) }}
                    {{ Form::textarea('excerpt', null, ['class' => 'form-control myEditor', 'rows' => 12, 'placeholder' => 'Write your blog post here...']) }}
                </div>
            </div>
        </div>

        <!-- Card 2: SEO Meta Data -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-search text-primary"></i> SEO Meta Data
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('meta_title', 'Meta Title', ['class' => 'form-label']) }}
                    {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'SEO Title']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('meta_keywords', 'Meta Keywords', ['class' => 'form-label']) }}
                    {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'furniture trends, wooden crafts, etc.']) }}
                </div>
                <div class="mb-0">
                    {{ Form::label('meta_description', 'Meta Description', ['class' => 'form-label']) }}
                    {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Summary for search engines...']) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Featured Image with Cropper & Publishing -->
    <div class="col-lg-4">
        <!-- Card 3: Featured Image -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-image text-primary"></i> Featured Cover Image
                </h5>
            </div>
            <div class="card-body">
                @include('admin.components.image-dropzone', [
                    'name' => 'image',
                    'label' => 'Cover Image',
                    'current' => !empty($blog->image) ? asset('images/blogs/' . $blog->image) : null,
                    'aspectRatio' => '4/3',
                    'help' => 'Landscape ratio (4:3 or 16:9) recommended. JPG, PNG or WebP.'
                ])
            </div>
        </div>

        <!-- Card 4: Publishing Status -->
        <div class="card mb-4 shadow-sm border-primary-subtle">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-send-check text-success"></i> Publishing
                </h5>
            </div>
            <div class="card-body">
                @if(!empty($blog->id))
                    <div class="small text-muted mb-3 d-flex flex-column gap-1">
                        <div><strong>Published:</strong> {{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'N/A' }}</div>
                        <div><strong>Last Updated:</strong> {{ $blog->updated_at ? $blog->updated_at->format('M d, Y') : 'N/A' }}</div>
                    </div>
                @endif

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ !empty($blog->id) ? 'Update Article' : 'Publish Article' }}
                    </button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-light border">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
