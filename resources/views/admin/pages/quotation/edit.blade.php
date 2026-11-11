@extends('admin.layouts.inner')

@section('site_title', 'Edit Quotation ' . ($quotation->quotation_no ?? ''))

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Edit Quotation #{{ $quotation->quotation_no }}
                </h1>
                <p class="page-header-subtitle">Update pricing, container loadability, or customer specifications.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.quotation.print', $quotation->id) }}" target="_blank" class="btn btn-outline-dark">
                    <i class="bi bi-printer me-1"></i> Print View
                </a>
                <a href="{{ route('admin.quotation.show', $quotation->id) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-eye me-1"></i> View Details
                </a>
            </div>
        </div>

        @include('admin.flash-msg')

        {{ Form::model($quotation, ['route' => ['admin.quotation.update', $quotation->id], 'method' => 'PUT', 'id' => 'quotationForm']) }}
            @include('admin.pages.quotation.form')
        {{ Form::close() }}

    </div>
</main>
@endsection
