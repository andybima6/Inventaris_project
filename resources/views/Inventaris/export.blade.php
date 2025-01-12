<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

    <h1 style="text-align: center;">Laporan Inventaris</h1>
    <p style="text-align: center;">Tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Tanggal Kadaluarsa</th>
                <th>Status</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventaris as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->quantity }}</td>'
                    <td>{{ $item->expired }}</td>'
                    <td>
                        <span class="badge badge-{{ $item->status == 'Available' ? 'success' : 'danger' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td>
                        @if ($item->image_url)
                            <a href="{{ asset('storage/' . $item->image_url) }}" target="_blank">Lihat Gambar</a>
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
