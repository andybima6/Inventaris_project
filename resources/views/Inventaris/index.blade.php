@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">
                        <!-- Add any header content here if needed -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4 text-center">Daftar Inventaris</h2>

                        <div class="mb-3 d-flex justify-content-between">
                            <a href="{{ route('inventaris.create') }}" class="btn btn-success btn-lg">Tambah Barang</a>
                            <!-- Tautan untuk menampilkan PDF -->
                            <a href="{{ route('inventaris.view_pdf') }}"  class="btn btn-info btn-lg">View PDF</a>

                            <!-- Tautan untuk mendownload PDF -->
                            <a href="{{ route('inventaris.download_pdf') }}" class="btn btn-danger btn-lg">Download PDF</a>



                        </div>


                        <!-- Table Section -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Expired</th>
                                        <th>Status</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inventaris as $item)
                                        <tr>
                                            <td style="background-color: #2d3338; color: white;">{{ $item->name }}</td>
                                            <td style="background-color: #2d3338; color: white;">{{ $item->category }}</td>
                                            <td style="background-color: #2d3338; color: white;">{{ $item->quantity }}</td>
                                            <td style="background-color: #2d3338; color: white;">{{ $item->expired }}</td>
                                            <td
                                                style="background-color: #2d3338; color: white; text-align: center; vertical-align: middle;">
                                                <span
                                                    class="badge badge-{{ $item->status == 'Available' ? 'success' : 'danger' }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>

                                            <td style="background-color: #2d3338; color: white;">
                                                @if ($item->image_url)
                                                    <a href="{{ asset('storage/' . $item->image_url) }}" target="_blank">
                                                        Lihat Gambar
                                                    </a>
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td style="background-color: #2d3338; color: white; text-align: center; vertical-align: middle;"
                                                class="justify-content-center">
                                                <a href="{{ route('inventaris.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('inventaris.show', $item->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data inventaris tidak tersedia</td>
                                        </tr>
                                    @endforelse
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

        /* Styling for buttons */
        .btn {
            padding: 10px 20px;
        }

        /* Badge adjustments */
        .badge {
            font-size: 14px;
        }
    </style>
@endpush
