@extends('admin.layouts.inner')

@section('site_title', 'Customers / Users')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-people text-primary me-2"></i> Customers & Users
                </h1>
                <p class="page-header-subtitle">Registered user accounts and contact profiles.</p>
            </div>
            <div>
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg"></i> Add New User
                </a>
            </div>
        </div>

        @include('admin.flash-msg')

        <!-- Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="fw-bold text-dark">
                        Total Users: <span class="badge bg-primary rounded-pill">{{ $users->total() }}</span>
                    </span>
                </div>

                <div class="small text-muted">
                    Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <th>About / Bio</th>
                                <th class="text-end" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $rec)
                                <tr>
                                    <td>{{ $index + $users->firstItem() }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $rec->name }}</div>
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
                                        <span class="small text-muted text-truncate d-inline-block" style="max-width: 250px;">
                                            {{ $rec->about ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border btn-action-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="border-radius: 10px;">
                                                <li>
                                                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.user.edit', [$rec->id]) }}">
                                                        <i class="bi bi-pencil text-primary"></i> Edit
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider my-1"></li>
                                                <li>
                                                    <form action="{{ route('admin.user.destroy', [$rec->id]) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item py-2 delete-btn text-danger d-flex align-items-center gap-2">
                                                            <i class="bi bi-trash3"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-people fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                        <p class="mb-0 fw-bold">No users found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($users->hasPages())
                <div class="card-footer bg-white py-3 border-top d-flex justify-content-center">
                    {{ $users->links("pagination::bootstrap-5") }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
