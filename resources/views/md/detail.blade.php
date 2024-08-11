@extends('layouts.user_type.auth')

<style>
.transaction-item {
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.transaction-item[style*="display: none"] {
  opacity: 0;
  transform: scale(0.95);
}
</style>
@section('content')

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
    <img src="{{ $user->profile_photo_path ? asset('assets/picture/' . $user->profile_photo_path) : asset('assets/img/user.png') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
</div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->role }} {{-- Misalnya, "Dokter" atau "Nurse" --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="doctorName" data-name="{{ $user->name }}" hidden></div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Detail Transaksi</h6>
                    <input type="text" id="searchInput" class="form-control mt-2" placeholder="Cari transaksi...">
                    <div class="mt-2">
                        <button id="exportCsvBtn" class="btn btn-secondary mt-2">Export to CSV</button>
                    </div>
                </div>

                <div class="card-body pt-4 p-3">
                    @if($transactions->count())
                        <ul id="transactionList" class="list-group">
                            @foreach ($transactions as $item)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg transaction-item">
                                    <div class="d-flex flex-column">
                                        <p class="mb-3 text-sm">Transaksi Pasien - {{ $item->created_at->format('l, d F Y, H:i') }}</p>
                                        <h6 class="mb-3 text-sm">{{ $item->pasien }} - {{$item->rekam}}</h6>
                                        <span class="mb-2 text-xs">MD: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->md }}</span></span>
                                        @if($item->nurse1 || $item->nurse2)
                                            <span class="mb-2 text-xs">Nurse: 
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
                                        <span class="text-xs">Bill: <span class="text-dark ms-sm-2 font-weight-bold">Rp {{ number_format($item->bill) }}</span></span>
                                        <span class="text-xs">Lab Bill: <span class="text-dark ms-sm-2 font-weight-bold">Rp {{ number_format($item->lab_bill) }}</span></span>
                                        <span class="text-xs">Total Bill: <span class="text-dark ms-sm-2 font-weight-bold">Rp {{ number_format($item->total) }}</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        {{-- <a href="{{ route('edit.transaksi', $item->id) }}" class="btn btn-link text-dark px-3 mb-0">
                                            <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit
                                        </a> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.6.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.17/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const transactionList = document.getElementById('transactionList');
  const exportCsvBtn = document.getElementById('exportCsvBtn');

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

  exportCsvBtn.addEventListener('click', function() {
    const rows = [];
    const headers = ['Tanggal & Waktu', 'Rekam Medis', 'MD', 'Nurse', 'Bill', 'Lab Bill', 'Total Bill'];

    rows.push(headers);

    Array.from(transactionList.getElementsByClassName('transaction-item')).forEach(item => {
      const tanggalWaktu = item.querySelector('p.mb-3').textContent.replace('Transaksi Pasien - ', '');
      const rekamMedis = item.querySelector('h6.mb-3').textContent;

      // Retrieve MD
      const mdSpan = Array.from(item.getElementsByTagName('span')).find(span => span.textContent.includes('MD:'));
      const md = mdSpan ? mdSpan.textContent.replace('MD: ', '') : '';

      // Retrieve Nurse
      const nurseSpan = Array.from(item.getElementsByTagName('span')).find(span => span.textContent.includes('Nurse:'));
      const nurse = nurseSpan ? nurseSpan.textContent.replace('Nurse: ', '').trim() : '';

      // Retrieve Bill
      const billSpan = Array.from(item.getElementsByTagName('span')).find(span => span.textContent.includes('Bill:'));
      const bill = billSpan ? billSpan.textContent.replace('Bill: Rp ', '') : '';

      // Retrieve Lab Bill
      const labBillSpan = Array.from(item.getElementsByTagName('span')).find(span => span.textContent.includes('Lab Bill:'));
      const labBill = labBillSpan ? labBillSpan.textContent.replace('Lab Bill: Rp ', '') : '';

      // Retrieve Total Bill
      const totalBillSpan = Array.from(item.getElementsByTagName('span')).find(span => span.textContent.includes('Total Bill:'));
      const totalBill = totalBillSpan ? totalBillSpan.textContent.replace('Total Bill: Rp ', '') : '';

      rows.push([tanggalWaktu, rekamMedis, md, nurse, bill, labBill, totalBill]);
    });

    const csv = Papa.unparse(rows);

    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    if (link.download !== undefined) { // feature detection
      const url = URL.createObjectURL(blob);
      link.setAttribute('href', url);
      
      // Ambil nama dokter dari elemen HTML
      const doctorNameElement = document.getElementById('doctorName');
      const doctorName = doctorNameElement ? doctorNameElement.getAttribute('data-name').trim() : 'dokter';

      // Set nama file
      link.setAttribute('download', `${doctorName} - detail transaksi.csv`);
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  });
});

</script>

@endsection
