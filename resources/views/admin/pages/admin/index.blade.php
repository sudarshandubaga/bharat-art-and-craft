@extends('admin.layouts.inner')

@section('site_title', 'Admin Users')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-shield-lock text-primary me-2"></i> Administrator Accounts
                </h1>
                <p class="page-header-subtitle">Manage administrative privileges and backend system operators.</p>
            </div>
            <div>
                <a href="{{ route('admin.admin.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg"></i> Add New Admin
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
                        {{ Form::search('search_by_keyword', request('search_by_keyword'), ['class' => 'form-control border-start-0 ps-0', 'placeholder' => 'Search by name or email...']) }}
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    @if(request('search_by_keyword'))
                        <a href="{{ route('admin.admin.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    @endif
                    {{ Form::close() }}

                    <div class="d-flex align-items-center gap-2">
                        @if(request()->get('type') && request()->get('type') === 'trash')
                            <a href="{{ route('admin.admin.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Active Admins
                            </a>
                            <span class="badge bg-danger px-3 py-2">
                                <i class="bi bi-trash3 me-1"></i> Trash View
                            </span>
                        @else
                            <a href="{{ route('admin.admin.index', ['type' => 'trash']) }}" class="btn btn-sm btn-outline-danger">
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
                <div>
                    <span class="fw-bold text-dark">
                        Total Admins: <span class="badge bg-primary rounded-pill">{{ $admins->total() }}</span>
                    </span>
                </div>

                <div class="small text-muted">
                    Showing {{ $admins->firstItem() ?? 0 }} to {{ $admins->lastItem() ?? 0 }} of {{ $admins->total() }} entries
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Admin Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Role Status</th>
                                <th class="text-end" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $index => $rec)
                                <tr>
                                    <td>{{ $index + $admins->firstItem() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="user-avatar-circle" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                {{ strtoupper(substr($rec->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <div class="fw-bold text-dark">{{ $rec->name }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $rec->email }}" class="text-decoration-none">
                                            <i class="bi bi-envelope me-1"></i> {{ $rec->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $rec->phone ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-light text-primary border border-primary-subtle">
                                            <i class="bi bi-shield-check me-1"></i> Super Admin
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
                                                        <form action="{{ route('admin.admin.destroy', [$rec->id, 'action' => 'restore']) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item py-2 delete-btn text-success d-flex align-items-center gap-2">
                                                                <i class="bi bi-arrow-counterclockwise"></i> Restore
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.admin.destroy', [$rec->id, 'action' => 'permanent-delete']) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item py-2 delete-btn text-danger d-flex align-items-center gap-2">
                                                                <i class="bi bi-trash3-fill"></i> Permanent Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.admin.edit', [$rec->id]) }}">
                                                            <i class="bi bi-pencil text-primary"></i> Edit Admin
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider my-1"></li>
                                                    <li>
                                                        <form action="{{ route('admin.admin.destroy', [$rec->id]) }}" method="POST" class="delete-form">
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
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-shield-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                        <p class="mb-0 fw-bold">No admin accounts found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($admins->hasPages())
                <div class="card-footer bg-white py-3 border-top d-flex justify-content-center">
                    {{ $admins->links("pagination::bootstrap-5") }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection