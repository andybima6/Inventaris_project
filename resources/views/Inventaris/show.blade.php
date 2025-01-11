@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <h2 class="mb-4 text-center" style="color: white; font-weight: bold;">Detail Inventaris</h2>
                        <div class="mb-4">
                            <a href="{{ route('inventaris.index') }}" class="btn btn-outline-primary btn-lg" style="padding: 10px 20px; border-radius: 30px; font-weight: 600;">Kembali ke Daftar</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" style="background-color: #ffffff; border-radius: 8px;">
                                <thead style="background-color: #007bff; font-weight: bold;">
                                    <tr>
                                        <th style="padding: 15px; color:black">Nama Barang</th>
                                        <th style="padding: 15px; color:black">Kategori</th>
                                        <th style="padding: 15px; color:black">Jumlah</th>
                                        <th style="padding: 15px; color:black">Status</th>
                                        <th style="padding: 15px; color:black">Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="background-color: #f8f9fa; color: #495057;">
                                        <td style="background-color: #f8f9fa; color: #495057; padding: 15px;">{{ $item->name }}</td>
                                        <td style="background-color: #f8f9fa; color: #495057; padding: 15px;">{{ $item->category }}</td>
                                        <td style="background-color: #f8f9fa; color: #495057; padding: 15px;">{{ $item->quantity }}</td>
                                        <td style="background-color: #f8f9fa; color: #495057; padding: 15px;">
                                            <span class="badge badge-{{ $item->status == 'Available' ? 'success' : 'danger' }}" style="font-size: 14px;">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td style="background-color: #f8f9fa; color: #495057; padding: 15px;">
                                            @if ($item->image_url)
                                                <a href="{{ asset('storage/' . $item->image_url) }}" target="_blank" style="color: #007bff; font-weight: 600;">
                                                    {{ basename(asset('storage/' . $item->image_url)) }}
                                                </a>
                                            @else
                                                <span class="text-muted" style="color: #6c757d;">No Image</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
