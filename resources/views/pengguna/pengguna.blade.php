@extends('layouts.user_type.auth')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid py-4">
  <div class="row">

    <!-- User List -->
 <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Daftar Pengguna</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pengguna</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        @if ($user->image)
                          <img src="{{ asset('assets/picture/' . $user->image) }}" class="avatar avatar-sm me-3" alt="user1">
                        @else
                          <img src="{{ asset('assets/img/user.png') }}" class="avatar avatar-sm me-3" alt="user1">
                        @endif
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h6 class="text-xs font-weight-bold mb-0">{{ $user->role }}</h6>
                  </td>
                  <td>
                    <h6 class="text-xs font-weight-bold mb-0">{{ $user->phone }}</h6>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-{{ $user->status ? 'success' : 'danger' }}">
                      {{ $user->status ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="align-middle">
                    <form method="POST" action="{{ route('toggle.status', $user->id) }}">
                      @csrf
                      <button type="submit" class="btn btn-{{ $user->status ? 'danger' : 'success' }} btn-sm">
                        {{ $user->status ? 'Nonaktifkan' : 'Aktifkan' }}
                      </button>
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

    <!-- Add User Form -->
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Tambah Pengguna</h6>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('add.pengguna') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label>Nama Pengguna</label>
              <input type="text" name="name" class="form-control" placeholder="Masukan Nama" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="Masukan Email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
              <label>Role</label>
              <select name="role" class="form-control" required>
                <option value="">Pilih Role</option>
                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Dokter" {{ old('role') == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                <option value="Super" {{ old('role') == 'Super' ? 'selected' : '' }}>Super</option>
                <option value="Perawat" {{ old('role') == 'Perawat' ? 'selected' : '' }}>Perawat</option>
                <option value="IT" {{ old('role') == 'IT' ? 'selected' : '' }}>IT</option>
              </select>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>
            <div class="mb-3">
              <label>Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
            </div>
            <div class="mb-3">
              <label>No Hp <i>Optional</i></label>
              <input type="number" name="phone" class="form-control" placeholder="Masukan No Hp" value="{{ old('phone') }}">
            </div>
            <div class="mb-3">
              <label>Image <i>Optional</i></label>
              <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection
