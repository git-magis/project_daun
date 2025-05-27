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

    <div id="sidebar">
        <h5>📍 Daftar Lokasi</h5>
        <hr>
        <div id="group-filters"></div>
        <hr>
        <div id="filter-options" class="scrollable-list"></div>
    </div>

    <div id="sidebar-jenis">
        <div id="jenis-filters">
            <h5>🪴 Daftar Tanaman</h5>
            <hr>
        </div>
    </div>

    <div id="toggle-sidebar" onclick="toggleSidebar()">
        <span id="arrow-icon">👈</span>
    </div>

    <!-- <button id="toggle-sidebar" onclick="toggleSidebar()">
        <span id="arrow-icon">👈</span>
    </button> -->

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
            const sidebar = document.getElementById("sidebar");
            const sidebarJenis = document.getElementById("sidebar-jenis");
            const toggleBtn = document.getElementById("toggle-sidebar");
            const arrow = document.getElementById("arrow-icon");

            const isOpen = !sidebar.classList.contains("hidden-sidebar");

            if (isOpen) {
                sidebar.classList.add("hidden-sidebar");
                sidebarJenis.classList.add("hidden-sidebar");
                toggleBtn.style.left = "1px"; // Move button to left edge
                arrow.innerHTML = "👉"; // Flip icon
            } else {
                sidebar.classList.remove("hidden-sidebar");
                sidebarJenis.classList.remove("hidden-sidebar");
                toggleBtn.style.left = "260px"; // Return button next to sidebar
                arrow.innerHTML = "👈";
            }
        }

        var markers = [];

        // Fetch gardens from API
        fetch('/api/maps')
            .then(response => response.json())
            .then(data => {
                let groupFilterContainer = document.getElementById('group-filters');
                let filterContainer = document.getElementById('filter-options');
                const markerGroups = {};
                const markers = {};
                const jenisMarkers = {};

                const jenisSet = new Set();

                // Define recognized prefixes
                const recognizedGroups = ['bukit', 'taman'];

                data.forEach(taman => {
                    let popupContent = `
                        <div style="text-align:center;">
                            <h5>${taman.nama}</h5>
                            <img src="/images/${taman.gambar}" alt="${taman.nama}" 
                                style="width:100%;max-height:150px;border-radius:10px;">
                            <p><strong>Total Tanaman:</strong> ${taman.pohons_count + taman.bungas_count}</p>
                            <a href="/taman-detail/${taman.id}" style="text-decoration:none;">
                                <p style="color:white;background-color:#236ab0;padding:10px;border-radius:5px;">
                                    🔎 Lihat Detail
                                </p>
                            </a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${taman.latitude},${taman.longitude}" 
                            target="_blank" style="text-decoration:none;">
                                <p style="color:white;background-color:#379C6D;padding:10px;border-radius:5px;">
                                    📍 Navigasi ke Lokasi (GMaps)
                                </p>
                            </a>
                        </div>
                    `;

                    // Main taman marker
                    let marker = L.marker([taman.latitude, taman.longitude])
                        .bindPopup(popupContent)
                        .bindTooltip(taman.nama, { permanent: true, direction: "top" });

                    marker.addTo(map);
                    markers[taman.id] = marker;

                    // Determine group
                    let prefix = recognizedGroups.find(group => taman.nama.toLowerCase().includes(group)) || 'other';
                    if (!markerGroups[prefix]) markerGroups[prefix] = [];
                    markerGroups[prefix].push(marker);

                    // Create clickable link
                    let div = document.createElement('div');
                    div.className = `filter-item ${prefix}`;
                    div.innerHTML = `<a href="#" id="taman-${taman.id}" style="text-decoration:none;color:#236ab0;">${taman.nama}</a>`;

                    div.querySelector(`#taman-${taman.id}`).addEventListener('click', function(e) {
                        e.preventDefault();
                        map.setView([taman.latitude, taman.longitude], 16);
                        markers[taman.id].openPopup();
                    });

                    filterContainer.appendChild(div);

                    const jenisCountMap = {};

                    const baseLat = parseFloat(taman.latitude);
                    const baseLng = parseFloat(taman.longitude);
                    const offsetDistance = 0.0001;

                    // Collect pohons
                    taman.pohons.forEach(p => {
                        const jenis = p.jenis_pohon?.nama_jenis_pohon;
                        if (jenis) {
                            if (!jenisCountMap[jenis]) {
                                jenisCountMap[jenis] = { count: 0, type: 'pohon' };
                            }
                            jenisCountMap[jenis].count++;
                            jenisSet.add(jenis);
                        }
                    });

                    // Collect bungas
                    taman.bungas.forEach(b => {
                        const jenis = b.jenis_bunga?.nama_jenis_bunga;
                        if (jenis) {
                            if (!jenisCountMap[jenis]) {
                                jenisCountMap[jenis] = { count: 0, type: 'bunga' };
                            }
                            jenisCountMap[jenis].count++;
                            jenisSet.add(jenis);
                        }
                    });

                    // Now render markers once per jenis
                    let jenisIndex = 0;
                    Object.entries(jenisCountMap).forEach(([jenis, data]) => {
                        const angle = (jenisIndex * 45) * Math.PI / 180;
                        const latOffset = Math.cos(angle) * offsetDistance;
                        const lngOffset = Math.sin(angle) * offsetDistance;

                        const circle = L.circleMarker(
                            [baseLat + latOffset, baseLng + lngOffset],
                            {
                                radius: 9,
                                color: data.type === 'pohon' ? 'green' : 'magenta',
                                fillColor: data.type === 'pohon' ? 'green' : 'magenta',
                                fillOpacity: 0.7
                            }
                        ).bindTooltip(`${jenis} (${data.count} ${data.type})`);

                        if (!jenisMarkers[jenis]) jenisMarkers[jenis] = [];
                        jenisMarkers[jenis].push(circle);
                        circle.addTo(map);

                        jenisIndex++;
                    });

                });

                // Create filter checkboxes per group
                Object.keys(markerGroups).forEach((group, idx, arr) => {
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = `filter-${group}`;
                    checkbox.checked = true;

                    checkbox.addEventListener('change', function () {
                        const isChecked = this.checked;
                        markerGroups[group].forEach(marker => {
                            isChecked ? marker.addTo(map) : map.removeLayer(marker);
                        });
                        // Also hide/show related filter items
                        document.querySelectorAll(`.filter-item.${group}`).forEach(el => {
                            el.style.display = isChecked ? 'block' : 'none';
                        });
                    });

                    let label = document.createElement('label');
                    label.htmlFor = `filter-${group}`;
                    label.textContent = `Show ${group.charAt(0).toUpperCase() + group.slice(1)}`;

                    let div = document.createElement('div');
                    div.style.marginBottom = '5px';
                    div.appendChild(checkbox);
                    div.appendChild(label);
                    groupFilterContainer.appendChild(div);

                    if (idx < arr.length - 1) {
                        let hr = document.createElement('hr');
                        hr.style.margin = '8px 0';
                        // groupFilterContainer.appendChild(hr);
                    }
                });

                const jenisFilterContainer = document.getElementById('jenis-filters');
                const activeJenisFilters = new Set(); // Keeps track of checked jenis

                // Toggle All function
                const toggleAllCheckbox = document.createElement('input');
                toggleAllCheckbox.type = 'checkbox';
                toggleAllCheckbox.id = 'toggle-all-jenis';
                toggleAllCheckbox.checked = true;

                const toggleAllLabel = document.createElement('label');
                toggleAllLabel.htmlFor = 'toggle-all-jenis';
                toggleAllLabel.textContent = ' Toggle All';
                toggleAllLabel.style.cursor = 'pointer';

                const toggleAllDiv = document.createElement('div');
                toggleAllDiv.style.marginBottom = '10px';
                toggleAllDiv.appendChild(toggleAllCheckbox);
                toggleAllDiv.appendChild(toggleAllLabel);

                jenisFilterContainer.appendChild(toggleAllDiv);

                toggleAllCheckbox.addEventListener('change', function () {
                    const isChecked = this.checked;

                    // Toggle all individual checkboxes
                    document.querySelectorAll('#jenis-filters input[type="checkbox"]').forEach(cb => {
                        // Skip the toggle-all checkbox itself
                        if (cb.id !== 'toggle-all-jenis') {
                            cb.checked = isChecked;
                            cb.dispatchEvent(new Event('change')); // Trigger the individual checkbox logic
                        }
                    });
                });

                jenisSet.forEach(jenis => {
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = `jenis-${jenis}`;
                    checkbox.checked = true;

                    // Toggle markers when checkbox is changed
                    checkbox.addEventListener('change', function () {
                        const isChecked = this.checked;
                        jenisMarkers[jenis]?.forEach(marker => {
                            isChecked ? marker.addTo(map) : map.removeLayer(marker);
                        });

                        // Optionally: hide/show elements related to this jenis
                        document.querySelectorAll(`.filter-item.${jenis}`).forEach(el => {
                            el.style.display = isChecked ? 'block' : 'none';
                        });
                    });

                    const label = document.createElement('label');
                    label.htmlFor = `jenis-${jenis}`;
                    label.textContent = ` ${jenis}`;
                    label.style.cursor = 'pointer';

                    // Pan to the first marker of this jenis when label is clicked
                    label.addEventListener('click', () => {
                        const markers = jenisMarkers[jenis];
                        if (markers && markers.length > 0) {
                            const firstMarker = markers[0];
                            map.setView(firstMarker.getLatLng(), 18);
                        }
                    });

                    const div = document.createElement('div');
                    div.style.marginBottom = '5px';
                    div.appendChild(checkbox);
                    div.appendChild(label);

                    jenisFilterContainer.appendChild(div);
                });

            })
            .catch(error => console.error('Error loading gardens:', error));
    </script>

</body>
</html>
