@extends('layouts.user_type.auth')

@section('content')

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
        <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('/assets/img/logos/main.png'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        {{-- Menampilkan gambar profil pengguna atau gambar default --}}
                        <img src="{{ $transaction->picture ? asset('assets/picture/' . $transaction->picture) : asset('assets/img/user.png') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Detail Transaksi
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Detail Transaksi - {{ $transaction->created_at->format('l, d F Y, H:i') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="d-flex flex-column">
                        <p class="mb-3 text-sm">Rekam Medis - {{ $transaction->rekam }}</p>
                        <span class="mb-2 text-xs">MD: <span class="text-dark font-weight-bold ms-sm-2">{{ $md }}</span></span>
                        <span class="mb-2 text-xs">Nurse: 
                            @if($nurse1)
                                <span class="text-dark font-weight-bold ms-sm-2">{{ $nurse1 }}</span>
                            @endif
                            @if($nurse2)
                                @if($nurse1)
                                    <span class="text-dark font-weight-bold ms-sm-2">, </span>
                                @endif
                                <span class="text-dark font-weight-bold ms-sm-2">{{ $nurse2 }}</span>
                            @endif
                        </span>
                        <span class="mb-2 text-xs">Shift: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transaction->shift }}</span></span>
                        <span class="text-xs">Bill: <span class="text-dark ms-sm-2 font-weight-bold">Rp {{ number_format($transaction->bill) }}</span></span>
                        <span class="text-xs">Lab Bill: <span class="text-dark ms-sm-2 font-weight-bold">Rp {{ number_format($transaction->lab_bill) }}</span></span>
                        <span class="text-xs">Total Bill: <span class="text-dark ms-sm-2 font-weight-bold">Rp {{ number_format($transaction->total) }}</span></span>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('perawat.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
