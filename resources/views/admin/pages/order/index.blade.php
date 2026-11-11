@extends('admin.layouts.inner')

@section('site_title', 'Customer Orders & Inquiries')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-bag-check text-primary me-2"></i> Orders & Customer Inquiries
                </h1>
                <p class="page-header-subtitle">Review incoming purchase inquiries and messages from prospective buyers.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div>
        </div>

        @include('admin.flash-msg')

        <!-- Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="fw-bold text-dark">
                        Total Inquiries: <span class="badge bg-primary rounded-pill">{{ $orders->total() }}</span>
                    </span>
                </div>

                <div class="small text-muted">
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} entries
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Inquiry #</th>
                                <th>Customer Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Message / Note</th>
                                <th>Date Received</th>
                                <th class="text-end" style="width: 170px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $index => $rec)
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-primary border fw-bold">
                                            #{{ str_pad($rec->id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $rec->name }}</div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $rec->email }}" class="text-decoration-none">
                                            <i class="bi bi-envelope me-1"></i> {{ $rec->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $rec->phone }}" class="text-decoration-none text-muted">
                                            <i class="bi bi-telephone me-1"></i> {{ $rec->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block text-muted" style="max-width: 280px;" title="{{ $rec->message }}">
                                            {{ $rec->message ?? 'No note provided' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="small text-muted">
                                            {{ $rec->created_at ? $rec->created_at->format('M d, Y h:i A') : 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1 justify-content-end">
                                            <a href="{{ route('admin.quotation.create', ['order_id' => $rec->id]) }}" class="btn btn-sm btn-outline-success" title="Create Quotation from this Order">
                                                <i class="bi bi-file-earmark-plus me-1"></i> Quote
                                            </a>
                                            <a href="{{ route('admin.order.show', [$rec->id]) }}" class="btn btn-sm btn-outline-primary" title="View Full Details">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                        <p class="mb-0 fw-bold">No customer orders or inquiries found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($orders->hasPages())
                <div class="card-footer bg-white py-3 border-top d-flex justify-content-center">
                    {{ $orders->links("pagination::bootstrap-5") }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection