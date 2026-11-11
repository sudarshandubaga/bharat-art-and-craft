@extends('admin.layouts.inner')

@section('site_title', 'Homepage Sliders')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-images text-primary me-2"></i> Homepage Sliders
                </h1>
                <p class="page-header-subtitle">Manage hero banner slides, imagery, and promotional captions.</p>
            </div>
            <div>
                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg"></i> Add New Slide
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
                        {{ Form::search('search_by_keyword', request('search_by_keyword'), ['class' => 'form-control border-start-0 ps-0', 'placeholder' => 'Search by slide title...']) }}
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    @if(request('search_by_keyword'))
                        <a href="{{ route('admin.slider.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    @endif
                    {{ Form::close() }}

                    <div class="d-flex align-items-center gap-2">
                        @if(request()->get('type') && request()->get('type') === 'trash')
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Active Slides
                            </a>
                            <span class="badge bg-danger px-3 py-2">
                                <i class="bi bi-trash3 me-1"></i> Trash View
                            </span>
                        @else
                            <a href="{{ route('admin.slider.index', ['type' => 'trash']) }}" class="btn btn-sm btn-outline-danger">
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
                        Total Slides: <span class="badge bg-primary rounded-pill">{{ $sliders->total() }}</span>
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
                    Showing {{ $sliders->firstItem() ?? 0 }} to {{ $sliders->lastItem() ?? 0 }} of {{ $sliders->total() }} entries
                </div>
            </div>

            <div class="card-body p-0">
                {{ Form::open(['url' => route('admin.slider.multiDestroy'), 'method' => 'DELETE', 'class' => 'table-form']) }}
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <div class="form-check m-0">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                    </div>
                                </th>
                                <th style="width: 130px;">Banner Preview</th>
                                <th>Headline & Details</th>
                                <th>Created</th>
                                <th class="text-end" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $index => $rec)
                                <tr>
                                    <td>
                                        <div class="form-check m-0">
                                            <input class="form-check-input check" name="check[]" type="checkbox" value="{{ $rec->id }}" id="check_{{ $rec->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        @if(!empty($rec->image))
                                            <img src="{{ url('images/sliders/thumbnail/' . $rec->image) }}" 
                                                 alt="{{ $rec->title }}" 
                                                 style="width: 110px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;"
                                                 onerror="this.onerror=null; this.src='https://placehold.co/160x90?text=Banner';">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light text-muted border rounded" style="width: 110px; height: 60px;">
                                                <i class="bi bi-image fs-4"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark fs-6">{{ $rec->title }}</div>
                                        <small class="text-muted text-truncate d-block" style="max-width: 480px;">
                                            {{ strip_tags($rec->description) }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="small text-muted">
                                            {{ $rec->created_at ? $rec->created_at->format('M d, Y') : 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border btn-action-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="border-radius: 10px;">
                                                @if(request()->get('type') && request()->get('type') === 'trash')
                                                    <li>
                                                        <form action="{{ route('admin.slider.destroy', [$rec->id, 'action' => 'restore']) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item py-2 delete-btn text-success d-flex align-items-center gap-2">
                                                                <i class="bi bi-arrow-counterclockwise"></i> Restore
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.slider.destroy', [$rec->id, 'action' => 'permanent-delete']) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item py-2 delete-btn text-danger d-flex align-items-center gap-2">
                                                                <i class="bi bi-trash3-fill"></i> Permanent Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.slider.edit', [$rec->id]) }}">
                                                            <i class="bi bi-pencil text-primary"></i> Edit Slide
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider my-1"></li>
                                                    <li>
                                                        <form action="{{ route('admin.slider.destroy', [$rec->id]) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item py-2 delete-btn text-danger d-flex align-items-center gap-2">
                                                                <i class="bi bi-trash3"></i> Delete
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
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-images fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                        <p class="mb-0 fw-bold">No slides found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ Form::close() }}
            </div>

            @if($sliders->hasPages())
                <div class="card-footer bg-white py-3 border-top d-flex justify-content-center">
                    {{ $sliders->links("pagination::bootstrap-5") }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection