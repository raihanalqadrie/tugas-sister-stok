<!DOCTYPE html>
<html>

<head>
    <title>Laporan Stok Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Adjust margin as needed */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Laporan Stok Barang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->deskripsi }}</td>
                    <td>{{ $barang->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
