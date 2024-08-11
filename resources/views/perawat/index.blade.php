@extends('layouts.user_type.auth')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@foreach ($data as $item)
    <div class="col-12 col-xl-12">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">{{ $item['nurse'] }}</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            @if ($item['picture'])
                               <img src="{{ asset('assets/picture/' . $item['picture']) }}" alt="kal" class="border-radius-lg shadow"> 
                            @else
                               <img src="{{ asset('assets/img/user.png') }}" alt="kal" class="border-radius-lg shadow">
                            @endif
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Pasien: {{ $item['pasien_count'] }} Org</h6>
                            <p class="mb-0 text-xs">Bill: Rp {{ number_format($item['bill_total'], 0, ',', '.') }}</p>
                        </div>
                        <div class="ms-auto text-end">
                                 <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="{{ route('perawat.detail', ['id' => $item['id']]) }}">Detail</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <br>
@endforeach

@endsection
