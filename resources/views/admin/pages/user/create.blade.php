@extends('admin.layouts.inner')

@section('site_title', 'Add New User')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-person-plus text-primary me-2"></i> Add New User
                </h1>
                <p class="page-header-subtitle">Create a new customer account or staff profile.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>
            </div>
        </div>

        {{ Form::open(['url' => route('admin.user.store'), 'novalidate' => true]) }}
        @include('admin.pages.user.form')
        {{ Form::close() }}
    </div>
</main>
@endsection
