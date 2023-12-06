@extends('layouts.admin')

@section('main-content')
    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('barang-transfer.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="barang_id">Nama Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control @error('barang_id') is-invalid @enderror">
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ $barangs[0]->id === $barang->id ? 'selected' : '' }}>
                                {{ $barang->nama }} - id = {{ $barang->id }} - stok = {{ $barang->stock }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select name="tipe" id="tipe" class="form-control @error('tipe') is-invalid @enderror">
                        <option value="masuk">MASUK</option>
                        <option value="keluar">KELUAR</option>
                    </select>
                    @error('tipe')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                        id="deskripsi" placeholder="Deskripsi" autocomplete="off" value="{{ old('deskripsi') }}">
                    @error('deskripsi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                        id="jumlah" placeholder="Jumlah" autocomplete="off" value="{{ old('jumlah') }}">
                    @error('jumlah')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_satuan">Harga Satuan</label>
                    <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror"
                        name="harga_satuan" id="harga_satuan" placeholder="Harga Satuan" autocomplete="off"
                        value="{{ old('harga_satuan') }}">
                    @error('harga_satuan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="penerima">Penerima</label>
                    <input type="text" class="form-control @error('penerima') is-invalid @enderror" name="penerima"
                        id="penerima" placeholder="Penerima" autocomplete="off" value="{{ old('penerima') }}">
                    @error('penerima')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('barang-transfer.index') }}" class="btn btn-default">Back to list</a>

            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection
