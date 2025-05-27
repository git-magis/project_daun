<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SH - Detail Kahati</title>
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
                        <a class="nav-link" href="#detail">Detail Kahati</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#komposisiTaman">Komposisi Kahati</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#galeri">Galeri Dokumentasi</a>
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
                <a href="{{ route('welcome') }}" class="btn btn-brand ms-lg-3">Beranda</a>
            </div>
        </div>
    </nav>

    <section class="section-padding" id="detail">
        <div id="taman-detail"></div>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h3>Komposisi Kahati</h3>
                </div>
            </div>
            <div class="row" id="komposisiTaman">
                <div id="komposisi" class="pt-3"></div>
                <div id="chart-pie"></div>
            </div>
            <div id="pohonTotalLabel" class="row mt-5"></div>
            <div id="listPohon" class="row"></div>
            <div id="bungaTotalLabel" class="row mt-5"></div>
            <div id="listBunga" class="row"></div>
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
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        const id = "{{ $id }}";

            fetch(`/api/taman/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('taman-detail').innerHTML = `
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route('peta') }}">Peta</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">${data.nama}</li>
                                        </ol>
                                    </nav>
                                    <h1 class="display-4 fw-semibold mb-0">${data.nama}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-6 pb-5">
                                <img src="/images/${data.gambar}" alt="euweuhan" class="rounded-4 theme-shadow">
                            </div>
                            <div class="col-lg-5">
                                <h2>Detail</h2>
                                <div class="d-flex pt-4 mb-4">
                                    <div class="iconbox me-4">
                                        <i class="ri-tree-fill"></i>
                                    </div>
                                    <div>
                                        <h5>Jumlah Tanaman</h5>
                                        <p class="fs-4">${data.pohons_count + data.bungas_count}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="iconbox me-4">
                                        <i class="ri-map-pin-fill"></i>
                                    </div>
                                    <div>
                                        <h5>Koordinat Lokasi</h5>
                                        <p class="fs-4">(${data.latitude}, ${data.longitude})</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                    document.getElementById('pohonTotalLabel').innerHTML = `
                    <div class="col-10">
                        <p class="display-6 text-success mb-5">🌲Jenis Pohon</p>
                    </div>
                    <div class="col-2 text-end">
                        <p class="display-6 text-success"><b>${data.pohons_count}</b></p>
                    </div>
                    `;

                    document.getElementById('bungaTotalLabel').innerHTML = `
                    <div class="col-10">
                        <p class="display-6 text-success mb-5">🌻Jenis Bunga</p>
                    </div>
                    <div class="col-2 text-end">
                        <p class="display-6 text-success"><b>${data.bungas_count}</b></p>
                    </div>
                    `;

                    const listPohon = document.getElementById('listPohon');
                    const listBunga = document.getElementById('listBunga');
                    listPohon.innerHTML = '';
                    listBunga.innerHTML = '';

                    const pohonCounts = {}; // { Trembesi: 3, Mangga: 2 }
                    const bungaCounts = {}; // { Mawar: 4, Melati: 1 }


                    data.pohons.forEach(p => {
                        const jenis = p.jenis_pohon?.nama_jenis_pohon;
                        if (jenis) {
                            pohonCounts[jenis] = (pohonCounts[jenis] || 0) + 1;
                        }
                    });

                    data.bungas.forEach(p => {
                        const jenis = p.jenis_bunga?.nama_jenis_bunga;
                        if (jenis) {
                            bungaCounts[jenis] = (bungaCounts[jenis] || 0) + 1;
                        }
                    });

                    // Convert to array and sort descending
                    const sortedPohon = Object.entries(pohonCounts).sort((a, b) => b[1] - a[1]);
                    const sortedBunga = Object.entries(bungaCounts).sort((a, b) => b[1] - a[1]);

                    // Render pohons
                    sortedPohon.forEach(([jenis, count]) => {
                    listPohon.innerHTML += `
                        <div class="col-10">
                            <p class="fs-5 fw-semibold text-black">${jenis}</p>
                        </div>
                        <div class="col-2 text-end">
                            <p class="text-success fs-5 fw-semibold">${count}</p>
                        </div>
                        <hr>
                    `;
                    });

                    // Render bungas
                    sortedBunga.forEach(([jenis, count]) => {
                    listBunga.innerHTML += `
                        <div class="col-10">
                            <p class="fs-5 fw-semibold text-black">${jenis}</p>
                        </div>
                        <div class="col-2 text-end">
                            <p class="text-success fs-5 fw-semibold">${count}</p>
                        </div>
                        <hr>
                    `;
                    });
                })
                .catch(err => console.error('Failed to fetch taman data:', err));
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {

            const id = "{{ $id }}";

            fetch(`/api/charts/${id}`)
                .then(response => response.json())
                .then(data=> {
                    const taman = data;

                    if (!taman.labels || !taman.data || taman.labels.length !== taman.data.length) {
                        console.error(`Data mismatch or missing for taman: ${taman.taman}`, taman);
                        return;
                    }

                    const groupedData = {};
                    taman.labels.forEach((label, index) => {
                        groupedData[label] = (groupedData[label] || 0) + taman.data[index];
                    });

                    const chartData = Object.entries(groupedData).map(([label, value]) => [label, value]);

                    // const chartData = Object.entries(groupedData).map(([label, value]) => {
                    //         const total = Object.values(groupedData).reduce((a, b) => a + b, 0);
                    //         const percent = ((value / total) * 100).toFixed(1);
                    //         return [`${label} - ${value} (${percent}%)`, value];
                    //     });

                    const dataTable = google.visualization.arrayToDataTable([
                        ['Jenis', 'Jumlah'],
                        ...chartData,
                    ]);

                    const chartContainer = document.getElementById(`chart-pie`);

                    function resizeChart() {
                        const containerWidth = chartContainer.offsetWidth;

                        const options = {
                            width: '100%',
                            is3D: true,
                            height: 500,
                            sliceVisibilityThreshold: 1/20,
                            pieHole: 0.3,
                            pieSliceText: 'value',
                            legend: containerWidth <= 450 ? { position: 'bottom' } : { position: 'right' },
                            chartArea: { width: containerWidth < 500 ? '90%' : '80%', height: '70%' },
                            tooltip: { trigger: 'focus', text: 'both' },
                        };

                        const chart = new google.visualization.PieChart(chartContainer);
                        chart.draw(dataTable, options);
                    }

                    resizeChart();
                    window.addEventListener('resize', resizeChart);
                });
        }
    </script>
</body>

</html>