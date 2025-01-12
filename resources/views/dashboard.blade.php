@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        @foreach($groupedItems as $groupName => $items)
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $items->sum('quantity') }}</h3> <!-- Display total quantity for the grouped items -->
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">{{ $groupName }}</h6> <!-- Grouped name and category -->

                        <!-- Status Update Form -->
                        <form action="{{ route('update-status', $items->first()->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <select name="status" class="form-control">
                                <option value="Available" {{ $items->first()->status == 'Available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Borrowed" {{ $items->first()->status == 'Borrowed' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Damaged" {{ $items->first()->status == 'Damaged' ? 'selected' : '' }}>Rusak</option>
                                <option value="Lost" {{ $items->first()->status == 'Lost' ? 'selected' : '' }}>Hilang</option>
                            </select>
                            <input type="number" name="quantity" class="form-control mt-2" placeholder="Jumlah" required>
                            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
