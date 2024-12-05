@extends('frontend.layouts.app')

@section('title', 'Pinjam Buku Di sini Aja')

@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Hero: Start -->
    <section id="hero-animation">
        <div class="landing-hero">
            <div class="container">
                <div class="card light-style rounded-5 shadow-none">
                    <div class="p-6">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-1 order-lg-0 mt-3 mt-lg-0">
                                <h1 class="text-primary display-6 fw-extrabold lh-1 hero-title">
                                    Pinjam Buku Favoritmu dengan Mudah dan Cepat!
                                </h1>
                                <h2 class="h6 mb-6">
                                    Temukan berbagai koleksi buku menarik, dari fiksi hingga referensi akademik.<br class="d-none d-lg-block" />
                                    Dapatkan pengalaman peminjaman yang nyaman dengan proses yang sederhana dan transparan!
                                </h2>
                                <form action="{{ route('books') }}" method="get" class="w-50 w-md-100">
                                    <div class="input-group rounded-pill">
                                        <input type="text" class="form-control border-primary" placeholder="Cari buku" name="search" aria-label="Cari buku" aria-describedby="basic-addon-search31">
                                        <button class="btn btn-primary" style="border-top-right-radius: 50rem; border-bottom-right-radius: 50rem;" type="submit"><i class="ti ti-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-5 offset-lg-1 order-0 order-lg-1 mb-6 mb-lg-0">
                                <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                                <dotlottie-player src="https://lottie.host/147d1760-9d48-425f-a741-e38627ca9c47/bq3QJx984Z.lottie" background="transparent" speed="1" style="width: 100%;" loop autoplay></dotlottie-player>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero: End -->

    <!-- Real customers reviews: Start -->
    <section id="landingReviews" class="section-py landing-reviews pb-0">
        <!-- What people say slider: Start -->
        <div class="container">
            <div class="row align-items-center gx-0 gy-4 g-lg-5 mb-5 pb-md-5">
                <div class="col-md-6 col-lg-5 col-xl-3">
                    <h4 class="mb-1">
                        Buku
                        <span class="position-relative fw-extrabold z-1">Terpopuler
                            <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                                alt="laptop charging"
                                class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                        </span>
                    </h4>
                    <p class="mb-5 mb-md-12">
                        Lihat buku populer di {{ config('app.name') }}<br class="d-none d-xl-block" />
                        dan pinjam secepat kilat
                    </p>
                    <div class="landing-reviews-btns">
                        <button id="reviews-previous-btn"
                            class="btn btn-label-primary reviews-btn me-4 scaleX-n1-rtl" type="button">
                            <i class="ti ti-chevron-left ti-md"></i>
                        </button>
                        <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl"
                            type="button">
                            <i class="ti ti-chevron-right ti-md"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-9">
                    <div class="swiper-reviews-carousel overflow-hidden">
                        <div class="swiper" id="swiper-reviews">
                            <div class="swiper-wrapper">
                                @foreach ($popularBooks as $book)
                                    <div class="swiper-slide">
                                        <a href="{{ route('books.show', $book->slug) }}" class="card p-4 h-100">
                                            <div class="ratio" style="--bs-aspect-ratio: calc(4 / 3 * 100%);">
                                                <img src="{{ asset('storage/' . $book->cover) }}" alt="" class="w-100 rounded object-fit-cover">
                                            </div>
                                            <div class="mt-4">
                                                <small style="font-size: .7rem">{{ $book->author }}</small>
                                                <h6 style="font-size: .8rem" class="lh-base mb-2">{{ Str::limit($book->title, 50) }}</h6>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress" role="progressbar" aria-valuenow="{{ $book->stock_percentage }}" aria-valuemin="0" aria-valuemax="100" style="height: 10px; width: 100%">
                                                        <div class="progress-bar" style="width: {{ $book->stock_percentage }}%"></div>
                                                    </div>
                                                    <div class="text-danger d-flex align-items-center gap-1" style="font-size: .7rem">
                                                        <i class="ti ti-book-upload" style="font-size: .9rem"></i>
                                                        <span>{{ $book->rented }}</span>
                                                    </div>
                                                    <div class="text-success d-flex align-items-center  gap-1" style="font-size: .7rem">
                                                        <i class="ti ti-book-2" style="font-size: .9rem"></i>
                                                        <span>{{ $book->current_stock }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- What people say slider: End -->
    </section>
    <!-- Real customers reviews: End -->

    <!-- FAQ: Start -->
    <section id="landingFAQ" class="section-py bg-body landing-faq">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-6">
                <h4 class="mb-0">
                    Buku
                    <span class="position-relative fw-extrabold z-1">Terbaru
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="laptop charging"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                    </span>
                </h4>
                <a href="{{ route('books') }}">Lainnya <i class="ti ti-arrow-right"></i></a>
            </div>
            <div class="row">
                @foreach ($books as $book)
                <div class="col-lg-2 col-md-3 col-6 mb-6">
                    <a href="{{ route('books.show', $book->slug) }}" class="card p-4 h-100">
                        <div class="ratio" style="--bs-aspect-ratio: calc(4 / 3 * 100%);">
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="" class="w-100 rounded object-fit-cover">
                        </div>
                        <div class="mt-4">
                            <small style="font-size: .7rem">{{ $book->author }}</small>
                            <h6 style="font-size: .8rem" class="lh-base mb-2">{{ Str::limit($book->title, 50) }}</h6>
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress" role="progressbar" aria-valuenow="{{ $book->stock_percentage }}" aria-valuemin="0" aria-valuemax="100" style="height: 10px; width: 100%">
                                    <div class="progress-bar" style="width: {{ $book->stock_percentage }}%"></div>
                                </div>
                                <div class="text-danger d-flex align-items-center gap-1" style="font-size: .7rem">
                                    <i class="ti ti-book-upload" style="font-size: .9rem"></i>
                                    <span>{{ $book->rented }}</span>
                                </div>
                                <div class="text-success d-flex align-items-center  gap-1" style="font-size: .7rem">
                                    <i class="ti ti-book-2" style="font-size: .9rem"></i>
                                    <span>{{ $book->current_stock }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- FAQ: End -->
</div>
@endsection
