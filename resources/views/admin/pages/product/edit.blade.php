@extends('admin.layouts.inner')

@section('site_title', 'Edit Product - ' . ($product->title ?? ''))

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Edit Product
                </h1>
                <p class="page-header-subtitle">Update details, images, and specifications for <strong>{{ $product->title }}</strong>.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>

        {{ Form::model($product, [
            'url' => route('admin.product.update', [$product->id]),
            'files' => true,
            'method' => 'PUT',
            'novalidate' => true,
        ]) }}

        @include('admin.pages.product.form')

        {{ Form::close() }}
    </div>
</main>
@endsection