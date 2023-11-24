@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('barang.update', $barang->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nama">Nama barang</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                        id="nama" placeholder="Nama barang" autocomplete="off"
                        value="{{ old('nama') ?? $barang->nama }}">
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                        id="deskripsi" placeholder="Deskripsi" autocomplete="off"
                        value="{{ old('deskripsi') ?? $barang->deskripsi }}">
                    @error('deskripsi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok"
                        id="stok" placeholder="Stok" autocomplete="off"
                        value="{{ old('stok') ?? $barang->stock }}" disabled>
                    @error('stok')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="created_at">Waktu Dibuat</label>
                    <input type="text" class="form-control @error('created_at') is-invalid @enderror" name="created_at"
                        id="created_at" placeholder="Waktu Dibuat" autocomplete="off"
                        value="{{ old('created_at') ?? $barang->created_at }}" disabled>
                </div>

                <div class="form-group">
                    <label for="updated_at">Waktu Terakhir Diperbarui</label>
                    <input type="text" class="form-control @error('updated_at') is-invalid @enderror" name="updated_at"
                        id="updated_at" placeholder="Waktu Terakhir Diperbarui" autocomplete="off"
                        value="{{ old('updated_at') ?? $barang->updated_at }}" disabled>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('barang.index') }}" class="btn btn-default">Back to list</a>

            </form>
        </div>
    </div>

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
