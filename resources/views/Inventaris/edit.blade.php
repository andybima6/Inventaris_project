@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4 text-center" style="color: #007bff; font-weight: bold;">Edit Inventaris</h2>
                        <div class="mb-4">
                            <a href="{{ route('inventaris.index') }}" class="btn btn-outline-primary btn-lg" style="padding: 10px 20px; border-radius: 30px; font-weight: 600;">Kembali ke Daftar</a>
                        </div>

                        <!-- Edit Form -->
                        <form action="{{ route('inventaris.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name" style="font-weight: bold;">Nama Barang</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="category" style="font-weight: bold;">Kategori</label>
                                <input type="text" name="category" id="category" class="form-control" value="{{ $item->category }}" required>
                            </div>

                            <div class="form-group">
                                <label for="quantity" style="font-weight: bold;">Jumlah</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $item->quantity }}" required>
                            </div>

                            <div class="form-group">
                                <label for="status" style="font-weight: bold;">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Available" {{ $item->status == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Unavailable" {{ $item->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image" style="font-weight: bold;">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @if ($item->image_url)
                                    <a href="{{ asset('storage/' . $item->image_url) }}" target="_blank" style="margin-top: 10px; display: block; color: #007bff;">Lihat Gambar Lama</a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success btn-lg" style="padding: 10px 20px; font-weight: bold; border-radius: 30px;">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
