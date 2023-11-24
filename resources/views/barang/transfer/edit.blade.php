@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('barang.transfer.update', $barangTransfer->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="barang_id">Nama Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control @error('barang_id') is-invalid @enderror" disabled>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ $barangTransfer->barang_id == $barang->barang_id ? 'selected' : '' }}>(id = {{ $barang->id }}) - {{ $barang->nama }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                        id="deskripsi" placeholder="Deskripsi" autocomplete="off" value="{{ old('deskripsi') ?? $barangTransfer->deskripsi }}">
                    @error('deskripsi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                        id="jumlah" placeholder="Jumlah" autocomplete="off" value="{{ old('jumlah') ?? $barangTransfer->jumlah }}">
                    @error('jumlah')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_satuan">Harga Satuan</label>
                    <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" name="harga_satuan"
                        id="harga_satuan" placeholder="Harga Satuan" autocomplete="off" value="{{ old('harga_satuan') ?? $barangTransfer->harga_satuan }}">
                    @error('harga_satuan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="penerima">Penerima</label>
                    <input type="text" class="form-control @error('penerima') is-invalid @enderror" name="penerima"
                        id="penerima" placeholder="Penerima" autocomplete="off" value="{{ old('penerima') ?? $barangTransfer->penerima }}">
                    @error('penerima')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="created_at">Waktu Dibuat</label>
                    <input type="text" class="form-control @error('created_at') is-invalid @enderror" name="created_at"
                        id="created_at" placeholder="Waktu Dibuat" autocomplete="off"
                        value="{{ old('created_at') ?? $barangTransfer->created_at }}" disabled>
                </div>

                <div class="form-group">
                    <label for="updated_at">Waktu Terakhir Diperbarui</label>
                    <input type="text" class="form-control @error('updated_at') is-invalid @enderror" name="updated_at"
                        id="updated_at" placeholder="Waktu Terakhir Diperbarui" autocomplete="off"
                        value="{{ old('updated_at') ?? $barangTransfer->updated_at }}" disabled>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ $barangTransfer->jumlah > 0 ? route('barang.transfer.masuk') : route('barang.transfer.keluar') }}" class="btn btn-default">Back to list</a>

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
