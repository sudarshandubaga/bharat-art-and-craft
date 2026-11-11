@extends('admin.layouts.inner')

@section('site_title', 'Add New Product')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-plus-circle text-primary me-2"></i> Add New Product
                </h1>
                <p class="page-header-subtitle">Create and publish a new handcrafted product to the catalog.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>
        </div>

        {{ Form::open([
            'url' => route('admin.product.store'), 
            'files' => true,
            'novalidate' => true,
        ]) }}

        @include('admin.pages.product.form')

        {{ Form::close() }}
    </div>
</main>
@endsection