@extends('layouts.user_type.auth')

@section('content')
<style>
    #transactionsTable tbody td, #transactionsTable tfoot th {
        font-size: 12px; /* Sesuaikan dengan ukuran yang kamu inginkan */
    }

        #transactionsTable tfoot th {
        font-size: 12px; /* Ukuran teks footer */
        font-weight: normal; /* Jika ingin teks footer tidak tebal */
    }
</style>

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
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6>Daftar Transaksi</h6>
          {{-- <a href="{{ route('transactions.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> Tambah Transaksi
          </a> --}}
        </div>
        <div class="card-body px-3 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table id="transactionsTable" class="table table-striped align-items-center mb-0"> 
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekam Medis</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pasien</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Shift</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">WI/OC</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">MD</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perawat 1</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perawat 2</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Overtime</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lokasi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Driver</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Pembayaran</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Biaya Admin</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Bill</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lab Bill</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bill</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($transactions as $transaction)
                <tr>
                  <td class="align-middle text-center text-md"><b>{{ $transaction->rekam }}</b></td>
                  <td class="align-middle text-center text-md">{{ $transaction->pasien }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->shift }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->type }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->md }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->nurse1 }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->nurse2 }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->overtime }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->lokasi }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->driver }}</td>
                  <td class="align-middle text-center text-md">{{ $transaction->pembayaran }}</td>
                  <td class="align-middle text-center text-md">{{ number_format($transaction->admin, 0, ',', '.') }}</td>
                  <td class="align-middle text-center text-md">{{ number_format($transaction->total, 0, ',', '.') }}</td>
                  <td class="align-middle text-center text-md">{{ number_format($transaction->lab_bill, 0, ',', '.') }}</td>
                  <td class="align-middle text-center text-md">{{ number_format($transaction->bill, 0, ',', '.') }}</td>
                  <td class="align-middle text-center">{{ $transaction->created_at->format('l, d F Y') }}</td>
                  <td class="align-middle text-center text-md">
                    <a href="{{ route('edit.transaksi', $transaction->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('del.transaksi', $transaction->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Ingin menghapus data? Data akan hilang dan tidak bisa dikembalikan');">
                        @csrf
                             @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                                </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
    <tr>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
        <th class="align-middle text-center text-md"></th>
    </tr>
</tfoot>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Helper function to parse numbers correctly
    var intVal = function (i) {
        return typeof i === 'string' ?
            parseFloat(i.replace(/[^\d,-]/g, '').replace(',', '.')) : 
            typeof i === 'number' ?
                i : 0;
    };

    // Initialize DataTable with custom footer callback
    $('#transactionsTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'pdf'
        ],
        "order": [[ 0, "desc" ]], // Default sorting by first column
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();

            // Calculate the sum for Admin, Bill, Lab Bill, and Total columns
            var adminTotal = api
                .column(11, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var billTotal = api
                .column(12, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var labBillTotal = api
                .column(13, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var totalBillTotal = api
                .column(14, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update the footer with formatted numbers
            $(api.column(11).footer()).html(adminTotal.toLocaleString('id-ID'));
            $(api.column(12).footer()).html(billTotal.toLocaleString('id-ID'));
            $(api.column(13).footer()).html(labBillTotal.toLocaleString('id-ID'));
            $(api.column(14).footer()).html(totalBillTotal.toLocaleString('id-ID'));
        }
    });

    // Adding filter for each column
    $('#transactionsTable thead tr').clone(true).appendTo('#transactionsTable thead');
    $('#transactionsTable thead tr:eq(1) th').each(function (i) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');

        $('input', this).on('keyup change', function () {
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });

    var table = $('#transactionsTable').DataTable();
});
</script>



@endsection
