@extends('admin.layouts.inner')

@section('site_title', 'Quotations')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-file-earmark-spreadsheet text-primary me-2"></i> Quotations Management
                </h1>
                <p class="page-header-subtitle">Create, review, and print export furniture quotations with container load calculations.</p>
            </div>
            <div>
                <a href="{{ route('admin.quotation.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Create Quotation
                </a>
            </div>
        </div>

        @include('admin.flash-msg')

        <!-- Search & Filter Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    {{ Form::open(['method' => 'GET', 'class' => 'd-flex flex-wrap align-items-center gap-2 flex-grow-1']) }}
                    <div class="input-group" style="max-width: 380px;">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        {{ Form::search('search_by_keyword', request('search_by_keyword'), ['class' => 'form-control border-start-0 ps-0', 'placeholder' => 'Search by Quote #, Customer, or Email...']) }}
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    <div style="min-width: 150px;">
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">All Statuses</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    @if(request('search_by_keyword') || request('status'))
                        <a href="{{ route('admin.quotation.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Clear Filter
                        </a>
                    @endif
                    {{ Form::close() }}

                    <div class="d-flex align-items-center gap-2">
                        @if(request()->get('type') && request()->get('type') === 'trash')
                            <a href="{{ route('admin.quotation.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Active Quotations
                            </a>
                            <span class="badge bg-danger px-3 py-2">
                                <i class="bi bi-trash3 me-1"></i> Trash View
                            </span>
                        @else
                            <a href="{{ route('admin.quotation.index', ['type' => 'trash']) }}" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash3 me-1"></i> View Trash
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-bold text-dark">
                        Total Quotations: <span class="badge bg-primary rounded-pill">{{ $quotations->total() }}</span>
                    </span>

                    <div class="select-checked d-none align-items-center gap-2">
                        <span class="badge bg-dark text-white px-2 py-1 select-checked-count">Selection Active</span>
                        @if(request()->get('type') && request()->get('type') === 'trash')
                            <button type="button" class="btn btn-sm btn-success multi-delete py-1" data-action="restore">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Restore Selected
                            </button>
                            <button type="button" class="btn btn-sm btn-danger multi-delete py-1" data-action="permanent-delete">
                                <i class="bi bi-trash3-fill me-1"></i> Permanent Delete
                            </button>
                        @else
                            <button type="button" class="btn btn-sm btn-danger multi-delete py-1">
                                <i class="bi bi-trash3 me-1"></i> Delete Selected
                            </button>
                        @endif
                    </div>
                </div>

                <div class="small text-muted">
                    Showing {{ $quotations->firstItem() ?? 0 }} to {{ $quotations->lastItem() ?? 0 }} of {{ $quotations->total() }} entries
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    {{ Form::open(['route' => 'admin.quotation.multiDestroy', 'method' => 'delete', 'id' => 'formMultiDelete']) }}
                    <input type="hidden" name="action" id="multiAction" value="">
                    
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">
                                    <input type="checkbox" class="form-check-input select-all" title="Select all on this page">
                                </th>
                                <th style="width: 140px;">Quotation #</th>
                                <th>Customer / Company</th>
                                <th class="text-center" style="width: 90px;">Products</th>
                                <th style="width: 110px;">Total CBM</th>
                                <th style="width: 120px;">Est. Amount</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 110px;">Date</th>
                                <th class="text-end" style="width: 190px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quotations as $quote)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="check[]" value="{{ $quote->id }}" class="form-check-input select-item">
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary font-monospace">{{ $quote->quotation_no }}</div>
                                        @if($quote->order_id)
                                            <span class="badge bg-light text-secondary border small" style="font-size: 0.7rem;">
                                                From Order #{{ $quote->order_id }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $quote->customer_name }}</div>
                                        @if($quote->customer_company)
                                            <div class="small text-muted fw-semibold">{{ $quote->customer_company }}</div>
                                        @endif
                                        <div class="small text-muted">
                                            <i class="bi bi-envelope me-1"></i> {{ $quote->customer_email }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
                                            {{ $quote->items->count() }} {{ Str::plural('item', $quote->items->count()) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-primary border fw-semibold">
                                            {{ number_format((float)$quote->total_cbm, 2) }} CBM
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">
                                            ${{ number_format((float)$quote->total_amount, 2) }}
                                        </div>
                                        <div class="small text-muted" style="font-size: 0.72rem;">{{ $quote->currency ?? 'USD' }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $statusBadge = match($quote->status) {
                                                'approved' => 'bg-success',
                                                'sent' => 'bg-info text-dark',
                                                'rejected' => 'bg-danger',
                                                default => 'bg-warning text-dark',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusBadge }} text-capitalize px-2 py-1">
                                            {{ $quote->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small text-dark fw-semibold">
                                            {{ $quote->date ? $quote->date->format('M d, Y') : 'N/A' }}
                                        </div>
                                        @if($quote->valid_until)
                                            <div class="text-muted" style="font-size: 0.72rem;">
                                                Valid till {{ $quote->valid_until->format('M d') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if(request()->get('type') && request()->get('type') === 'trash')
                                            <button type="button" class="btn btn-sm btn-outline-success restore-item" data-id="{{ $quote->id }}" title="Restore">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger permanent-delete-item" data-id="{{ $quote->id }}" title="Permanent Delete">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        @else
                                            <div class="btn-group btn-group-sm">
                                                <!-- Print Button -->
                                                <a href="{{ route('admin.quotation.print', $quote->id) }}" target="_blank" class="btn btn-outline-dark" title="Print Format / PDF">
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                                <!-- View Details -->
                                                <a href="{{ route('admin.quotation.show', $quote->id) }}" class="btn btn-outline-primary" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <!-- Edit -->
                                                <a href="{{ route('admin.quotation.edit', $quote->id) }}" class="btn btn-outline-secondary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <!-- Delete -->
                                                <button type="button" class="btn btn-outline-danger delete-item" data-id="{{ $quote->id }}" title="Move to Trash">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="bi bi-file-earmark-spreadsheet fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                        <p class="mb-1 fw-bold">No quotations found.</p>
                                        <p class="small text-muted mb-3">Create your first export furniture quotation or convert an incoming order.</p>
                                        <a href="{{ route('admin.quotation.create') }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-plus-lg me-1"></i> Create Quotation Now
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ Form::close() }}
                </div>
            </div>

            @if($quotations->hasPages())
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-end">
                        {{ $quotations->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>

    </div>
</main>

<!-- Single Delete Form -->
{{ Form::open(['route' => ['admin.quotation.destroy', 0], 'method' => 'delete', 'id' => 'singleActionForm', 'class' => 'd-none']) }}
<input type="hidden" name="action" id="singleAction" value="">
{{ Form::close() }}

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.querySelector('.select-all');
    const selectItems = document.querySelectorAll('.select-item');
    const selectChecked = document.querySelector('.select-checked');
    const countBadge = document.querySelector('.select-checked-count');
    const singleForm = document.getElementById('singleActionForm');
    const singleActionInput = document.getElementById('singleAction');

    function updateSelection() {
        const checked = document.querySelectorAll('.select-item:checked');
        if (checked.length > 0) {
            selectChecked.classList.remove('d-none');
            selectChecked.classList.add('d-flex');
            countBadge.textContent = checked.length + ' Selected';
        } else {
            selectChecked.classList.add('d-none');
            selectChecked.classList.remove('d-flex');
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            selectItems.forEach(item => item.checked = selectAll.checked);
            updateSelection();
        });
    }

    selectItems.forEach(item => {
        item.addEventListener('change', updateSelection);
    });

    // Multi delete
    document.querySelectorAll('.multi-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.getAttribute('data-action') || '';
            const actionText = action === 'permanent-delete' ? 'permanently delete' : (action === 'restore' ? 'restore' : 'trash');
            
            if (confirm(`Are you sure you want to ${actionText} the selected quotations?`)) {
                document.getElementById('multiAction').value = action;
                document.getElementById('formMultiDelete').submit();
            }
        });
    });

    // Single Actions
    document.querySelectorAll('.delete-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('Are you sure you want to move this quotation to trash?')) {
                singleForm.action = singleForm.action.replace(/\/quotation\/\d+/, '/quotation/' + id);
                singleActionInput.value = '';
                singleForm.submit();
            }
        });
    });

    document.querySelectorAll('.restore-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('Restore this quotation?')) {
                singleForm.action = singleForm.action.replace(/\/quotation\/\d+/, '/quotation/' + id);
                singleActionInput.value = 'restore';
                singleForm.submit();
            }
        });
    });

    document.querySelectorAll('.permanent-delete-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('Permanently delete this quotation? This cannot be undone!')) {
                singleForm.action = singleForm.action.replace(/\/quotation\/\d+/, '/quotation/' + id);
                singleActionInput.value = 'permanent-delete';
                singleForm.submit();
            }
        });
    });
});
</script>
@endsection
