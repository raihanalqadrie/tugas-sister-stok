@extends('layouts.admin')

@section('main-content')
    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="post">
                @csrf

                <div class="form-group">
                  <label for="nama">Nama barang</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama barang" autocomplete="off" value="{{ old('nama') }}">
                  @error('nama')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" placeholder="Deskripsi" autocomplete="off" value="{{ old('deskripsi') }}">
                  @error('deskripsi')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('barang.index') }}" class="btn btn-default">Back to list</a>

            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection

