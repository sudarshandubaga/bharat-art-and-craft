@extends('admin.layouts.inner')

@section('site_title', 'Inquiry Details #' . ($order->id ?? ''))

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-bag-check text-primary me-2"></i> Inquiry Details #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </h1>
                <p class="page-header-subtitle">Submitted by <strong>{{ $order->name }}</strong> on {{ $order->created_at ? $order->created_at->format('M d, Y h:i A') : 'N/A' }}.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.quotation.create', ['order_id' => $order->id]) }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-plus me-1"></i> Create Quotation
                </a>
                <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to All Inquiries
                </a>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">
                <!-- Customer Details Card -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-person-lines-fill text-primary"></i> Customer Contact Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Customer Name</label>
                                <div class="fs-5 fw-bold text-dark">{{ $order->name }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Date Received</label>
                                <div class="fs-6 text-dark">{{ $order->created_at ? $order->created_at->format('l, F d, Y - h:i A') : 'N/A' }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Email Address</label>
                                <div>
                                    <a href="mailto:{{ $order->email }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-envelope me-1"></i> {{ $order->email }}
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Phone Number</label>
                                <div>
                                    <a href="tel:{{ $order->phone }}" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-telephone me-1"></i> {{ $order->phone }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div>
                            <label class="text-muted small fw-bold text-uppercase d-block mb-2">Message / Inquiry Details</label>
                            <div class="p-3 bg-light rounded-3 border text-dark" style="min-height: 120px; line-height: 1.6; white-space: pre-wrap;">{{ $order->message ?? 'No additional notes provided by customer.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection