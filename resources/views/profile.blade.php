@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body py-5 px-4">

                        <h2 class="text-center mb-4 text-primary font-weight-bold">Profile Perusahaan</h2>

                        <!-- Company Info Section - Align Left with Flexbox -->
                        <div class="company-info d-flex flex-column align-items-start mb-5">
                            <h4 class="mb-3 text-success font-weight-semibold">{{ $company['name'] }}</h4>
                            <p class="mb-2">
                                <strong>Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;&nbsp;&nbsp;{{ $company['address'] }}
                            </p>
                            <p class="mb-2">
                                <strong>Telepon&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;&nbsp;&nbsp;{{ $company['phone'] }}
                            </p>
                            <p><strong>Provinsi&nbsp;&nbsp;&nbsp;:</strong>&nbsp;&nbsp;&nbsp;{{ $company['province'] }}</p>
                        </div>

                        <div id="photoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner rounded-3 shadow-sm overflow-hidden">
                                @foreach ($company['photos'] as $index => $photo)
                                    <div class="carousel-item @if ($index == 0) active @endif">
                                        <a href="{{ asset('storage/' . $photo) }}" target="_blank">
                                            <!-- Adjusting image size to 1920x600 -->
                                            <img src="{{ asset('storage/' . $photo) }}" class="d-block w-100"
                                                style="width: 1920px; height: 600px; object-fit: cover;"
                                                alt="Company Photo">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Carousel controls placed outside the image -->
                        <div class="carousel-controls text-center mt-3">
                            <button class="carousel-control-prev btn btn-link" type="button" data-bs-target="#photoCarousel" data-bs-slide="prev" style="background: transparent; border: none; z-index: 5;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next btn btn-link" type="button" data-bs-target="#photoCarousel" data-bs-slide="next" style="background: transparent; border: none; z-index: 5;">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
