@extends('layouts.user_type.auth')

@section('content')


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Waktu Shift</h6>
          <form class="d-flex justify-content-between align-items-center mt-3" method="POST" action="{{ route('add.time') }}">
            @csrf
            <div class="d-flex flex-grow-1 align-items-center">
              <div class="me-3">
                <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Shift" aria-label="Shift" aria-describedby="Shift" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Shift</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($time as $key => $time)
                <tr>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $key + 1 }}</span>
                  </td>
                  <td class="align-middle text-center text-md">
                        @if ($time->jenis == 'Pagi')
                            <span class="badge badge-md bg-gradient-primary">{{ $time->jenis }}</span>
                        @elseif($time->jenis == 'Siang')                        
                            <span class="badge badge-sm bg-gradient-success">{{ $time->jenis }}</span>
                        @elseif($time->jenis == 'Sore')
                            <span class="badge badge-sm bg-gradient-warning">{{ $time->jenis }}</span>
                        @elseif($time->jenis == 'Malam')
                            <span class="badge badge-sm bg-gradient-primary">{{ $time->jenis }}</span>
                        @else
                            <span class="badge badge-sm bg-gradient-secondary">{{$time->jenis}}</span>
                        @endif
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $time->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <form action="{{ route('del.time', $time->id) }}" method="POST" onsubmit="return confirm('Ingin menghapus data ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Type WI/ON</h6>
          <form class="d-flex justify-content-between align-items-center mt-3" method="POST" action="{{ route('add.type') }}">
            @csrf
            <div class="d-flex flex-grow-1 align-items-center">
              <div class="me-3">
                <input type="text" name="type" id="type" class="form-control" placeholder="Masukan Type" aria-label="type" aria-describedby="type" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($type as $key => $type)
                <tr>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $key + 1 }}</span>
                  </td>
                  <td class="align-middle text-center text-md">
                        @if ($type->jenis == 'Walk In')
                            <span class="badge badge-md bg-gradient-primary">{{ $type->jenis }}</span>
                        @elseif($type->jenis == 'On Call')                        
                            <span class="badge badge-sm bg-gradient-success">{{ $type->jenis }}</span>
                        @elseif($type->jenis == 'WO')                        
                            <span class="badge badge-sm bg-gradient-primary">{{ $type->jenis }}</span>
                        @elseif($type->jenis == 'ON')                        
                            <span class="badge badge-sm bg-gradient-success">{{ $type->jenis }}</span>
                        @else
                            <span class="badge badge-sm bg-gradient-secondary">{{$type->jenis}}</span>
                        @endif
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $type->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <form action="{{ route('del.type', $type->id) }}" method="POST" onsubmit="return confirm('Ingin menghapus data ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Jenis Pembayaran</h6>
          <form class="d-flex justify-content-between align-items-center mt-3" method="POST" action="{{ route('add.method') }}">
            @csrf
            <div class="d-flex flex-grow-1 align-items-center">
              <div class="me-3">
                <input type="text" name="method" id="method" class="form-control" placeholder="Masukan Metode Pembayaran" aria-label="method" aria-describedby="method" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembayaran</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($method as $key => $type)
                <tr>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $key + 1 }}</span>
                  </td>
                  <td class="align-middle text-center text-md">
                        @if ($type->jenis == 'Cash')
                            <span class="badge badge-md bg-gradient-primary">{{ $type->jenis }}</span>
                        @elseif($type->jenis == 'QRIS')                        
                            <span class="badge badge-sm bg-gradient-success">{{ $type->jenis }}</span>
                        @else
                            <span class="badge badge-sm bg-gradient-secondary">{{$type->jenis}}</span>
                        @endif
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $type->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <form action="{{ route('del.method', $type->id) }}" method="POST" onsubmit="return confirm('Ingin menghapus data ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Overtime</h6>
          <form class="d-flex justify-content-between align-items-center mt-3" method="POST" action="{{ route('add.overtime') }}">
            @csrf
            <div class="d-flex flex-grow-1 align-items-center">
              <div class="me-3">
                <input type="text" name="overtime" id="overtime" class="form-control" placeholder="Masukan Metode Pembayaran" aria-label="overtime" aria-describedby="overtime" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembayaran</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($overtime as $key => $type)
                <tr>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $key + 1 }}</span>
                  </td>
                  <td class="align-middle text-center text-md">
                        @if ($type->jenis == 'Cash')
                            <span class="badge badge-md bg-gradient-primary">{{ $type->jenis }}</span>
                        @elseif($type->jenis == 'QRIS')                        
                            <span class="badge badge-sm bg-gradient-success">{{ $type->jenis }}</span>
                        @else
                            <span class="badge badge-sm bg-gradient-secondary">{{$type->jenis}}</span>
                        @endif
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $type->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <form action="{{ route('del.overtime', $type->id) }}" method="POST" onsubmit="return confirm('Ingin menghapus data ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
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
