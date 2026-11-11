@extends('admin.layouts.inner')

@section('site_title', 'Newsletter Subscribers')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-envelope-paper text-primary me-2"></i> Newsletter Subscribers
                </h1>
                <p class="page-header-subtitle">Manage email subscribers and send broadcast newsletters.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Newsletter</li>
                </ol>
            </div>
        </div>

        @include('admin.flash-msg')

        <div class="row g-4">
            <!-- Left: Subscribers List -->
            <div class="col-lg-6">
                <div class="card shadow-sm h-100 mb-0">
                    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-people text-primary"></i> Subscriber List
                        </h5>
                        <span class="badge bg-primary rounded-pill">
                            {{ $newsletters->total() }} Subscribers
                        </span>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>Email Address</th>
                                        <th>Subscribed Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($newsletters as $index => $rec)
                                        <tr>
                                            <td>{{ $index + $newsletters->firstItem() }}</td>
                                            <td>
                                                <div class="fw-semibold text-dark">
                                                    <i class="bi bi-envelope-check text-success me-1"></i>
                                                    {{ $rec->email }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="small text-muted">
                                                    {{ $rec->created_at ? $rec->created_at->format('M d, Y') : 'N/A' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted">
                                                <i class="bi bi-envelope-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                                <p class="mb-0 fw-bold">No subscribers yet.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($newsletters->hasPages())
                        <div class="card-footer bg-white py-3 border-top d-flex justify-content-center">
                            {{ $newsletters->links("pagination::bootstrap-5") }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Compose Broadcast -->
            <div class="col-lg-6">
                <div class="card shadow-sm mb-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-send text-primary"></i> Broadcast Email Campaign
                        </h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['url' => route('admin.newsletter.store'), 'method' => 'POST']) }}
                            <div class="mb-3">
                                {{ Form::label('subject', 'Campaign Subject', ['class' => 'form-label']) }}
                                {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'e.g. Exciting New Wooden Collection Arrival!', 'required' => 'required']) }}
                            </div>

                            <div class="mb-3">
                                {{ Form::label('message', 'Campaign Message', ['class' => 'form-label']) }}
                                {{ Form::textarea('message', null, ['class' => 'form-control myEditor', 'rows' => 8, 'placeholder' => 'Write your announcement here...']) }}
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="bi bi-send-fill me-1"></i> Send to All Subscribers
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
