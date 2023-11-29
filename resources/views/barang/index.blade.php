@extends('layouts.admin')

@section('main-content')

    <!-- Main Content goes here -->

    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $barang->deskripsi }}</td>
                                <td>{{ $barang->stock }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('barang.edit', $barang->id) }}"
                                            class="btn btn-sm btn-primary mr-2">Edit</a>
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="post">
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

    {{-- {{ $barangs->links() }} --}}

    <!-- End of Main Content -->
@endsection
