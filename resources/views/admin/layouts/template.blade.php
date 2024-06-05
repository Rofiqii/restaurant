<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('dashboard2/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('page_title')</title>

    <meta name="description" content="" />


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard2/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('dashboard2/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('dashboard2/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard2/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="dashboard" class="app-brand-link">

                        <span class="app-brand-text demo menu-text fw-bold ms-2">RestoranT</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active open">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                            {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item active">
                                <a href="{{ route('admindashboard') }}" class="menu-link">
                                    <div data-i18n="Analytics">Dashboard</div>
                                </a>
                            </li>

                            <!-- Layouts -->

                            <! -- Header -->
                                <li class="menu-header small text-uppercase">
                                    <span class="menu-header-text">Tipe Makanan</span>
                                </li>
                                <!-- Apps -->
                                <li class="menu-item">
                                    <a href="{{ route('addfoodtype') }}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-collection"></i>
                                        <div data-i18n="Basic">Tambah Tipe Makanan</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('allfoodtype') }}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-collection"></i>
                                        <div data-i18n="Basic">Semua Tipe Makanan</div>
                                    </a>
                                </li>

                                <! -- Header -->
                                    <li class="menu-header small text-uppercase">
                                        <span class="menu-header-text">Pengguna</span>
                                    </li>
                                    <!-- Apps -->
                                    <li class="menu-item">
                                        <a href="{{ route('add-users') }}" class="menu-link">
                                            <i class="menu-icon tf-icons bx bx-collection"></i>
                                            <div data-i18n="Basic">Tambah Pengguna</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('allusers') }}" class="menu-link">
                                            <i class="menu-icon tf-icons bx bx-collection"></i>
                                            <div data-i18n="Basic">Semua Pengguna</div>
                                        </a>
                                    </li>

                                    <! -- Header -->
                                        <li class="menu-header small text-uppercase">
                                            <span class="menu-header-text">Makanan</span>
                                        </li>
                                        <!-- Apps -->
                                        <li class="menu-item">
                                            <a href="{{ route('addfoods') }}" class="menu-link">
                                                <i class="menu-icon tf-icons bx bx-collection"></i>
                                                <div data-i18n="Basic">Tambah Makanan</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('allfoods') }}" class="menu-link">
                                                <i class="menu-icon tf-icons bx bx-collection"></i>
                                                <div data-i18n="Basic">Semua Makanan</div>
                                            </a>
                                        </li>

                                        <! -- Header -->
                                            <li class="menu-header small text-uppercase">
                                                <span class="menu-header-text">Pesanan</span>
                                            </li>
                                            <!-- Apps -->
                                            <li class="menu-item">
                                                <a href="{{ route('pendingorder') }}" class="menu-link">
                                                    <i class="menu-icon tf-icons bx bx-collection"></i>
                                                    <div data-i18n="Basic">Penerimaan Pesanan</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="{{ route('historyorder') }}" class="menu-link">
                                                    <i class="menu-icon tf-icons bx bx-collection"></i>
                                                    <div data-i18n="Basic">Riwayat Pemesanan</div>
                                                </a>
                                            </li>
                        </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        @yield('search')
                        {{-- <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                                    placeholder="Pencarian..." aria-label="Search..." />
                            </div>
                        </div> --}}
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            {{-- <li class="nav-item lh-1 me-3">
                                <a class="github-button"
                                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                                    data-icon="octicon-star" data-size="large" data-show-count="true"
                                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                            </li> --}}

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('dashboard2/assets/img/avatars/admin2.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('dashboard2/assets/img/avatars/admin2.png') }}"
                                                            alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">{{ Auth::user()->f_name }}</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    {{-- <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="test">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle ms-1">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('adminlogout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('dashboard2/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/js/menu.js') }}"></script>
    @yield('js')
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('dashboard2/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dashboard2/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('dashboard2/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
