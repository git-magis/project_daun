<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siska Hayati - Beranda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('images/siskalogo-3-black.png')}}" alt="teu aya" style="width: 45px;">
                <!-- <h1>* E-Daun</h1> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#barchart">Data Tanaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Ulasan</a>
                    </li>
                </ul>
                <a href="{{ route('loginform') }}" class="btn btn-brand ms-lg-3">Admin</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="{{asset('images/siskalogo-3.png')}}" alt="teu aya" style="width: 100px;" data-aos="fade-left">
                    <h2 data-aos="fade-left" class="text-white text-decoration-underline fw-semibold display-2 pt-4">Siska Hayati</h2>
                    <h4 class="text-white mt-3 mb-4" data-aos="fade-right">Sistem Informasi Keanekaragaman Hayati Kota Tasikmalaya.</h4>
                    <!-- <h5 class="text-white mt-3 mb-4" data-aos="fade-right">Lihat persebaran pohon di lokasi hutan kota dan Pindai Kode QR informasi pohon.</h5> -->
                    <div data-aos="fade-up" data-aos-delay="50">
                        <a href="{{route('scan')}}" class="btn btn-brand me-2">Pindai QR Pohon</a>
                        <a href="#services" class="btn btn-light ms-2">Fitur</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COUNTER -->
    <section id="counter" class="section-padding">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6">
                    <h1 class="text-success display-2"><i class="ri-leaf-line stat-icon">   </i>{{ $totalTanaman }}</h1>
                    <h6 class="text-uppercase mb-0 text-black mt-3">Pohon Tertanam</h6>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="text-success display-2"><i class="ri-tree-line stat-icon">   </i>{{ $totalJenisPohon }}</h1>
                    <h6 class="text-uppercase mb-0 text-black mt-3">Jenis Pohon</h6>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="text-success display-2"><i class="ri-flower-line stat-icon">   </i>{{ $totalJenisBunga }}</h1>
                    <h6 class="text-uppercase mb-0 text-black mt-3">Jenis Bunga</h6>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="text-success display-2"><i class="ri-map-2-line stat-icon">   </i>{{ $totalTaman }}</h1>
                    <h6 class="text-uppercase mb-0 text-black mt-3">Blok Lokasi Kehati</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="section-padding border-top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h1 class="display-4 fw-semibold">Tentang</h1>
                        <div class="line"></div>
                        <!-- <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p> -->
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 pb-5">
                    <img src="{{ asset('images/percenahan.png') }}" alt="" class="rounded-4 theme-shadow">
                </div>
                <div class="col-lg-5">
                    <h1>Siska Hayati</h1>
                    <p class="mt-3 mb-4">Website untuk menyimpan data aneka ragam hayati di Kota Tasikmalaya yang tersebar di berbagai wilayah.</p>
                    <div class="d-flex pt-4 mb-4">
                        <div class="iconbox me-4">
                            <i class="ri-book-open-line"></i>
                        </div>
                        <div>
                            <h5>Wahana Edukasi</h5>
                            <p>Setiap pohon terdapat kode QR yang dapat dipindai untuk melihat informasi spesies hayati.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="iconbox me-4">
                            <i class="ri-earth-line"></i>
                        </div>
                        <div>
                            <h5>Penelusuran Wilayah</h5>
                            <p>Telusuri wilayah infestasi hayati melalui fitur peta hutan untuk mendapatkan koordinat lokasi.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="iconbox me-4">
                            <i class="ri-archive-drawer-line"></i>
                        </div>
                        <div>
                            <h5>Pencatatan Data</h5>
                            <p>Upaya mendukung transformasi digital dalam pencatatan basis data aneka ragam hayati berdasarkan lokasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h1 class="display-4 fw-semibold">Keanekaragaman hayati</h1>
                        <div class="line"></div>
                        <!-- <h5>Persebaran aneka ragam hayati di Kota Tasikmalaya</h5> -->
                        <!-- <p>Persebaran aneka ragam hayati di Kota Tasikmalaya, meliputi pohon, bunga, dan rumpun.</p> -->
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center">
                <a href="{{route('peta')}}" class="col-lg-4 col-sm-6">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <h4 class="mt-4 mb-3">Peta Lokasi Hayati</h4>
                        <p>Lokasi Persebaran Hutan Kota</p>
                    </div>
                </a>
                <a href="{{route('scan')}}" class="col-lg-4 col-sm-6">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-qr-scan-line"></i>
                        </div>
                        <h4 class="mt-4 mb-3">Pindai QR</h4>
                        <p>Pindai QR pohon untuk melihat jenis</p>
                    </div>
                </a>
                <a href="{{route('varian-pohon')}}" class="col-lg-4 col-sm-6">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-tree-line"></i>
                        </div>
                         <h4 class="mt-4 mb-3">Varian Pohon</h4>
                        <p>Varian Pohon yang terdapat di hutan kota</p>
                    </div>
                </a>
                <a href="{{route('varian-bunga')}}" class="col-lg-4 col-sm-6">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-flower-line"></i>
                        </div>
                        <h4 class="mt-4 mb-3">Varian Bunga</h4>
                        <p>Varian Bunga yang terdapat di hutan kota</p>
                    </div>
                </a>
                
                <!-- <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="650">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-user-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">UX Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <!-- <section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">About us</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6" data-aos="fade-down" data-aos-delay="50">
                    <img src="{ { asset('images/about.jpg') } }" alt="">
                </div>
                <div data-aos="fade-down" data-aos-delay="150" class="col-lg-5">
                    <h1>About Elixir</h1>
                    <p class="mt-3 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit quo reiciendis ad.</p>
                    <div class="d-flex pt-4 mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-mail-send-fill"></i>
                        </div>
                        <div>
                            <h5>We are Awesome</h5>
                            <p>Consectetur adipisicing elit. Corporis nesciunt aut temporibus!</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-user-5-fill"></i>
                        </div>
                        <div>
                            <h5>We are Awesome</h5>
                            <p>Consectetur adipisicing elit. Corporis nesciunt aut temporibus!</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="iconbox me-4">
                            <i class="ri-rocket-2-fill"></i>
                        </div>
                        <div>
                            <h5>We are Awesome</h5>
                            <p>Consectetur adipisicing elit. Corporis nesciunt aut temporibus!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- PORTFOLIO -->
    <!-- <section id="portfolio" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Our Portfolio</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/project-1.jpg') } }" alt="">
                        </div>
                        <a href="./assets/images/project-1.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/project-2.jpg') } }" alt="">
                        </div>
                        <a href="./assets/images/project-2.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="250">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/project-3.jpg') } }" alt="">
                        </div>
                        <a href="./assets/images/project-3.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/project-4.jpg') } }" alt="">
                        </div>
                        <a href="./assets/images/project-4.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="350">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/project-5.jpg') } }" alt="">
                        </div>
                        <a href="./assets/images/project-5.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/project-6.jpg') } }" alt="">
                        </div>
                        <a href="./assets/images/project-6.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- REVIEW -->
    <!-- <section id="reviews" class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Testimonials</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row gy-5 gx-4">
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>Amazing theme ipsum dolor sit amet consectetur adipisicing elit. Assumenda eum animi rerum ipsam impedit dicta voluptatem.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="./assets/images/avatar-1.jpg" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>UX Architect</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>Amazing theme ipsum dolor sit amet consectetur adipisicing elit. Assumenda eum animi rerum ipsam impedit dicta voluptatem.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="./assets/images/avatar-2.jpg" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>UX Architect</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>Amazing theme ipsum dolor sit amet consectetur adipisicing elit. Assumenda eum animi rerum ipsam impedit dicta voluptatem.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="./assets/images/avatar-3.jpg" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>UX Architect</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>Amazing theme ipsum dolor sit amet consectetur adipisicing elit. Assumenda eum animi rerum ipsam impedit dicta voluptatem.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="./assets/images/avatar-4.jpg" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>UX Architect</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="550">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>Amazing theme ipsum dolor sit amet consectetur adipisicing elit. Assumenda eum animi rerum ipsam impedit dicta voluptatem.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="./assets/images/avatar-5.jpg" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>UX Architect</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="650">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>Amazing theme ipsum dolor sit amet consectetur adipisicing elit. Assumenda eum animi rerum ipsam impedit dicta voluptatem.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="./assets/images/avatar-6.jpg" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>UX Architect</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- TEAM -->
    <!-- <section id="team" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Team Members</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center ">
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/person-1.jpg') } }" alt="">
                        </div>
                        <div class="team-member-content">
                            <h4 class="text-white">Jon Doe</h4>
                            <p class="mb-0 text-white">Webflow Artist</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="250">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/person-2.jpg') } }" alt="">
                        </div>
                        <div class="team-member-content">
                            <h4 class="text-white">Jon Doe</h4>
                            <p class="mb-0 text-white">Webflow Artist</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="350">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{ { asset('images/person-3.jpg') } }" alt="">
                        </div>
                        <div class="team-member-content">
                            <h4 class="text-white">Jon Doe</h4>
                            <p class="mb-0 text-white">Webflow Artist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- BLOG -->
    <!-- <section id="blog" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Berita & Artikel</h1>
                        <div class="line"></div>
                        <h5>Geser untuk melihat lebih banyak.</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="swiper mySwiper pb-5">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card h-100 rounded-3">
                                    <img src="{{asset('images/beringin.jpg')}}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Penanaman Pohon Beringin</h5>
                                        <p class="card-text fs-6">Penanaman pohon beringin oleh Dinas Lingkungan Hidup Kota Tasikmalaya dalam upaya meningkatkan ruangan hijau.</p><a href="#" class="fs-6">Baca Selengkapnya</a>
                                    </div>
                                    <div class="card-footer fs-6">
                                        <small class="text-body-secondary">Diposting 3 hari yang lalu</small>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card h-100 rounded-3">
                                    <img src="{{asset('images/counter.jpg')}}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Penanaman Pohon Beringin</h5>
                                        <p class="card-text fs-6">Penanaman pohon beringin oleh Dinas Lingkungan Hidup Kota Tasikmalaya dalam upaya meningkatkan ruangan hijau.</p><a href="#" class="fs-6">Baca Selengkapnya</a>
                                    </div>
                                    <div class="card-footer fs-6">
                                        <small class="text-body-secondary">Diposting 3 hari yang lalu</small>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card h-100 rounded-3">
                                    <img src="{{asset('images/galeri-1.png')}}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Penanaman Pohon Beringin</h5>
                                        <p class="card-text fs-6">Penanaman pohon beringin oleh Dinas Lingkungan Hidup Kota Tasikmalaya dalam upaya meningkatkan ruangan hijau.</p><a href="#" class="fs-6">Baca Selengkapnya</a>
                                    </div>
                                    <div class="card-footer fs-6">
                                        <small class="text-body-secondary">Diposting 3 hari yang lalu</small>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card h-100 rounded-3">
                                    <img src="{{asset('images/galeri-2.png')}}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Penanaman Pohon Beringin</h5>
                                        <p class="card-text fs-6">Penanaman pohon beringin oleh Dinas Lingkungan Hidup Kota Tasikmalaya dalam upaya meningkatkan ruangan hijau.</p><a href="#" class="fs-6">Baca Selengkapnya</a>
                                    </div>
                                    <div class="card-footer fs-6">
                                        <small class="text-body-secondary">Diposting 3 hari yang lalu</small>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card h-100 rounded-3">
                                    <img src="{{asset('images/galeri-3.png')}}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Penanaman Pohon Beringin</h5>
                                        <p class="card-text fs-6">Penanaman pohon beringin oleh Dinas Lingkungan Hidup Kota Tasikmalaya dalam upaya meningkatkan ruangan hijau.</p><a href="#" class="fs-6">Baca Selengkapnya</a>
                                    </div>
                                    <div class="card-footer fs-6">
                                        <small class="text-body-secondary">Diposting 3 hari yang lalu</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- BAR CHART -->
     <section id="barchart" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h1 class="display-4 fw-semibold">Data Keseluruhan</h1>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="bar-chart" class="chart-container"></div>
                </div>
            </div>
        </div>
     </section>

     <!-- CONTACT -->
    <section class="section-padding bg-light align-items-center text-center" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h1 class="display-4 text-white fw-semibold">Pendapat dan Saran</h1>
                        <div class="line bg-white"></div>
                        <h5 class="text-white">Memiliki saran atau pendapat? Sampaikan pada kami, ya!</h5>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="#" class="row g-3 p-lg-5 p-4 bg-white theme-shadow rounded-4">
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" placeholder="Nama depan">
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" placeholder="Nama belakang">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="email" class="form-control" placeholder="Alamat email">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="text" class="form-control" placeholder="Perihal">
                        </div>
                        <div class="form-group col-lg-12">
                            <textarea name="message" rows="5" class="form-control" placeholder="Isi saran Anda..."></textarea>
                        </div>
                        <div class="form-group col-lg-12 d-grid">
                            <button class="btn btn-brand">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-auto col-sm-6">
                        <h4 class="text-white">* Siska Hayati</h4>
                        <div class="line"></div>
                        <p>Sistem Informasi Hutan Kota Tasikmalaya</p>
                        <div class="social-icons">
                            <a href="#"><i class="ri-twitter-fill"></i></a>
                            <a href="#"><i class="ri-instagram-fill"></i></a>
                            <a href="#"><i class="ri-github-fill"></i></a>
                            <a href="#"><i class="ri-dribbble-fill"></i></a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">SERVICES</h5>
                        <div class="line"></div>
                        <ul>
                            <li><a href="#">UI Design</a></li>
                            <li><a href="#">UX Design</a></li>
                            <li><a href="#">Branding</a></li>
                            <li><a href="#">Logo Designing</a></li>
                        </ul>
                    </div> -->
                    <!-- <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">ABOUT</h5>
                        <div class="line"></div>
                        <ul>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Career</a></li>
                        </ul>
                    </div> -->
                    <div class="col-auto col-sm-6">
                        <h5 class="mb-0 text-white">Kontak</h5>
                        <div class="line"></div>
                        <ul>
                            <li>Dinas Lingkungan Hidup Kota Tasikmalaya</li>
                            <li>+62823 2121 0367</li>
                            <li>www.example.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row g-4 justify-content-between">
                    <div class="col-auto">
                        <p class="mb-0">© Dinas Lingkungan Hidup Kota Tasikmalaya</p>
                    </div>
                    <div class="col-auto">
                        <!-- <p class="mb-0">Designed with 💜 By Mirayukki</p> -->
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawBarChart);

        function drawBarChart() {
            const overallData = @json($overallData);

            const data = google.visualization.arrayToDataTable([
                ['Jenis', 'Jumlah', { role: 'annotation' }],
                ...overallData.map(item => [item.label, item.count, item.label.toString()]),
            ]);

            const chart = new google.visualization.BarChart(document.getElementById('bar-chart'));

            function resizeChart() {
                const containerWidth = document.getElementById('bar-chart').offsetWidth;

                const baseHeight = overallData.length * (containerWidth < 400 ? 35 : 50);

                const options = {
                    width: '100%',
                    height: baseHeight,
                    legend: { position: 'none' },
                    chartArea: {
                        width: containerWidth < 500 ? '90%' : '80%',
                        height: '80%',
                    },
                    bar: {groupWidth: '90%'},
                    hAxis: { title: 'Jumlah', minValue: 0 },
                    vAxis: {
                        title: 'Jenis',
                        textStyle: { fontSize: containerWidth < 450 ? 10 : 12 }
                    },
                    annotations: {
                        alwaysOutside: false,
                        textStyle: {
                            fontSize: 12,
                            color: 'white',
                            auraColor: 'none'
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'out',
                        startup: true
                    },
                };

                chart.draw(data, options);
            }

            // Draw the chart initially
            resizeChart();

            // Redraw chart on window resize
            window.addEventListener('resize', resizeChart);
        }
    </script>
</body>

</html>