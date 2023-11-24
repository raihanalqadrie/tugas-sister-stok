@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('barang-transfer.create') }}" class="btn btn-primary mb-3">Create Transfer Barang</a>
    <a href="{{ route('barang-transfer.index.masuk') }}" class="btn btn-primary mb-3">List Barang Masuk</a>
    <a href="{{ route('barang-transfer.index.keluar') }}" class="btn btn-secondary mb-3">List Barang Keluar</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Tanggal Dibuat</th>
                <th>#</th>
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
                    <td>{{ Number::currency($transfer->jumlah * $transfer->harga_satuan, in: 'IDR', locale: 'id') }}</td>
                    <td>{{ $transfer->created_at }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('barang-transfer.edit', $transfer->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('barang-transfer.destroy', $transfer->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $barangTransfers->links() }}

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
