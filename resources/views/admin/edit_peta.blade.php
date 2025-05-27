<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div id="map"></div>
    <div class="container form-map mt-4" id="form-map" style="bottom: 25px;">
        <h3>Edit Taman</h3>

        <button id="toggle-bottom" onclick="toggleBottom()">
            <span id="arrow-icon">👇</span>
        </button>

        <div class="sidebar-edit-back">
            @if(auth()->user()->level == 'admin')
            <a href="{{route('admin.manage-taman')}}">
                <i class="ri-arrow-left-line"></i>
            </a>
            @elseif(auth()->user()->level == 'staff')
            <a href="{{route('staff.manage-taman')}}">
                <i class="ri-arrow-left-line"></i>
            </a>
            @endif
        </div>

        <form action="{{ route('edit-location') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Ensure these hidden inputs are included -->
            <input type="hidden" name="id" value="{{ $taman->id ?? '' }}">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $taman->nama }}">
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md">
                    <label for="nama" class="form-label">Latitude</label>
                    <input type="text" id="latitude" name="latitude" class="form-control">
                </div>
                <div class="col-md">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" id="longitude" name="longitude" class="form-control">
                </div>
            </div>
            <!-- <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" id="kode" name="kode" class="form-control" value="{{ $taman->kode }}">
            </div> -->
            <div class="form-group">
                <label for="editGambar">Gambar</label>
                <input type="file" class="form-control-file" id="editGambar" name="gambar">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Lokasi</button>
        </form>
    </div>

    <!-- <pre>{{ json_encode($taman) }}</pre> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>

        function toggleBottom() {
            let sidebar = document.getElementById("form-map");
            let arrow = document.getElementById("arrow-icon");

            if (sidebar.style.bottom === "25px") {
                sidebar.style.bottom = "-350px"; // Hide sidebar
                arrow.innerHTML = "👆"; // Change arrow direction
            } else {
                sidebar.style.bottom = "25px"; // Show sidebar
                arrow.innerHTML = "👇"; // Change arrow direction
            }
        }

        var initialLat = -7.336053; // Default latitude
        var initialLng = 108.221603; // Default longitude

        // Get existing location from database (or use default values)
        var existingLat = @json($taman->latitude ?? $initialLat);
        var existingLng = @json($taman->longitude ?? $initialLng);

        existingLat = parseFloat(existingLat);
        existingLng = parseFloat(existingLng);

        // Initialize Map
        var map = L.map('map', { zoomControl: false }).setView([existingLat, existingLng], 17);
        
        // Add Zoom Control
        L.control.zoom({ position: 'topleft' }).addTo(map);

        // Load OpenStreetMap Tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        document.getElementById("latitude").value = existingLat;
        document.getElementById("longitude").value = existingLng;

        // Add Draggable Marker
        var marker = L.marker([existingLat, existingLng], { draggable: true }).addTo(map)
            .bindPopup("Geser marker untuk memilih lokasi").openPopup();

        // Update input fields when marker is moved
        marker.on('dragend', function (event) {
            var position = marker.getLatLng();
            document.getElementById("latitude").value = position.lat.toFixed(6);
            document.getElementById("longitude").value = position.lng.toFixed(6);
        });

        // When user clicks on the map, move the marker
        map.on('click', function (e) {
            var lat = e.latlng.lat.toFixed(6);
            var lng = e.latlng.lng.toFixed(6);

            marker.setLatLng([lat, lng]); // Move marker
            marker.bindPopup("Lat: " + lat + "<br>Lng: " + lng).openPopup();

            // Update hidden input fields
            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
        });

    </script>

</body>
</html>
