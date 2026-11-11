@extends('admin.layouts.inner')

@section('site_title', 'Add New Page')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-file-earmark-plus text-primary me-2"></i> Add New Page
                </h1>
                <p class="page-header-subtitle">Create a static page like About Us, Privacy Policy, or Terms.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">Pages</a></li>
                    <li class="breadcrumb-item active">Add Page</li>
                </ol>
            </div>
        </div>

        {{ Form::open([
            'url' => route('admin.page.store'),
            'files' => true,
            'novalidate' => true
        ]) }}

        @include('admin.pages.page.form')

        {{ Form::close() }}
    </div>
</main>
@endsection