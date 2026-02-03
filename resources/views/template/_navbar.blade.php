<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-end">

                {{-- <div class="dropdown d-inline-block  ms-2">
                    <a class=" header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        id="page-header-search-dropdown">
                        <i class="mdi mdi-magnify align-middle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                        <form class="p-3">
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..."
                                        aria-label="search" aria-describedby="button-addon2">
                                    <button class="btn btn-primary" type="button" id="button-addon2"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="mdi mdi-tune"></i>
                    </button>
                </div> --}}

                <!-- light dark btn -->
                <div class="dropdown d-none d-sm-inline-block">
                    <button type="button" class="btn header-item" id="light-dark-mode">
                        <i class="mdi mdi-moon-waning-crescent align-middle fs-4"></i>
                    </button>
                    <button type="button" class="btn header-item" data-bs-toggle="modal" data-bs-target="#modal_cart"
                        id="btn_cart">
                        <i class="mdi mdi-cart-minus align-middle fs-4"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ asset('img') }}/helwa.png"
                            alt="Header Avatar">
                        <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        {{-- <a class="dropdown-item" href="#"><i
                                class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-credit-card-outline font-size-16 align-middle mr-1"></i> Billing</a>
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-account-settings font-size-16 align-middle mr-1"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-lock font-size-16 align-middle mr-1"></i> Lock screen</a>
                        <div class="dropdown-divider"></div> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"><i
                                class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>

                    </div>
                </div>
            </div>

            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('img') }}/helwa.jpg" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('img') }}/helwa.jpg" alt="" height="50">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('img') }}/helwa.jpg" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('img') }}/helwa.jpg" alt="" height="50">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm me-2 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-toggle="collapse" data-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kasir') }}">
                                    Kasir
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listInvoice') }}">
                                    Invoice
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pengeluaran') }}">
                                    Pengeluaran
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('absen') }}">
                                    Absen
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('laporan') }}">
                                    Laporan
                                </a>
                            </li>

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0)"
                                    id="topnav-uielement" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Penjualan <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu dropdown-mega-menu-md px-2"
                                    aria-labelledby="topnav-uielement">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="dropdown-item-text font-weight-semibold font-size-16">
                                                <div class="d-inline-block icons-sm me-1"><i class="uim uim-box"></i>
                                                </div> Penjualan
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="{{ route('listInvoice') }}"
                                                        class="dropdown-item">Invoice</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </li> --}}

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0)"
                                    id="topnav-uielement" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Pengeluaran <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu dropdown-mega-menu-md px-2"
                                    aria-labelledby="topnav-uielement">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="dropdown-item-text font-weight-semibold font-size-16">
                                                <div class="d-inline-block icons-sm me-1"><i class="uim uim-box"></i>
                                                </div> Pengeluaran
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="{{ route('pengeluaran') }}" class="dropdown-item">List
                                                        Pengeluaran</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </li> --}}

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Components <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-email" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="d-inline-block icons-sm me-2"><i
                                                    class="uim uim-comment-message"></i></div> Email
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="email-inbox.html" class="dropdown-item">Inbox</a>
                                            <a href="email-read.html" class="dropdown-item">Email Read</a>
                                            <a href="email-compose.html" class="dropdown-item">Email Compose</a>
                                        </div>
                                    </div>
                                    <a href="calendar.html" class="dropdown-item">
                                        <div class="d-inline-block icons-sm me-2"><i class="uim uim-schedule"></i>
                                        </div> Calendar
                                    </a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-icon" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="d-inline-block icons-sm me-2"><i
                                                    class="uim uim-object-ungroup"></i></div>Icons
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-icon">
                                            <a href="icons-materialdesign.html" class="dropdown-item">Material
                                                Design</a>
                                            <a href="icons-dripicons.html" class="dropdown-item">Dripicons</a>
                                            <a href="icons-fontawesome.html" class="dropdown-item">Font awesome 5</a>
                                            <a href="icons-themify.html" class="dropdown-item">Themify</a>
                                            <a href="icons-unicons.html" class="dropdown-item">Unicons - Dual Tone</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-table" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="d-inline-block icons-sm me-2"><i class="uim uim-table"></i>
                                            </div>Tables
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-table">
                                            <a href="tables-basic.html" class="dropdown-item">Basic Tables</a>
                                            <a href="tables-datatable.html" class="dropdown-item">Data Tables</a>
                                            <a href="tables-responsive.html" class="dropdown-item">Responsive
                                                Table</a>
                                            <a href="tables-editable.html" class="dropdown-item">Editable Table</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-form" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="d-inline-block icons-sm me-2"><i
                                                    class="uim uim-document-layout-left"></i></div>Forms
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="form-elements.html" class="dropdown-item">Form Elements</a>
                                            <a href="form-validation.html" class="dropdown-item">Form Validation</a>
                                            <a href="form-advanced.html" class="dropdown-item">Form Advanced</a>
                                            <a href="form-editors.html" class="dropdown-item">Form Editors</a>
                                            <a href="form-uploads.html" class="dropdown-item">Form File Upload</a>
                                            <a href="form-mask.html" class="dropdown-item">Form Mask</a>
                                            <a href="form-summernote.html" class="dropdown-item">Summernote</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-chart" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="d-inline-block icons-sm me-2"><i
                                                    class="uim uim-chart-pie"></i></div>Charts
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-chart">
                                            <a href="charts-morris.html" class="dropdown-item">Morris</a>
                                            <a href="charts-apex.html" class="dropdown-item">Apex</a>
                                            <a href="charts-chartist.html" class="dropdown-item">Chartist</a>
                                            <a href="charts-chartjs.html" class="dropdown-item">Chartjs</a>
                                            <a href="charts-flot.html" class="dropdown-item">Flot</a>
                                            <a href="charts-sparkline.html" class="dropdown-item">Sparkline</a>
                                            <a href="charts-knob.html" class="dropdown-item">Jquery Knob</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-maps" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="d-inline-block icons-sm me-2"><i
                                                    class="uim uim-comment-plus"></i></div>Maps
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-maps">
                                            <a href="maps-google.html" class="dropdown-item">Google map</a>
                                            <a href="maps-vector.html" class="dropdown-item">Vector map</a>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Extra pages <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-auth" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Authentication <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                            <a href="auth-login.html" class="dropdown-item">Login</a>
                                            <a href="auth-register.html" class="dropdown-item">Register</a>
                                            <a href="auth-recoverpw.html" class="dropdown-item">Recover Password</a>
                                            <a href="auth-lock-screen.html" class="dropdown-item">Lock Screen</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-utility" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Utility <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                            <a href="pages-starter.html" class="dropdown-item">Starter Page</a>
                                            <a href="pages-maintenance.html" class="dropdown-item">Maintenance</a>
                                            <a href="pages-comingsoon.html" class="dropdown-item">Coming Soon</a>
                                            <a href="pages-timeline.html" class="dropdown-item">Timeline</a>
                                            <a href="pages-gallery.html" class="dropdown-item">Gallery</a>
                                            <a href="pages-faqs.html" class="dropdown-item">FAQs</a>
                                            <a href="pages-pricing.html" class="dropdown-item">Pricing</a>
                                            <a href="pages-404.html" class="dropdown-item">Error 404</a>
                                            <a href="pages-500.html" class="dropdown-item">Error 500</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-layout" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Layouts <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                            <a href="layouts-vertical.html" class="dropdown-item">Vertical</a>
                                            <a href="layouts-topbar-light.html" class="dropdown-item">Light Topbar</a>
                                            <a href="layouts-topbar-dark.html" class="dropdown-item">Dark Topbar</a>
                                            <a href="layouts-full-width.html" class="dropdown-item">Full width</a>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>


</header>
