@extends('admin.layouts.inner')

@section('site_title', 'Create Quotation')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-file-earmark-plus text-primary me-2"></i> Create Export Quotation
                </h1>
                <p class="page-header-subtitle">Build a bespoke container quotation sheet for wholesale or retail clients.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.quotation.index') }}">Quotations</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>

        @include('admin.flash-msg')

        {{ Form::open(['route' => 'admin.quotation.store', 'method' => 'POST', 'id' => 'quotationForm']) }}
            @include('admin.pages.quotation.form')
        {{ Form::close() }}

    </div>
</main>
@endsection
