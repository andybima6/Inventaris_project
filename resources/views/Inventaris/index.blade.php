@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">
                        <!-- Card Header/Body for styling -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4 text-center">Daftar Inventaris</h2>
                        <div class="mb-3">
                            <a href="{{ route('inventaris.create') }}" class="btn btn-success btn-lg">Tambah Barang</a>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventaris as $item)
                                    <tr>
                                        <td style="background-color: #2d3338; color: white;">{{ $item->name }}</td>
                                        <td style="background-color: #2d3338; color: white;">{{ $item->category }}</td>
                                        <td style="background-color: #2d3338; color: white;">{{ $item->quantity }}</td>
                                        <td style="background-color: #2d3338; color: white;">
                                            <span class="badge badge-{{ $item->status == 'Available' ? 'success' : 'danger' }}">{{ $item->status }}</span>
                                        </td>
                                        <td style="background-color: #2d3338; color: white;">
                                            @if ($item->image_url)
                                                <a href="{{ asset('storage/' . $item->image_url) }}" target="_blank">{{ basename(asset('storage/' . $item->image_url)) }}</a>
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>

                                        <td class=" justify-content-center" style="background-color: #2d3338; color: white;">
                                            <a href="{{ route('inventaris.edit', $item->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                            <a href="{{ route('inventaris.show', $item->id) }}" class="btn btn-info btn-sm me-2">Detail</a>
                                            <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Hover effect on table rows */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa !important;
        }

        /* Styling for the image in the table */
        .img-thumbnail {
            border-radius: 10px;
        }

        /* Button padding and alignment */
        .btn {
            padding: 10px 20px;
        }
    </style>
@endpush
