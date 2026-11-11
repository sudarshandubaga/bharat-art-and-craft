@extends('admin.layouts.app')

@section('inner_section')

    <!-- Top Navigation Bar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark">
        <!-- Brand & Toggle -->
        <a class="navbar-brand ps-3" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-boxes text-primary fs-5"></i>
            <span>Bharat Art & Craft</span>
            <span class="brand-badge">ADMIN</span>
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-3" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Right Side Nav Actions -->
        <div class="ms-auto d-flex align-items-center gap-3 me-3 me-lg-4">
            <!-- Quick Link: Visit Front Store -->
            <a href="{{ url('/') }}" target="_blank" class="topbar-nav-btn topbar-visit-btn d-none d-md-inline-flex" title="Open Storefront in new tab">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>Visit Website</span>
            </a>

            <!-- Quick Link: Clear Cache -->
            <a href="{{ url('clear-cache') }}" class="topbar-nav-btn topbar-visit-btn d-none d-sm-inline-flex" title="Clear Application Cache">
                <i class="bi bi-trash3 text-warning"></i>
                <span>Clear Cache</span>
            </a>

            <!-- Admin Profile Menu -->
            <div class="dropdown">
                <a class="topbar-user-pill dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar-circle">
                        {{ strtoupper(substr(auth()->guard('admin')->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline fw-semibold small text-white">
                        {{ auth()->guard('admin')->user()->name ?? 'Administrator' }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2" aria-labelledby="navbarDropdown" style="min-width: 220px; border-radius: 12px;">
                    <li class="px-3 py-2 border-bottom mb-1 bg-light">
                        <div class="fw-bold small text-dark">{{ auth()->guard('admin')->user()->name ?? 'Administrator' }}</div>
                        <div class="text-muted small" style="font-size: 0.75rem;">{{ auth()->guard('admin')->user()->email ?? 'admin@stageart.com' }}</div>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.changepassword') }}">
                            <i class="bi bi-shield-lock text-primary"></i> Change Password
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.site.edit', 1) }}">
                            <i class="bi bi-gear text-secondary"></i> Site Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-1" /></li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center gap-2 text-danger fw-semibold" href="{{ route('admin.logout') }}">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Sidebar & Content Layout -->
    <div id="layoutSidenav">
        <!-- Sidebar Navigation -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- MAIN -->
                        <div class="sidebar-heading">Main</div>
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active-route' : '' }}" href="{{ route('admin.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-speedometer2"></i></div>
                            Dashboard
                        </a>

                        <!-- STORE MANAGEMENT -->
                        <div class="sidebar-heading">Store Management</div>

                        <!-- Products -->
                        <a class="nav-link {{ request()->routeIs('admin.product.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.product.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="{{ request()->routeIs('admin.product.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-box-seam"></i></div>
                            Products
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.product.*') ? 'show' : '' }}" id="collapseProduct" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.product.create') ? 'active-route' : '' }}" href="{{ route('admin.product.create') }}">Add Product</a>
                                <a class="nav-link {{ request()->routeIs('admin.product.index') ? 'active-route' : '' }}" href="{{ route('admin.product.index') }}">View Products</a>
                            </nav>
                        </div>

                        <!-- Categories -->
                        <a class="nav-link {{ request()->routeIs('admin.category.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.category.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="{{ request()->routeIs('admin.category.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-diagram-3"></i></div>
                            Categories
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.category.*') ? 'show' : '' }}" id="collapseCategory" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.category.create') ? 'active-route' : '' }}" href="{{ route('admin.category.create') }}">Add Category</a>
                                <a class="nav-link {{ request()->routeIs('admin.category.index') ? 'active-route' : '' }}" href="{{ route('admin.category.index') }}">View Categories</a>
                            </nav>
                        </div>

                        <!-- Finishes -->
                        <a class="nav-link {{ request()->routeIs('admin.finish.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.finish.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseFinish" aria-expanded="{{ request()->routeIs('admin.finish.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-brush"></i></div>
                            Finishes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.finish.*') ? 'show' : '' }}" id="collapseFinish" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.finish.create') ? 'active-route' : '' }}" href="{{ route('admin.finish.create') }}">Add Finish</a>
                                <a class="nav-link {{ request()->routeIs('admin.finish.index') ? 'active-route' : '' }}" href="{{ route('admin.finish.index') }}">View Finishes</a>
                            </nav>
                        </div>

                        <!-- Woods -->
                        <a class="nav-link {{ request()->routeIs('admin.wood.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.wood.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseWood" aria-expanded="{{ request()->routeIs('admin.wood.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-tree"></i></div>
                            Woods
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.wood.*') ? 'show' : '' }}" id="collapseWood" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.wood.create') ? 'active-route' : '' }}" href="{{ route('admin.wood.create') }}">Add Wood</a>
                                <a class="nav-link {{ request()->routeIs('admin.wood.index') ? 'active-route' : '' }}" href="{{ route('admin.wood.index') }}">View Woods</a>
                            </nav>
                        </div>

                        <!-- Orders -->
                        <a class="nav-link {{ request()->routeIs('admin.order.*') ? 'active-route' : '' }}" href="{{ route('admin.order.index') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-bag-check"></i></div>
                            Orders
                        </a>

                        <!-- Quotations -->
                        <a class="nav-link {{ request()->routeIs('admin.quotation.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.quotation.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseQuotation" aria-expanded="{{ request()->routeIs('admin.quotation.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-file-earmark-spreadsheet"></i></div>
                            Quotations
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.quotation.*') ? 'show' : '' }}" id="collapseQuotation" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.quotation.create') ? 'active-route' : '' }}" href="{{ route('admin.quotation.create') }}">Create Quotation</a>
                                <a class="nav-link {{ request()->routeIs('admin.quotation.index') ? 'active-route' : '' }}" href="{{ route('admin.quotation.index') }}">View Quotations</a>
                            </nav>
                        </div>

                        <!-- CONTENT -->
                        <div class="sidebar-heading">Content Management</div>

                        <!-- Blog -->
                        <a class="nav-link {{ request()->routeIs('admin.blog.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.blog.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlog" aria-expanded="{{ request()->routeIs('admin.blog.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-journal-richtext"></i></div>
                            Blog
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.blog.*') ? 'show' : '' }}" id="collapseBlog" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.blog.create') ? 'active-route' : '' }}" href="{{ route('admin.blog.create') }}">Add Blog</a>
                                <a class="nav-link {{ request()->routeIs('admin.blog.index') ? 'active-route' : '' }}" href="{{ route('admin.blog.index') }}">View Blogs</a>
                            </nav>
                        </div>

                        <!-- Pages -->
                        <a class="nav-link {{ request()->routeIs('admin.page.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.page.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapsePage" aria-expanded="{{ request()->routeIs('admin.page.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-file-earmark-text"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.page.*') ? 'show' : '' }}" id="collapsePage" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.page.create') ? 'active-route' : '' }}" href="{{ route('admin.page.create') }}">Add Page</a>
                                <a class="nav-link {{ request()->routeIs('admin.page.index') ? 'active-route' : '' }}" href="{{ route('admin.page.index') }}">View Pages</a>
                            </nav>
                        </div>

                        <!-- Sliders -->
                        <a class="nav-link {{ request()->routeIs('admin.slider.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.slider.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseSlider" aria-expanded="{{ request()->routeIs('admin.slider.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-images"></i></div>
                            Sliders
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.slider.*') ? 'show' : '' }}" id="collapseSlider" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.slider.create') ? 'active-route' : '' }}" href="{{ route('admin.slider.create') }}">Add Slider</a>
                                <a class="nav-link {{ request()->routeIs('admin.slider.index') ? 'active-route' : '' }}" href="{{ route('admin.slider.index') }}">View Sliders</a>
                            </nav>
                        </div>

                        <!-- Testimonials -->
                        <a class="nav-link {{ request()->routeIs('admin.testimonial.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.testimonial.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseTestimonial" aria-expanded="{{ request()->routeIs('admin.testimonial.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-chat-quote"></i></div>
                            Testimonials
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.testimonial.*') ? 'show' : '' }}" id="collapseTestimonial" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.testimonial.create') ? 'active-route' : '' }}" href="{{ route('admin.testimonial.create') }}">Add Testimonial</a>
                                <a class="nav-link {{ request()->routeIs('admin.testimonial.index') ? 'active-route' : '' }}" href="{{ route('admin.testimonial.index') }}">View Testimonials</a>
                            </nav>
                        </div>

                        <!-- FAQs -->
                        <a class="nav-link {{ request()->routeIs('admin.faq.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.faq.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseFaq" aria-expanded="{{ request()->routeIs('admin.faq.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-question-circle"></i></div>
                            FAQs
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.faq.*') ? 'show' : '' }}" id="collapseFaq" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.faq.create') ? 'active-route' : '' }}" href="{{ route('admin.faq.create') }}">Add FAQ</a>
                                <a class="nav-link {{ request()->routeIs('admin.faq.index') ? 'active-route' : '' }}" href="{{ route('admin.faq.index') }}">View FAQs</a>
                            </nav>
                        </div>

                        <!-- USERS & ACCESS -->
                        <div class="sidebar-heading">Users & Access</div>

                        <!-- Admin Users -->
                        <a class="nav-link {{ request()->routeIs('admin.admin.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.admin.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="{{ request()->routeIs('admin.admin.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-shield-lock"></i></div>
                            Admin Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.admin.*') ? 'show' : '' }}" id="collapseAdmin" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.admin.create') ? 'active-route' : '' }}" href="{{ route('admin.admin.create') }}">Add Admin User</a>
                                <a class="nav-link {{ request()->routeIs('admin.admin.index') ? 'active-route' : '' }}" href="{{ route('admin.admin.index') }}">View Admin Users</a>
                            </nav>
                        </div>

                        <!-- Users / Customers -->
                        <a class="nav-link {{ request()->routeIs('admin.user.*') ? '' : 'collapsed' }} {{ request()->routeIs('admin.user.*') ? 'active-route' : '' }}" 
                           href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="{{ request()->routeIs('admin.user.*') ? 'true' : 'false' }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-people"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.user.*') ? 'show' : '' }}" id="collapseUser" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('admin.user.create') ? 'active-route' : '' }}" href="{{ route('admin.user.create') }}">Add User</a>
                                <a class="nav-link {{ request()->routeIs('admin.user.index') ? 'active-route' : '' }}" href="{{ route('admin.user.index') }}">View Users</a>
                            </nav>
                        </div>

                        <!-- Newsletter -->
                        <a class="nav-link {{ request()->routeIs('admin.newsletter.*') ? 'active-route' : '' }}" href="{{ route('admin.newsletter.index') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-envelope-paper"></i></div>
                            Newsletter
                        </a>

                        <!-- SYSTEM SETTINGS -->
                        <div class="sidebar-heading">System</div>

                        <a class="nav-link {{ request()->routeIs('admin.site.*') ? 'active-route' : '' }}" href="{{ route('admin.site.edit', 1) }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-gear"></i></div>
                            Site Settings
                        </a>

                        <a class="nav-link" href="{{ url('clear-cache') }}">
                            <div class="sb-nav-link-icon"><i class="bi bi-trash3 text-warning"></i></div>
                            Clear Cache
                        </a>
                    </div>
                </div>

                <!-- Sidebar Footer Status -->
                <div class="sb-sidenav-footer d-flex align-items-center justify-content-between">
                    <div>
                        <div class="small text-muted" style="font-size: 0.72rem;">LOGGED IN AS</div>
                        <div class="fw-bold text-white small text-truncate" style="max-width: 130px;">
                            {{ auth()->guard('admin')->user()->name ?? 'Administrator' }}
                        </div>
                    </div>
                    <a href="{{ route('admin.logout') }}" class="btn btn-sm btn-action-delete" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Content Area -->
        <div id="layoutSidenav_content">
            @yield('main_section')

            <!-- Modern Admin Footer -->
            <footer class="admin-footer mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2">
                        <div class="text-muted small">
                            &copy; {{ date('Y') }} <strong>Bharat Art & Craft</strong>. All rights reserved.
                        </div>
                        <div class="small">
                            <span class="badge bg-light text-muted border">Bharat Admin v2.0</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection