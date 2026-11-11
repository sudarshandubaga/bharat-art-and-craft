@extends('admin.layouts.app')

@section('site_title', 'Admin Login')
@section('body_class', 'bg-dark')

@section('inner_section')
<div class="min-vh-100 d-flex flex-column justify-content-between" style="background: radial-gradient(circle at 50% 20%, #1e293b 0%, #0b1329 100%);">
    <div class="container my-auto py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5 col-xl-4">
                <!-- Branding Header -->
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-lg mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-shield-lock-fill fs-2"></i>
                    </div>
                    <h3 class="fw-bold text-white mb-1">Bharat Art & Craft</h3>
                    <p class="text-white-50 small mb-0">Management & Administration Portal</p>
                </div>

                <!-- Login Card -->
                <div class="card shadow-lg border-0" style="border-radius: 20px;">
                    <div class="card-body p-4 p-sm-5">
                        <div class="mb-4">
                            <h4 class="fw-bold text-dark mb-1">Sign In</h4>
                            <p class="text-muted small mb-0">Enter your administrator credentials to continue.</p>
                        </div>

                        @include('admin.flash-msg')

                        {{ Form::open(['url' => route('admin.login.post'), 'novalidate' => true]) }}
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                                    <input name="email" class="form-control border-start-0 ps-0" id="inputEmail" type="email" placeholder="name@stageart.com" value="{{ old('email') }}" required autofocus />
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label for="inputPassword" class="form-label mb-0">Password</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock"></i></span>
                                    <input name="password" class="form-control border-start-0 border-end-0 ps-0" id="inputPassword" type="password" placeholder="••••••••" required />
                                    <button class="btn btn-outline-secondary border-start-0 bg-light text-muted" type="button" id="togglePasswordBtn">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-4">
                                <input name="remember_me" class="form-check-input" id="inputRememberPassword" type="checkbox" value="1" />
                                <label class="form-check-label text-muted small" for="inputRememberPassword">Keep me logged in on this device</label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold">
                                    Sign In <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        {{ Form::close() }}

                        <div class="text-center mt-4 pt-3 border-top">
                            <a href="{{ url('/') }}" class="text-decoration-none small text-muted d-inline-flex align-items-center gap-1">
                                <i class="bi bi-arrow-left"></i> Return to Public Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Footer -->
    <footer class="py-3 text-center text-white-50 small border-top border-secondary border-opacity-25">
        <div class="container">
            &copy; {{ date('Y') }} <strong>Bharat Art & Craft</strong>. Protected System.
        </div>
    </footer>
</div>
@endsection

@section('extra_scripts')
<script>
    document.getElementById('togglePasswordBtn')?.addEventListener('click', function() {
        const passwordInput = document.getElementById('inputPassword');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
</script>
@endsection