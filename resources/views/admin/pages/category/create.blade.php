@extends('admin.layouts.inner')

@section('site_title', 'Add New Category')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-diagram-3 text-primary me-2"></i> Add Category
                </h1>
                <p class="page-header-subtitle">Create a new product category.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active">Add Category</li>
                </ol>
            </div>
        </div>

        {{ Form::open([
            'url' => route('admin.category.store'),
            'novalidate' => true
        ]) }}

        @include('admin.pages.category.form')

        {{ Form::close() }}
    </div>
</main>
@endsection