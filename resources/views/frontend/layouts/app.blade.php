<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="front-pages-no-customizer" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }} - @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->
    @stack('css')

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/front-config.js') }}"></script>
</head>

<body style="font-family: 'Urbanist', sans-serif;">

    <!-- Navbar: Start -->
    @include('frontend.layouts.navbar')
    <!-- Navbar: End -->

    <!-- Sections:Start -->

    @yield('content')

    <!-- / Sections:End -->

    <!-- Footer: Start -->
    <footer class="landing-footer bg-body footer-text">
        <div class="footer-top position-relative overflow-hidden z-1">
            <img src="{{ asset('assets/img/front-pages/backgrounds/footer-bg-light.png') }}" alt="footer bg"
                class="footer-bg banner-bg-img z-n1" data-app-light-img="front-pages/backgrounds/footer-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/footer-bg-dark.png" />
            <div class="container">
                <div class="row gx-0 gy-6 g-lg-10">
                    <div class="col-lg-5">
                        <a href="landing-page.html" class="app-brand-link mb-6">
                            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" width="32">
                            <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">{{ config('app.name') }}</span>
                        </a>
                        <p class="footer-text footer-logo-description mb-6">
                            Temukan berbagai koleksi buku menarik, dari fiksi hingga referensi akademik. Dapatkan pengalaman peminjaman yang nyaman dengan proses yang sederhana dan transparan!
                        </p>
                        <form class="footer-form" action="{{ route('books') }}" method="GET">
                            <div class="input-group rounded-pill">
                                <input type="text" class="form-control" placeholder="Cari buku" name="search"/>
                                <button type="submit" class="btn btn-primary shadow-none" style="border-top-right-radius: 50rem; border-bottom-right-radius: 50rem;">
                                    <i class="ti ti-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-6">Tentang {{ config('app.name') }}</h6>
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <a href="#" target="_blank" class="footer-link">Tentang Kami</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" target="_blank"
                                    class="footer-link">Tentang Toko</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-6">Lainnya</h6>
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <a href="#" class="footer-link">Kebijakan Privasi</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="footer-link">Hubungi Kami</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h6 class="footer-title mb-6">Download our app</h6>
                        <a href="javascript:void(0);" class="d-block mb-4"><img
                                src="{{ asset('assets/img/front-pages/landing-page/apple-icon.png') }}"
                                alt="apple icon" /></a>
                        <a href="javascript:void(0);" class="d-block"><img
                                src="{{ asset('assets/img/front-pages/landing-page/google-play-icon.png') }}"
                                alt="google play icon" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3 py-md-5">
            <div
                class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-bottom-text">© {{ date('Y') }}</span>
                    <span class="fw-medium text-white text-white">{{ config('app.name') }},</span>
                    <span class="footer-bottom-text"> Made with ❤️ by Kelompok 3</span>
                </div>
                <div>
                    <a href="https://www.facebook.com/pixinvents/" class="me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/facebook.svg') }}" alt="facebook icon" />
                    </a>
                    <a href="https://twitter.com/pixinvents" class="me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/twitter.svg') }}" alt="twitter icon" />
                    </a>
                    <a href="https://www.instagram.com/pixinvents/" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/instagram.svg') }}" alt="google icon" />
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    <div class="modal fade" id="modalSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('books') }}" method="get">
                        <div class="input-group input-group-merge rounded-pill">
                            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control rounded-e-pill" name="search" placeholder="Cari buku" aria-label="Cari buku" aria-describedby="basic-addon-search31">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/front-main.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>

    @stack('js')
</body>

</html>
