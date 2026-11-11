@extends('admin.layouts.inner')

@section('site_title', 'Finishes')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-brush text-primary me-2"></i> Finishes
                </h1>
                <p class="page-header-subtitle">Manage wood finishes, polishes, and surface treatments.</p>
            </div>
            <div>
                <a href="{{ route('admin.finish.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg"></i> Add New Finish
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
                        {{ Form::search('search_by_keyword', request('search_by_keyword'), ['class' => 'form-control border-start-0 ps-0', 'placeholder' => 'Search by finish name...']) }}
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    @if(request('search_by_keyword'))
                        <a href="{{ route('admin.finish.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    @endif
                    {{ Form::close() }}

                    <div class="d-flex align-items-center gap-2">
                        @if(request()->get('type') && request()->get('type') === 'trash')
                            <a href="{{ route('admin.finish.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Active Finishes
                            </a>
                            <span class="badge bg-danger px-3 py-2">
                                <i class="bi bi-trash3 me-1"></i> Trash View
                            </span>
                        @else
                            <a href="{{ route('admin.finish.index', ['type' => 'trash']) }}" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash3 me-1"></i> View Trash
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-bold text-dark">
                        Total Finishes: <span class="badge bg-primary rounded-pill">{{ $finishes->total() }}</span>
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
                    Showing {{ $finishes->firstItem() ?? 0 }} to {{ $finishes->lastItem() ?? 0 }} of {{ $finishes->total() }} entries
                </div>
            </div>

            <div class="card-body p-0">
                {{ Form::open(['url' => route('admin.finish.multiDestroy'), 'method' => 'DELETE', 'class' => 'table-form']) }}
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <div class="form-check m-0">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                    </div>
                                </th>
                                <th>Finish Name</th>
                                <th>URL Slug</th>
                                <th>Products Linked</th>
                                <th class="text-end" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($finishes as $rec)
                                <tr>
                                    <td>
                                        <div class="form-check m-0">
                                            <input class="form-check-input check-item" type="checkbox" name="check[]" value="{{ $rec->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $rec->name }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-secondary border font-monospace">{{ $rec->slug }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1">
                                            {{ $rec->products()->count() }} products
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex align-items-center justify-content-end gap-1">
                                            @if(request()->get('type') && request()->get('type') === 'trash')
                                                <button type="button" class="btn btn-sm btn-outline-success restore-row"
                                                        data-href="{{ route('admin.finish.destroy', ['finish' => $rec->id, 'action' => 'restore']) }}"
                                                        data-bs-toggle="tooltip" title="Restore Finish">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger permanent-delete"
                                                        data-href="{{ route('admin.finish.destroy', ['finish' => $rec->id, 'action' => 'permanent-delete']) }}"
                                                        data-bs-toggle="tooltip" title="Permanent Delete">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            @else
                                                <a href="{{ route('admin.finish.edit', $rec->id) }}"
                                                   class="btn btn-sm btn-outline-primary"
                                                   data-bs-toggle="tooltip" title="Edit Finish">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-row"
                                                        data-href="{{ route('admin.finish.destroy', $rec->id) }}"
                                                        data-bs-toggle="tooltip" title="Move to Trash">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="bi bi-brush text-muted display-4 mb-3"></i>
                                            <h5 class="fw-bold text-dark">No finishes found</h5>
                                            <p class="text-muted small mb-3">Get started by creating your first finish.</p>
                                            <a href="{{ route('admin.finish.create') }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-plus-lg me-1"></i> Add Finish
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ Form::close() }}
            </div>

            @if($finishes->hasPages())
                <div class="card-footer bg-white py-3 border-top">
                    {{ $finishes->links('admin.components.pagination') }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
