<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SH - Pindai Kode QR</title>
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

    <div id="reader-container" class="camera-container">
        <div id="reader"></div>
    </div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    const html5QrCode = new Html5Qrcode("reader");

    function onScanSuccess(decodedText) {
        console.log(`QR Code detected: ${decodedText}`);

        // Automatically redirect to the scanned link
        if (decodedText.startsWith("http")) {
            window.location.href = decodedText;
        } else {
            alert(`Scanned data is not a valid link: ${decodedText}`);
        }

        // Stop scanning after a successful read
        html5QrCode.stop().then(() => {
            console.log("Scanning stopped.");
        }).catch(err => {
            console.error("Error stopping scanning:", err);
        });
    }

    function onScanFailure(error) {
        console.warn(`QR Code scan failed: ${error}`);
    }

    html5QrCode.start(
        { facingMode: "environment" },  // Rear camera by default
        {
            fps: 10,                    // Scans per second
            qrbox: { width: 300, height: 300 }
        },
        onScanSuccess,
        onScanFailure
    );
</script>

</body>
</html>
