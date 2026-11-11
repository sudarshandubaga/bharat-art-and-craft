@extends('admin.layouts.inner')

@section('site_title', 'Add New Blog')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    <i class="bi bi-journal-plus text-primary me-2"></i> Add New Blog Post
                </h1>
                <p class="page-header-subtitle">Publish a new news article, craft guide, or company announcement.</p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
                    <li class="breadcrumb-item active">Add Blog</li>
                </ol>
            </div>
        </div>

        {{ Form::open([
            'url' => route('admin.blog.store'),
            'files' => true,
            'novalidate' => true
        ]) }}

        @include('admin.pages.blog.form')

        {{ Form::close() }}
    </div>
</main>
@endsection
