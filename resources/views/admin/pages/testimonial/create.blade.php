@extends('admin.layouts.inner')

@section('site_title', 'Add Testimonial')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-chat-quote text-primary me-2"></i> Add Testimonial
                </h1>
                <p class="page-header-subtitle">Add a customer review or client appreciation note.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.testimonial.index') }}">Testimonials</a></li>
                    <li class="breadcrumb-item active">Add Testimonial</li>
                </ol>
            </div>
        </div>

        @include('admin.flash-msg')

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-star text-warning"></i> Client Review Details
                        </h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['url' => route('admin.testimonial.store'), 'method' => 'POST']) }}
                            <div class="mb-3">
                                {{ Form::label('name', 'Client / Customer Name', ['class' => 'form-label']) }}
                                {{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'e.g. Johnathan Smith', 'required' => 'required']) }}
                            </div>

                            <div class="mb-4">
                                {{ Form::label('remark', 'Testimonial Remark / Feedback', ['class' => 'form-label']) }}
                                {{ Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter the feedback provided by the client...', 'required' => 'required']) }}
                            </div>

                            <hr class="my-4">

                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('admin.testimonial.index') }}" class="btn btn-light border px-4">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle-fill me-1"></i> Save Testimonial
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
