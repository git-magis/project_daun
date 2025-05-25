<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SH - Varian Pohon</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
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
                        <a class="nav-link" href="{{ route('welcome') }}">Kembali ke Beranda</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Feedback</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Login</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li> -->
                </ul>
                <a href="{{ route('loginform') }}" class="btn btn-brand ms-lg-3">Admin</a>
            </div>
        </div>
    </nav>

    <!-- VARIAN POHON -->
    <section id="team" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="100">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Varian Jenis Pohon</h1>
                        <div class="line" style="margin: 16px auto 24px auto;"></div>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center">
            @foreach ($varianpohon as $jenis)
            <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                <a href="{{ route('detail-pohon.show', ['id' => $jenis->id]) }}">
                    <div class="feature-card" style="background-image: url({{ asset('images/' . $jenis->gambar_pohon) }});">
                        <h3 class="feature-title mb-0 text-white">{{ $jenis->nama_jenis_pohon }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
                <!-- <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="feature-card" style="background-image: url({{ asset('images/mahoni.jpeg') }});">
                        <h3 class="feature-title mb-0 text-white">Mahoni</h3>
                    </div>
                </div> -->
                <!-- Repeat for other cards -->
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
    <!-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>