<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail - {{ $detailbunga->nama_jenis_bunga }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
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
                        <a class="nav-link" href="#detailpohon">Detail Pohon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#deskripsi">Deskripsi Pohon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeri">Galeri Dokumentasi</a>
                    </li>
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

    <section id="detailpohon" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-detail">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('varian-bunga') }}">Varian Bunga</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $detailbunga->nama_jenis_bunga }}</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-semibold mb-0">{{ $detailbunga->nama_jenis_bunga }}</h1>
                        <p class="fs-4 fst-italic">{{ $detailbunga->nama_ilmiah ?? 'nama ilmiah'}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-start">
                <!-- Image -->
                <div class="col-lg-6 pb-5">
                    <img src="{{ asset('images/' . $detailbunga->gambar_bunga) }}" alt="" class="rounded-4 theme-shadow">
                </div>

                <!-- Right Section (Cards) -->
                <div class="col-lg-6">
                    <div class="row">
                        <!-- Jumlah Pohon -->
                        <div class="col-md-6 pb-3">
                            <div class="mb-2 text-center bg-white theme-shadow rounded-4 py-4">
                                <h1 class="text-success display-4">{{ $detailbunga->jumlah}}</h1>
                                <h6 class="text-uppercase mb-0 text-black mt-3">Jumlah Bunga</h6>
                            </div>
                        </div>

                        <!-- Lokasi Pohon (Placed below) -->
                        <div class="col-md-6 pb-3">
                            <div class="mb-2 text-center bg-white theme-shadow rounded-4 py-4">
                                <h1 class="text-success display-4">{{ $lokasiBunga->total_taman ?? '0'}}</h1>
                                <h6 class="text-uppercase mb-0 text-black mt-3">Lokasi Bunga</h6>
                            </div>
                        </div>

                        <!-- Kode Pohon (Spans full width) -->
                        <div class="col-12 pb-5">
                            <div class="mb-2 text-center bg-white theme-shadow rounded-4 py-4">
                                <h1 class="text-success display-5">Flo/{{$speciesCode}}</h1>
                                <h6 class="text-uppercase mb-0 text-black mt-3">Kode Bunga</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($attributes as $index => $attribute)
                    <div class="col-lg-4 mb-3">
                        <div>
                            <h5>{{ ucfirst($attribute->attribute_name) }}</h5>
                            <p>{{ $attribute->attribute_value }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="deskripsi" class="section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Deskripsi Pohon</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- <p class="lh-base">
                        Flamboyan atau Delonix regia adalah tanaman yang khas dengan pohon besar, dan bunga-bunga merah cerah. Flamboyan memiliki nama genus Delonix yang berasal dari kata Yunani delos (artinya mencolok), dan onyx, berarti cakar. Nama tersebut mengacu pada penampilan bunga yang memang mencolok dan bentuk mahkota bunga yang mengembang seperti cakar. Tanaman ini memiliki berbagai macam manfaat. Daun dan bijinya yang mengandung senyawa alkaloid yang cukup tinggi dipercaya dapat menghambat pertumbuhan Plasmodium sp. penyebab penyakit malaria. Bunganya dapat digunakan sebagai penghias ruangan dan dekorasi pernikahan. Bijinya dapat bermanfaat sebagai manik-manik untuk kalung. Batang pohonnya yang cukup besar dan tinggi dapat digunakan sebagai bahan bangunan. 
                        <br><br>Pohon Flamboyan disebut juga sebagai Flame Tree karena bunganya yang berwarna merah menyerupai api (Flame). Saat musim kering, pohon ini akan menggugurkan daunnya. Pada saat itu pula bunganya akan bermekaran sehingga pohonnya terlihat indah dengan warna merahnya.
                        <br><br>Sumber : <a href="https://ayoketaman.com/web/pohon/ZzFuNFp3cG5DTHllYTZFZ1I4YW9JQT09">Klik Di sini!</a> 
                    </p> -->
                    <p class="lh-base">{!! nl2br(e($detailbunga->deskripsi)) !!}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="galeri" class="section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Galeri Dokumentasi</h2>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($bungas as $bunga)
                    <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                        <div class="portfolio-item image-zoom">
                            <div class="image-zoom-wrapper">
                                <img src="{{ asset('images/' . $bunga->gambar_bunga) }}" alt="Gambar Bunga">
                            </div>
                            <a href="{{ asset('images/' . $bunga->gambar_bunga) }}" data-fancybox="gallery" class="iconbox">
                                <i class="ri-search-2-line"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
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
    <!-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> -->
    <script src="{ { asset('js/main.js') } }"></script>
</body>

</html>