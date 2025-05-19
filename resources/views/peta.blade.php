<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SH - Peta Keanekaragaman Hayati</title>
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
        <h5>Daftar Lokasi Kehati</h5>
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
        }).setView([-7.319306, 108.198695], 14);

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

                const markerGroups = {};

                // Create filter checkboxes for the marker groups
                Object.keys({bukit: [], taman: []}).forEach(group => {
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = `filter-${group}`;
                    checkbox.checked = true;

                    checkbox.addEventListener('change', function() {
                        const isChecked = this.checked;
                        markerGroups[group].forEach(marker => {
                            if (isChecked) {
                                marker.addTo(map);
                            } else {
                                map.removeLayer(marker);
                            }
                        });
                    });

                    let label = document.createElement('label');
                    label.htmlFor = `filter-${group}`;
                    label.textContent = `Show ${group.charAt(0).toUpperCase() + group.slice(1)}`;

                    let div = document.createElement('div');
                    div.style.marginBottom = '5px';
                    div.appendChild(checkbox);
                    div.appendChild(label);
                    filterContainer.appendChild(div);
                });

                data.forEach(taman => {
                    let popupContent = `
                        <div style="text-align:center;">
                            <h5>${taman.nama}</h5>
                            <img src="/images/${taman.gambar}" alt="${taman.nama}" 
                                style="width:100%;max-height:150px;border-radius:10px;">
                            <p>(${taman.latitude},${taman.longitude})</p>
                            <p><strong>Total Tanaman:</strong> ${taman.pohons_count + taman.bungas_count}</p>
                            <a href="/taman-detail/${taman.id}" style="text-decoration:none;">
                                <p style="color:white;background-color:#236ab0;padding:10px;border-radius:5px;margin-bottom:4px">
                                    🔎 Lihat Detail
                                </p>
                            </a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${taman.latitude},${taman.longitude}" 
                            target="_blank" style="text-decoration:none;">
                                <button style="background:#379C6D;color:white;padding:10px;border:none;border-radius:5px;cursor:pointer;">
                                    📍 Navigasi ke Lokasi (GMaps)
                                </button>
                            </a>
                        </div>
                    `;

                    // Create Marker
                    let marker = L.marker([taman.latitude, taman.longitude])
                        .bindPopup(popupContent)
                        .bindTooltip(taman.nama, { permanent: true, direction: "top"});

                    // Add marker to map
                    marker.addTo(map);
                    markers[taman.id] = marker;

                     // Group markers by name prefix
                    const prefix = taman.nama.toLowerCase().includes('bukit') ? 'bukit' : 'taman';
                    if (!markerGroups[prefix]) {
                        markerGroups[prefix] = [];
                    }
                    markerGroups[prefix].push(marker);

                    // Create divider if the group changes
                    if (filterContainer.lastChild && !filterContainer.lastChild.classList.contains(prefix)) {
                        let hr = document.createElement('hr');
                        hr.style.margin = '8px 0';
                        filterContainer.appendChild(hr);
                    }

                    // Create clickable link to focus on the marker and open the popup
                    let div = document.createElement('div');
                    div.className = `filter-item ${prefix}`;
                    div.innerHTML = `
                        <a href="#" id="taman-${taman.id}" style="text-decoration:none;color:#236ab0;">${taman.nama}</a>
                    `;

                    // Add click event listener to pan to the marker and open the popup
                    div.querySelector(`#taman-${taman.id}`).addEventListener('click', function(e) {
                        e.preventDefault();
                        map.setView([taman.latitude, taman.longitude], 16); // Pan to marker with zoom level 16
                        markers[taman.id].openPopup(); // Open the popup content
                    });
                    filterContainer.appendChild(div);
                });
            })
            .catch(error => console.error('Error loading gardens:', error));
    </script>

</body>
</html>
