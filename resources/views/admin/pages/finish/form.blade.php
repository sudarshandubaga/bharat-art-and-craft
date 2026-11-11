@include('admin.flash-msg')

<div class="row g-4 justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-brush text-primary"></i> Finish Details
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{ Form::label('name', 'Finish Name', ['class' => 'form-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control form-control-lg title', 'placeholder' => 'e.g. Natural Teak Polish, Dark Walnut, etc.', 'data-target' => '#slug', 'required' => 'required']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('slug', 'URL Slug', ['class' => 'form-label']) }}
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted small"><i class="bi bi-link-45deg"></i></span>
                        {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'auto-generated-slug']) }}
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="{{ route('admin.finish.index') }}" class="btn btn-light border px-4">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ !empty($finish->id) ? 'Update Finish' : 'Save Finish' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
