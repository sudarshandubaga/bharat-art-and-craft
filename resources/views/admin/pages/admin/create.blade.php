@extends('admin.layouts.inner')

@section('site_title', 'Add New Administrator')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-shield-plus text-primary me-2"></i> Add New Administrator
                </h1>
                <p class="page-header-subtitle">Create a new administrative user with backend system access.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">Admins</a></li>
                    <li class="breadcrumb-item active">Add Admin</li>
                </ol>
            </div>
        </div>

        {{ Form::open(['url' => route('admin.admin.store'), 'novalidate' => true]) }}
        @include('admin.pages.admin.form')
        {{ Form::close() }}
    </div>
</main>
@endsection
