@extends('admin.layouts.inner')

@section('site_title', 'Change Password')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-shield-lock text-primary me-2"></i> Security & Password
                </h1>
                <p class="page-header-subtitle">Update your administrator account password.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-5">
                @include('admin.flash-msg')

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-key text-primary"></i> Update Credentials
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        {{ Form::open(['url' => route('admin.changepassword.update'), 'method' => 'POST']) }}
                            <!-- Current Password -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter current password" required>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-shield-plus"></i></span>
                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Minimum 6 characters" required>
                                </div>
                                <small class="text-muted">Use a strong password with letters, numbers, and symbols.</small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-shield-check"></i></span>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Re-type new password" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="bi bi-check-circle-fill me-1"></i> Update Password
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-light border">
                                    Cancel
                                </a>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection