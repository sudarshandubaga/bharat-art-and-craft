@extends('admin.layouts.inner')

@section('site_title', 'Edit FAQ')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Edit FAQ
                </h1>
                <p class="page-header-subtitle">Update question details and answers for your customers.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">FAQs</a></li>
                    <li class="breadcrumb-item active">Edit FAQ</li>
                </ol>
            </div>
        </div>

        @include('admin.flash-msg')

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-question-circle text-primary me-1"></i> Update FAQ Content
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        {{ Form::model($faq, ['url' => route('admin.faq.update', [$faq->id]), 'method' => 'PUT']) }}
                            <div class="mb-3">
                                {{ Form::label('question', 'Question Title', ['class' => 'form-label fw-semibold text-dark']) }}
                                {{ Form::text('question', $faq->question, ['class' => 'form-control form-control-lg', 'placeholder' => 'Enter the question...', 'required' => 'required']) }}
                                @error('question')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                {{ Form::label('answer', 'Detailed Answer', ['class' => 'form-label fw-semibold text-dark']) }}
                                {{ Form::textarea('answer', $faq->answer, ['class' => 'form-control', 'rows' => 6, 'placeholder' => 'Write a comprehensive answer...', 'required' => 'required']) }}
                                @error('answer')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    {{ Form::label('sort_order', 'Sort / Display Order', ['class' => 'form-label fw-semibold text-dark']) }}
                                    {{ Form::number('sort_order', $faq->sort_order, ['class' => 'form-control', 'min' => 0, 'placeholder' => '0']) }}
                                    <small class="text-muted">Lower numbers appear first on the FAQ page.</small>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('status', 'Publication Status', ['class' => 'form-label fw-semibold text-dark']) }}
                                    {{ Form::select('status', ['active' => 'Active / Published', 'inactive' => 'Inactive / Draft'], $faq->status, ['class' => 'form-select']) }}
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('admin.faq.index') }}" class="btn btn-light border px-4">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle-fill me-1"></i> Update FAQ
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
