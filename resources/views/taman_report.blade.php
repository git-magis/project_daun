<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kehati - {{ $taman->nama }}</title>
    <style>
        @page { margin: 50px 30px 80px 30px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; text-align: left; }
        h2 { margin-bottom: 0; }
        h4 { text-align: center; }
        .footer {
        position: fixed;
        bottom: -40px;
        left: 0;
        right: 0;
        height: 30px;
        text-align: center;
        font-size: 11px;
        color: #888;
        border-top: 1px solid #ccc;
        padding-top: 5px;
    }
    </style>
</head>
<body>
    <h2>Laporan Kehati: {{ $taman->nama }}</h2>
    <p><strong>Total Pohon:</strong> {{ $taman->pohons_count }}</p>
    <p><strong>Total Bunga:</strong> {{ $taman->bungas_count }}</p>

    <h4>Jenis Pohon</h4>
    <table>
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pohonCounts as $jenis => $count)
                <tr>
                    <td>{{ $jenis }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Jenis Bunga</h4>
    <table>
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bungaCounts as $jenis => $count)
                <tr>
                    <td>{{ $jenis }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Siska Hayati DLH - Dicetak pada {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}
    </div>
</body>
</html>
