@extends('admin.layouts.inner')

@section('site_title', 'FAQs Management')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-question-circle text-primary me-2"></i> Frequently Asked Questions (FAQs)
                </h1>
                <p class="page-header-subtitle">Manage dynamic questions and answers displayed on the FAQ page.</p>
            </div>
            <div>
                <a href="{{ route('admin.faq.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg"></i> Add New FAQ
                </a>
            </div>
        </div>

        @include('admin.flash-msg')

        <!-- Search & Filter Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    {{ Form::open(['method' => 'GET', 'class' => 'd-flex flex-wrap align-items-center gap-2 flex-grow-1']) }}
                    <div class="input-group" style="max-width: 420px;">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        {{ Form::search('search_by_keyword', request('search_by_keyword'), ['class' => 'form-control border-start-0 ps-0', 'placeholder' => 'Search questions or answers...']) }}
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    @if(request('search_by_keyword'))
                        <a href="{{ route('admin.faq.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    @endif
                    {{ Form::close() }}

                    <div class="d-flex align-items-center gap-2">
                        @if(request()->get('type') && request()->get('type') === 'trash')
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Published FAQs
                            </a>
                            <span class="badge bg-danger px-3 py-2">
                                <i class="bi bi-trash3 me-1"></i> Trash View
                            </span>
                        @else
                            <a href="{{ route('admin.faq.index', ['type' => 'trash']) }}" class="btn btn-sm btn-outline-danger">
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
                        Total FAQs: <span class="badge bg-primary rounded-pill">{{ $faqs->total() }}</span>
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
                    Showing {{ $faqs->firstItem() ?? 0 }} to {{ $faqs->lastItem() ?? 0 }} of {{ $faqs->total() }} entries
                </div>
            </div>

            <div class="card-body p-0">
                {{ Form::open(['url' => route('admin.faq.multiDestroy'), 'method' => 'DELETE', 'class' => 'table-form']) }}
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <div class="form-check m-0">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                    </div>
                                </th>
                                <th style="width: 70px;">Order</th>
                                <th style="min-width: 250px;">Question</th>
                                <th style="min-width: 350px;">Answer Preview</th>
                                <th style="width: 100px;">Status</th>
                                <th class="text-end" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faqs as $index => $rec)
                            <tr>
                                <td>
                                    <div class="form-check m-0">
                                        <input class="form-check-input sub-check" type="checkbox" name="check[]" value="{{ $rec->id }}">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border fw-bold">{{ $rec->sort_order }}</span>
                                </td>
                                <td>
                                    <strong class="text-dark d-block text-wrap">{{ strip_tags($rec->question) }}</strong>
                                </td>
                                <td>
                                    <span class="text-muted small d-block text-truncate" style="max-width: 450px;">
                                        {{ strip_tags($rec->answer) }}
                                    </span>
                                </td>
                                <td>
                                    @if($rec->status === 'active')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1 rounded-pill">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border dropdown-toggle no-arrow py-1 px-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                            @if(request()->get('type') && request()->get('type') === 'trash')
                                                <li>
                                                    <form action="{{ route('admin.faq.destroy', [$rec->id, 'action' => 'restore']) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item py-2 text-success d-flex align-items-center gap-2" type="submit">
                                                            <i class="bi bi-arrow-counterclockwise"></i> Restore
                                                        </button>
                                                    </form>
                                                </li>
                                                <li><hr class="dropdown-divider my-1"></li>
                                                <li>
                                                    <form action="{{ route('admin.faq.destroy', [$rec->id, 'action' => 'permanent-delete']) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item py-2 text-danger d-flex align-items-center gap-2" type="submit">
                                                            <i class="bi bi-x-octagon"></i> Delete Permanently
                                                        </button>
                                                    </form>
                                                </li>
                                            @else
                                                <li>
                                                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.faq.edit', [$rec->id]) }}">
                                                        <i class="bi bi-pencil-square text-primary"></i> Edit FAQ
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider my-1"></li>
                                                <li>
                                                    <form action="{{ route('admin.faq.destroy', [$rec->id]) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item py-2 text-danger d-flex align-items-center gap-2" type="submit">
                                                            <i class="bi bi-trash3"></i> Move to Trash
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <div class="empty-state">
                                        <i class="bi bi-question-circle display-4 text-muted opacity-50 mb-3 d-block"></i>
                                        <p class="mb-0 fw-bold">No FAQs found.</p>
                                        <small class="text-muted">Click "Add New FAQ" to create your first question and answer.</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ Form::close() }}
            </div>

            @if($faqs->hasPages())
                <div class="card-footer bg-white py-3 border-top d-flex justify-content-center">
                    {{ $faqs->links("pagination::bootstrap-5") }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
