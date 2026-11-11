@extends('admin.layouts.inner')

@section('site_title', 'Quotation ' . ($quotation->quotation_no ?? ''))

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-file-earmark-check text-primary me-2"></i> Quotation Details: <span class="text-primary font-monospace">{{ $quotation->quotation_no }}</span>
                </h1>
                <p class="page-header-subtitle">
                    Created on {{ $quotation->created_at ? $quotation->created_at->format('M d, Y h:i A') : 'N/A' }} 
                    for <strong>{{ $quotation->customer_name }}</strong>.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.quotation.print', $quotation->id) }}" target="_blank" class="btn btn-dark shadow-sm">
                    <i class="bi bi-printer me-1"></i> Print / Export PDF
                </a>
                <a href="{{ route('admin.quotation.edit', $quotation->id) }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-pencil me-1"></i> Edit Quotation
                </a>
                <a href="{{ route('admin.quotation.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> All Quotations
                </a>
            </div>
        </div>

        @include('admin.flash-msg')

        <div class="row g-4">
            <!-- Left Info Cards -->
            <div class="col-lg-4">
                
                <!-- Customer Details Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0 fs-6 fw-bold">
                            <i class="bi bi-person-lines-fill text-primary me-2"></i> Customer Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="text-muted small fw-bold text-uppercase d-block">Client Name</span>
                            <div class="fs-5 fw-bold text-dark">{{ $quotation->customer_name }}</div>
                        </div>

                        @if($quotation->customer_company)
                            <div class="mb-3">
                                <span class="text-muted small fw-bold text-uppercase d-block">Company</span>
                                <div class="fw-semibold text-dark">{{ $quotation->customer_company }}</div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <span class="text-muted small fw-bold text-uppercase d-block">Email Address</span>
                            <div>
                                <a href="mailto:{{ $quotation->customer_email }}" class="text-decoration-none">
                                    <i class="bi bi-envelope me-1"></i> {{ $quotation->customer_email }}
                                </a>
                            </div>
                        </div>

                        @if($quotation->customer_phone)
                            <div class="mb-3">
                                <span class="text-muted small fw-bold text-uppercase d-block">Phone / WhatsApp</span>
                                <div>
                                    <a href="tel:{{ $quotation->customer_phone }}" class="text-decoration-none text-muted">
                                        <i class="bi bi-telephone me-1"></i> {{ $quotation->customer_phone }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($quotation->customer_address)
                            <div class="mb-3">
                                <span class="text-muted small fw-bold text-uppercase d-block">Destination / Address</span>
                                <div class="small text-muted">{{ $quotation->customer_address }}</div>
                            </div>
                        @endif

                        @if($quotation->order_id)
                            <div class="p-2 bg-light border rounded small d-flex align-items-center justify-content-between mt-3">
                                <span>Generated from Order:</span>
                                <a href="{{ route('admin.order.show', $quotation->order_id) }}" class="fw-bold text-primary">
                                    Order #{{ $quotation->order_id }} &rarr;
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quotation Meta Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0 fs-6 fw-bold">
                            <i class="bi bi-info-circle text-primary me-2"></i> Quotation Metadata
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted small">Quotation Date:</span>
                            <strong class="text-dark">{{ $quotation->date ? $quotation->date->format('M d, Y') : 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted small">Valid Until:</span>
                            <strong class="text-dark">{{ $quotation->valid_until ? $quotation->valid_until->format('M d, Y') : 'N/A' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom align-items-center">
                            <span class="text-muted small">Status:</span>
                            <span class="badge bg-primary text-capitalize px-2 py-1">{{ $quotation->status }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted small">Origin Atelier:</span>
                            <span class="text-dark fw-semibold">{{ $quotation->company_name }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted small">Currency:</span>
                            <span class="badge bg-light text-dark border">{{ $quotation->currency }}</span>
                        </div>
                    </div>
                </div>

                <!-- Terms & Notes -->
                @if($quotation->terms || $quotation->notes)
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title text-dark mb-0 fs-6 fw-bold">
                                <i class="bi bi-file-text text-primary me-2"></i> Commercial Terms
                            </h5>
                        </div>
                        <div class="card-body small text-muted">
                            {{ $quotation->terms ?? $quotation->notes }}
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right Column: Products Table -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                        <h5 class="card-title text-dark mb-0 fs-6 fw-bold">
                            <i class="bi bi-boxes text-primary me-2"></i> Quoted Products ({{ $quotation->items->count() }} Pieces)
                        </h5>
                        <span class="badge bg-light text-primary border">
                            {{ number_format((float)$quotation->total_cbm, 2) }} Total CBM
                        </span>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">Piece</th>
                                        <th>Product Name &amp; Code</th>
                                        <th>Material &amp; Finish</th>
                                        <th>Dimension</th>
                                        <th class="text-center">MOQ</th>
                                        <th class="text-end">Price USD</th>
                                        <th class="text-end">CBM</th>
                                        <th>Loadability</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotation->items as $idx => $item)
                                        @php
                                            $lineTotal = $item->moq * (float)$item->price_usd;
                                            $lineCbm = $item->moq * (float)$item->cbm;
                                        @endphp
                                        <tr>
                                            <td>
                                                <img src="{{ $item->image_url }}" alt="{{ $item->product_name }}" 
                                                     style="width: 54px; height: 54px; object-fit: cover; border-radius: 6px; border: 1px solid #e0d8cc;">
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $item->product_name }}</div>
                                                @if($item->product_code)
                                                    <span class="badge bg-light text-secondary border font-monospace small">
                                                        {{ $item->product_code }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="small fw-semibold text-dark">{{ $item->material ?? 'Solid Wood' }}</div>
                                                <div class="small text-muted">{{ $item->finish ?? 'Natural Polish' }}</div>
                                            </td>
                                            <td>
                                                <span class="small text-muted">{{ $item->dimension ?: 'Standard' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
                                                    {{ $item->moq }} pcs
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <div class="fw-bold text-dark">${{ number_format((float)$item->price_usd, 2) }}</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="small fw-semibold text-primary">{{ number_format((float)$item->cbm, 3) }} m³</div>
                                                <div class="text-muted" style="font-size: 0.72rem;">{{ number_format((float)$lineCbm, 2) }} total</div>
                                            </td>
                                            <td>
                                                <span class="small text-muted">{{ $item->loadability ?? 'N/A' }}</span>
                                            </td>
                                            <td class="text-end">
                                                <strong class="text-success">${{ number_format($lineTotal, 2) }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Card Footer with Totals -->
                    <div class="card-footer bg-light py-3 border-top">
                        <div class="row align-items-center g-3">
                            <div class="col-sm-4">
                                <div class="small text-muted">Total Quoted Pieces:</div>
                                <div class="fs-5 fw-bold text-dark">{{ $quotation->items->sum('moq') }} pcs</div>
                            </div>
                            <div class="col-sm-4">
                                <div class="small text-muted">Total Volume:</div>
                                <div class="fs-5 fw-bold text-primary">{{ number_format((float)$quotation->total_cbm, 2) }} CBM</div>
                                <div class="small text-muted" style="font-size: 0.75rem;">
                                    ~{{ min(100, round(((float)$quotation->total_cbm / 68) * 100)) }}% of 40' HQ container
                                </div>
                            </div>
                            <div class="col-sm-4 text-sm-end">
                                <div class="small text-muted">Total Estimated Amount:</div>
                                <div class="fs-4 fw-bold text-success">${{ number_format((float)$quotation->total_amount, 2) }} USD</div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Print CTA Banner -->
                <div class="p-4 bg-white border rounded shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Export Ready Quotation Presentation</h6>
                        <p class="small text-muted mb-0">Generate the full formal multi-page PDF/print format with standalone product pages.</p>
                    </div>
                    <a href="{{ route('admin.quotation.print', $quotation->id) }}" target="_blank" class="btn btn-dark shadow-sm px-4">
                        <i class="bi bi-printer me-2"></i> Open Print Format
                    </a>
                </div>

            </div>
        </div>

    </div>
</main>
@endsection
