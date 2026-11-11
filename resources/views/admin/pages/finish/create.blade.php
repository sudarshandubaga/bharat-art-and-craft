@extends('admin.layouts.inner')

@section('site_title', 'Add New Finish')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-brush text-primary me-2"></i> Add Finish
                </h1>
                <p class="page-header-subtitle">Create a new wood finish option for products.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.finish.index') }}">Finishes</a></li>
                    <li class="breadcrumb-item active">Add Finish</li>
                </ol>
            </div>
        </div>

        {{ Form::open([
            'url' => route('admin.finish.store'),
            'novalidate' => true
        ]) }}

        @include('admin.pages.finish.form')

        {{ Form::close() }}
    </div>
</main>
@endsection
