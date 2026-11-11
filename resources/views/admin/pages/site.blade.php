@extends('admin.layouts.inner')

@section('site_title', 'Site Settings')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-gear text-primary me-2"></i> Site Settings & Branding
                </h1>
                <p class="page-header-subtitle">Configure website identity, logos, contact info, and social channels.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Site Settings</li>
                </ol>
            </div>
        </div>

        @include('admin.flash-msg')

        {{ Form::open(['url' => route('admin.site.update', $site->id ?? 1), 'method' => 'PUT', 'files' => true]) }}

        <div class="row g-4">
            <!-- Left Column: Site Info & Contact -->
            <div class="col-lg-7">
                <!-- Card 1: Identity & Basics -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-building text-primary"></i> Website Identity
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {{ Form::label('title', 'Site Title', ['class' => 'form-label']) }}
                            {{ Form::text('title', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Bharat - Art & Craft']) }}
                        </div>
                        <div class="mb-0">
                            {{ Form::label('tagline', 'Tagline / Slogan', ['class' => 'form-label']) }}
                            {{ Form::text('tagline', null, ['class' => 'form-control', 'placeholder' => 'Handcrafted Excellence in Wood & Metal']) }}
                        </div>
                    </div>
                </div>

                <!-- Card 2: Contact Information -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-telephone-inbound text-primary"></i> Contact & Location
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                {{ Form::label('email', 'Support Email', ['class' => 'form-label']) }}
                                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'info@stageartandcraft.com']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('phone', 'Phone Number', ['class' => 'form-label']) }}
                                {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => '+91-9636150482']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('whatsapp', 'WhatsApp Number', ['class' => 'form-label']) }}
                                <div class="input-group">
                                    <span class="input-group-text bg-success text-white"><i class="bi bi-whatsapp"></i></span>
                                    {{ Form::text('whatsapp', null, ['class' => 'form-control', 'placeholder' => '+919799080143']) }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            {{ Form::label('address', 'Physical Address', ['class' => 'form-label']) }}
                            {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'E-97 Industrial Area basni, JODHPUR, Rajasthan, INDIA']) }}
                        </div>

                        <div class="mb-0">
                            {{ Form::label('google_map', 'Google Maps Embed Link / Iframe', ['class' => 'form-label']) }}
                            {{ Form::textarea('google_map', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'https://maps.google.com/...']) }}
                        </div>
                    </div>
                </div>

                <!-- Card 3: Social Media Links -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-share text-primary"></i> Social Channels
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            {{ Form::label('social_links[facebook]', 'Facebook URL', ['class' => 'form-label']) }}
                            <div class="input-group">
                                <span class="input-group-text text-primary"><i class="bi bi-facebook"></i></span>
                                {{ Form::text('social_links[facebook]', null, ['class' => 'form-control', 'placeholder' => 'https://facebook.com/...']) }}
                            </div>
                        </div>

                        <div class="mb-3">
                            {{ Form::label('social_links[twitter]', 'Twitter / X URL', ['class' => 'form-label']) }}
                            <div class="input-group">
                                <span class="input-group-text text-info"><i class="bi bi-twitter"></i></span>
                                {{ Form::text('social_links[twitter]', null, ['class' => 'form-control', 'placeholder' => 'https://twitter.com/...']) }}
                            </div>
                        </div>

                        <div class="mb-3">
                            {{ Form::label('social_links[instagram]', 'Instagram URL', ['class' => 'form-label']) }}
                            <div class="input-group">
                                <span class="input-group-text text-danger"><i class="bi bi-instagram"></i></span>
                                {{ Form::text('social_links[instagram]', null, ['class' => 'form-control', 'placeholder' => 'https://instagram.com/...']) }}
                            </div>
                        </div>

                        <div class="mb-3">
                            {{ Form::label('social_links[linked]', 'LinkedIn URL', ['class' => 'form-label']) }}
                            <div class="input-group">
                                <span class="input-group-text text-primary"><i class="bi bi-linkedin"></i></span>
                                {{ Form::text('social_links[linked]', null, ['class' => 'form-control', 'placeholder' => 'https://linkedin.com/...']) }}
                            </div>
                        </div>

                        <div class="mb-0">
                            {{ Form::label('social_links[youtube]', 'YouTube URL', ['class' => 'form-label']) }}
                            <div class="input-group">
                                <span class="input-group-text text-danger"><i class="bi bi-youtube"></i></span>
                                {{ Form::text('social_links[youtube]', null, ['class' => 'form-control', 'placeholder' => 'https://youtube.com/...']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Footer Script -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-code-slash text-primary"></i> Custom Footer Scripts (Analytics, Pixels)
                        </h5>
                    </div>
                    <div class="card-body">
                        {{ Form::textarea('footer_script', null, ['class' => 'form-control font-monospace small', 'rows' => 4, 'placeholder' => '<script>...analytics or tracking code...</script>']) }}
                    </div>
                </div>
            </div>

            <!-- Right Column: Logo & Favicon with Croppers -->
            <div class="col-lg-5">
                <!-- Logo Card -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-palette text-primary"></i> Main Site Logo
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('admin.components.image-dropzone', [
                            'name' => 'logo',
                            'label' => 'Website Header Logo',
                            'current' => !empty($site->logo) ? asset('storage/' . $site->logo) : null,
                            'aspectRatio' => 'free',
                            'help' => 'Transparent PNG or SVG recommended.'
                        ])
                    </div>
                </div>

                <!-- Favicon Card -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-browser-chrome text-primary"></i> Favicon Icon
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('admin.components.image-dropzone', [
                            'name' => 'favicon',
                            'label' => 'Browser Favicon (Square)',
                            'current' => !empty($site->favicon) ? asset('storage/' . $site->favicon) : null,
                            'aspectRatio' => '1/1',
                            'help' => 'Square (1:1) ratio. 32x32px or 64x64px ICO/PNG.'
                        ])
                    </div>
                </div>

                <!-- Save Action Card -->
                <div class="card mb-4 shadow-sm border-primary-subtle">
                    <div class="card-body text-center p-4">
                        <h6 class="fw-bold mb-2">Save Settings</h6>
                        <p class="text-muted small mb-3">Apply your changes across the public storefront.</p>
                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                            <i class="bi bi-check-circle-fill me-1"></i> Save All Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{ Form::close() }}
    </div>
</main>
@endsection