<!DOCTYPE html>
<html>
<head>
    <title>Kode QR Bunga</title>
</head>
<body>
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col" style="padding-bottom: 15px;">
                <h1>{{ $data->nama_bunga }}</h1>
                <p>{{ $data->kode_unik }}</p>
                <p>{{ $data->jenisBunga->nama_jenis_bunga }} (<i>{{ $data->jenisBunga->nama_ilmiah ?? 'nama ilmiah'}})</i></p>
                <p>{{ $data->taman->nama }} ({{ $data->taman->latitude }}, {{ $data->taman->longitude }})</p>
                <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->size(200)->generate(url('/bunga/' . $data->id))) }}">
            </div>
            <div class="col">
                <i style="font-size: 12px;">Pindai kode ini untuk informasi bunga lebih lanjut</i>
            </div>
        </div>
    </div>
</body>
</html>
