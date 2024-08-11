@extends('layouts.user_type.auth')

@section('content')
    <h6>Daftar Laporan</h6>
    <div class="row">
        <a class="col-xl-3 col-sm-6 mb-xl-0 mb-4" href="{{route('laporan.transaksi')}}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                    <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Laporan</p>
                    <h5 class="font-weight-bolder mb-0">
                     Transaksi
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                 </div>
                </div>
             </div>
            </div>
        </div>
    </a>

    <a class="col-xl-3 col-sm-6 mb-xl-0 mb-4" href="{{route('coming')}}">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Laporan</p>
                <h5 class="font-weight-bolder mb-0">
                 Stok Obat
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>

    <a class="col-xl-3 col-sm-6 mb-xl-0 mb-4" href="{{route('coming')}}">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jadwal</p>
                <h5 class="font-weight-bolder mb-0">
                 Shift
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    </div>
@endsection