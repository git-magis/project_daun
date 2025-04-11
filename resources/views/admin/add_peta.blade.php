<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Lokasi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div id="map"></div>
    <div class="container form-map mt-4">
        <h3>Pilih Lokasi</h3>

        <form action="{{ route('save-location') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" id="longitude" name="longitude" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Lokasi</button>
        </form>
    </div>

    <!-- <pre>{{ json_encode($taman) }}</pre> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var initialLat = -7.336053; // Default latitude
        var initialLng = 108.221603; // Default longitude

        // Initialize Map
        var map = L.map('map', { zoomControl: false }).setView([initialLat, initialLng], 17);
        
        // Add Zoom Control
        L.control.zoom({ position: 'topleft' }).addTo(map);

        // Load OpenStreetMap Tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add Draggable Marker
        var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map)
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

        // Set initial values in input fields
        document.getElementById("latitude").value = initialLat;
        document.getElementById("longitude").value = initialLng;
    </script>

</body>
</html>
