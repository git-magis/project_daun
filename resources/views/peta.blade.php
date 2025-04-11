<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Garden Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar">

    <div class="sidebar-back">
        <a href="{{route('welcome')}}">
            <i class="ri-arrow-left-line"></i>
        </a>
    </div>

    <div id="sidebar" style="left: 10px;">
        <h5>Daftar Taman</h5>
        <hr>
        <div id="filter-options"></div>
        <button id="toggle-sidebar" onclick="toggleSidebar()">
            <span id="arrow-icon">👈</span>
        </button>
    </div>

    <div id="map"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map', {
            zoomControl: false
        }).setView([-7.336053, 108.221603], 17); // Default center (Jakarta)

        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // Load OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        function toggleSidebar() {
            let sidebar = document.getElementById("sidebar");
            let arrow = document.getElementById("arrow-icon");

            if (sidebar.style.left === "10px") {
                sidebar.style.left = "-250px"; // Hide sidebar
                arrow.innerHTML = "👉"; // Change arrow direction
            } else {
                sidebar.style.left = "10px"; // Show sidebar
                arrow.innerHTML = "👈"; // Change arrow direction
            }
        }

        var markers = [];

        // Fetch gardens from API
        fetch('/api/maps')
            .then(response => response.json())
            .then(data => {
                let filterContainer = document.getElementById('filter-options');

                data.forEach(taman => {
                    let popupContent = `
                        <div style="text-align:center;">
                            <h5>${taman.nama}</h5>
                            <img src="{{asset('images/flamboyan.jpg')}}" alt="${taman.nama}" 
                                style="width:100%;max-height:150px;border-radius:10px;">
                            <p>(${taman.latitude},${taman.longitude})</p>
                            <p><strong>Total Tanaman:</strong> ${taman.pohons_count + taman.bungas_count}</p>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${taman.latitude},${taman.longitude}" 
                            target="_blank" style="text-decoration:none;">
                                <button style="background:#379C6D;color:white;padding:10px;border:none;border-radius:5px;margin-top:5px;cursor:pointer;">
                                    📍 Navigasi ke Lokasi (GMaps)
                                </button>
                            </a>
                        </div>
                    `;

                    let marker = L.marker([taman.latitude, taman.longitude])
                        .bindPopup(popupContent);

                    markers[taman.id] = marker;
                    marker.addTo(map);

                    // Create checkbox for the sidebar
                    let div = document.createElement('div');
                    div.className = 'filter-item';
                    div.innerHTML = `<input type="checkbox" id="taman-${taman.id}" value="${taman.id}" checked> ${taman.nama}`;
                    filterContainer.appendChild(div);
                });

                // Checkbox change event
                document.querySelectorAll('.filter-item input').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        let tamanId = this.value;
                        if (this.checked) {
                            map.addLayer(markers[tamanId]);
                        } else {
                            map.removeLayer(markers[tamanId]);
                        }
                    });
                });
            })
            .catch(error => console.error('Error loading gardens:', error));
    </script>

</body>
</html>
