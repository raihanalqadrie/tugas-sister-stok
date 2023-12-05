@extends('layouts.admin')

@section('main-content')
    <!-- Main Content goes here -->

    <a href="{{ route('barang-transfer.create') }}" class="btn btn-primary mb-3">Tambah Transfer Barang</a>
    <a href="{{ route('barang-transfer.index.masuk') }}" class="btn btn-success mb-3">List Barang Masuk</a>
    <a href="{{ route('barang-transfer.index.keluar') }}" class="btn btn-danger mb-3">List Barang Keluar</a>
    <a href="" class="btn btn-info mb-3">Cetak Laporan Barang Masuk</a>
    <a href="" class="btn btn-info mb-3">Cetak Laporan Barang Keluar</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>Tanggal Dibuat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangTransfers as $transfer)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $transfer->barang ? $transfer->barang->nama : 'ERROR' }}</td>
                                <td>{{ $transfer->deskripsi }}</td>
                                <td>
                                    <div
                                        class="btn-sm text-white @if ($transfer->tipe === 'keluar') bg-danger @else bg-success @endif mr-2">
                                        {{ Str::ucfirst($transfer->tipe);}}
                                    </div>
                                </td>

                                <td>{{ $transfer->jumlah }}</td>
                                <td>{{ Number::currency($transfer->harga_satuan, in: 'IDR', locale: 'id') }}</td>
                                <td>{{ Number::currency($transfer->jumlah * $transfer->harga_satuan, in: 'IDR', locale: 'id') }}
                                </td>
                                <td>{{ $transfer->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('barang-transfer.edit', $transfer->id) }}"
                                            class="btn btn-sm btn-primary mr-2">Edit</a>
                                        <form action="{{ route('barang-transfer.destroy', $transfer->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure to delete this?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- {{ $barangTransfers->links() }} --}}

    <!-- End of Main Content -->
@endsection
