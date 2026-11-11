@extends('admin.layouts.inner')
@section('site_title', 'Dashboard')

@section('main_section')
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header-box d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="page-header-title">
                    Dashboard Overview
                </h1>
                <p class="page-header-subtitle">
                    Welcome back, <strong>{{ auth()->guard('admin')->user()->name ?? 'Admin' }}</strong>! Here is what's happening in your store today.
                </p>
            </div>
            <div>
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>

        @include('admin.flash-msg')

        <!-- KPI Stat Metric Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Products -->
            <div class="col-xl-3 col-sm-6">
                <div class="stat-card card-blue">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Products</span>
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ \App\Models\Product::count() }}</div>
                    <a href="{{ route('admin.product.index') }}" class="stat-footer-link">
                        <span>Manage Products</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-xl-3 col-sm-6">
                <div class="stat-card card-amber">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Orders</span>
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-bag-check"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ \App\Models\Order::count() }}</div>
                    <a href="{{ route('admin.order.index') }}" class="stat-footer-link">
                        <span>View Orders</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Customers / Users -->
            <div class="col-xl-3 col-sm-6">
                <div class="stat-card card-emerald">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Users / Customers</span>
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ \App\Models\User::count() }}</div>
                    <a href="{{ route('admin.user.index') }}" class="stat-footer-link">
                        <span>View Customers</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Blogs -->
            <div class="col-xl-3 col-sm-6">
                <div class="stat-card card-rose">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Blog Posts</span>
                        <div class="stat-icon-wrapper">
                            <i class="bi bi-journal-richtext"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ \App\Models\Blog::count() }}</div>
                    <a href="{{ route('admin.blog.index') }}" class="stat-footer-link">
                        <span>Manage Articles</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions Row -->
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-lightning-charge text-warning"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-outline-primary w-100 py-3 d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-plus-circle-dotted fs-4"></i>
                            <span class="small fw-bold">Add Product</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-outline-secondary w-100 py-3 d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-journal-plus fs-4 text-primary"></i>
                            <span class="small fw-bold">Add Blog</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-outline-secondary w-100 py-3 d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-diagram-3 fs-4 text-success"></i>
                            <span class="small fw-bold">Add Category</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('admin.slider.create') }}" class="btn btn-outline-secondary w-100 py-3 d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-images fs-4 text-warning"></i>
                            <span class="small fw-bold">Add Slider</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('admin.site.edit', 1) }}" class="btn btn-outline-secondary w-100 py-3 d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-sliders2 fs-4 text-info"></i>
                            <span class="small fw-bold">Site Settings</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-dark w-100 py-3 d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-box-arrow-up-right fs-4 text-danger"></i>
                            <span class="small fw-bold">Storefront</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders & Store Snapshot -->
        <div class="row g-4">
            <!-- Recent Orders -->
            <div class="col-lg-8">
                <div class="card h-100 mb-0">
                    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-clock-history text-primary"></i> Recent Inquiries / Orders
                        </h5>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-outline-primary">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @php
                            $recentOrders = \App\Models\Order::latest()->take(5)->get();
                        @endphp

                        @if($recentOrders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-custom align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Customer</th>
                                            <th>Location</th>
                                            <th>Contact</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentOrders as $order)
                                            <tr>
                                                <td class="fw-bold text-primary">
                                                    {{ $order->invoice_number ?? ('#' . $order->id) }}
                                                </td>
                                                <td>
                                                    <div class="fw-bold text-dark">{{ $order->first_name }} {{ $order->last_name }}</div>
                                                    @if(!empty($order->company_name))
                                                        <small class="text-muted">{{ $order->company_name }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>{{ $order->city ?? '' }}</div>
                                                    <small class="text-muted">{{ $order->country ?? '' }}</small>
                                                </td>
                                                <td>
                                                    <div class="small">{{ $order->email }}</div>
                                                    <small class="text-muted">{{ $order->phone }}</small>
                                                </td>
                                                <td class="text-muted small">
                                                    {{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                <p class="mb-0">No recent orders yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Store Snapshot -->
            <div class="col-lg-4">
                <div class="card h-100 mb-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title text-dark mb-0">
                            <i class="bi bi-bar-chart-line text-success"></i> Store Catalog Status
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar-circle bg-light text-primary" style="width: 36px; height: 36px;">
                                        <i class="bi bi-diagram-3"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold">Categories</span>
                                        <div class="small text-muted">Active product categories</div>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">
                                    {{ \App\Models\Category::count() }}
                                </span>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar-circle bg-light text-warning" style="width: 36px; height: 36px;">
                                        <i class="bi bi-images"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold">Homepage Sliders</span>
                                        <div class="small text-muted">Banners & featured slides</div>
                                    </div>
                                </div>
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fs-6">
                                    {{ \App\Models\Slider::count() }}
                                </span>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar-circle bg-light text-info" style="width: 36px; height: 36px;">
                                        <i class="bi bi-chat-quote"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold">Testimonials</span>
                                        <div class="small text-muted">Customer reviews</div>
                                    </div>
                                </div>
                                <span class="badge bg-info text-dark rounded-pill px-3 py-2 fs-6">
                                    {{ \App\Models\Testimonial::count() }}
                                </span>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar-circle bg-light text-success" style="width: 36px; height: 36px;">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold">Static Pages</span>
                                        <div class="small text-muted">About, FAQ, Terms, etc.</div>
                                    </div>
                                </div>
                                <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                    {{ \App\Models\Page::count() }}
                                </span>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar-circle bg-light text-primary" style="width: 36px; height: 36px;">
                                        <i class="bi bi-question-circle"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold">FAQs</span>
                                        <div class="small text-muted">Customer trade questions</div>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">
                                    {{ \App\Models\Faq::count() }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection