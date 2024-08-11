@extends('layouts.user_type.auth')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12 mt-4">
      <div class="card">
        <div class="card-header pb-0 px-3">
          <h6 class="mb-0">Transaksi Hari ini</h6>
          <input type="text" id="searchInput" class="form-control mt-2" placeholder="Cari transaksi...">
        </div>
        <div class="card-body pt-4 p-3">
          @if($userHasData)
            <ul id="transactionList" class="list-group">
              @foreach ($transactions as $item)
              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg transaction-item">
                <div class="d-flex flex-column">
                  <p class="mb-3 text-sm">Transaksi Pasien - {{ $item->created_at->format('l, d F Y, H:i') }}</p>
                  <h6 class="mb-3 text-sm">{{ $item->pasien }}</h6>
                  <span class="mb-2 text-xs">MD: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->md }}</span></span>
                  @if($item->nurse1 || $item->nurse2)
                    <span class="mb-2 text-xs">Perawat: 
                      @if($item->nurse1)
                        <span class="text-dark font-weight-bold ms-sm-2">{{ $item->nurse1 }}</span>
                      @endif
                      @if($item->nurse2)
                        @if($item->nurse1)
                          <span class="text-dark font-weight-bold ms-sm-2">, </span>
                        @endif
                        <span class="text-dark font-weight-bold ms-sm-2">{{ $item->nurse2 }}</span>
                      @endif
                    </span>
                  @endif
                  <span class="mb-2 text-xs">Shift: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->shift }}</span></span>
                  <span class="text-xs">Total Bill: <span class="text-dark ms-sm-2 font-weight-bold">Rp {{ number_format($item->total) }}</span></span>
                </div>
                <div class="ms-auto text-end">
                  <a href="{{ route('edit.transaksi', $item->id) }}" class="btn btn-link text-dark px-3 mb-0">
                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit
                  </a>
                </div>
              </li>
              @endforeach
            </ul>
          @else
            <p class="text-center">Tidak ada data transaksi</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const transactionList = document.getElementById('transactionList');

    searchInput.addEventListener('input', function() {
      const searchTerm = searchInput.value.toLowerCase();
      const items = Array.from(transactionList.getElementsByClassName('transaction-item'));

      items.forEach(item => {
        const textContent = item.textContent.toLowerCase();
        if (textContent.includes(searchTerm)) {
          item.style.display = ''; // Show matching items
        } else {
          item.style.display = 'none'; 
        }
      });

      const matchingItems = items.filter(item => item.style.display === '');
      const nonMatchingItems = items.filter(item => item.style.display === 'none');

      matchingItems.forEach(item => transactionList.appendChild(item));
      nonMatchingItems.forEach(item => transactionList.appendChild(item));
    });
  });
</script>

@endsection
