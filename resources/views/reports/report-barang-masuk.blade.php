<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Masuk</title>
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

    <h1>Laporan Barang Masuk</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangTransfers as $transfer)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $transfer->barang ? $transfer->barang->nama : 'ERROR' }}</td>
                    <td>{{ $transfer->deskripsi }}</td>
                    <td>{{ $transfer->jumlah }}</td>
                    <td>{{ Number::currency($transfer->harga_satuan, in: 'IDR', locale: 'id') }}</td>
                    <td>{{ Number::currency($transfer->jumlah * $transfer->harga_satuan, in: 'IDR', locale: 'id') }}
                    </td>
                    <td>{{ $transfer->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
