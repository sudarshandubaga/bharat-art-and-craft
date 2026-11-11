@extends('admin.layouts.inner')

@section('site_title', 'Edit Wood — ' . $wood->name)

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-tree text-primary me-2"></i> Edit Wood
                </h1>
                <p class="page-header-subtitle">Update wood details.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.wood.index') }}">Woods</a></li>
                    <li class="breadcrumb-item active">Edit Wood</li>
                </ol>
            </div>
        </div>

        {{ Form::model($wood, [
            'route' => ['admin.wood.update', $wood->id],
            'method' => 'PUT',
            'novalidate' => true
        ]) }}

        @include('admin.pages.wood.form')

        {{ Form::close() }}
    </div>
</main>
@endsection
