@extends('admin.layouts.inner')

@section('site_title', 'Edit Slide - ' . ($slider->title ?? ''))

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Edit Homepage Slide
                </h1>
                <p class="page-header-subtitle">Update slide details and banner image.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Sliders</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>

        {{ Form::model($slider, [
            'url' => route('admin.slider.update', [$slider->id]),
            'files' => true,
            'method' => 'PUT',
            'novalidate' => true
        ]) }}

        @include('admin.pages.slider.form')

        {{ Form::close() }}
    </div>
</main>
@endsection