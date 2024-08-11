
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  <link rel="apple-touch-icon" sizes="76x76" href="http://127.0.0.1:8000/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="http://127.0.0.1:8000/assets/img/logos/logo2.png">
  <title>CITO Medical</title>

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="http://127.0.0.1:8000/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="http://127.0.0.1:8000/assets/css/nucleo-svg.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- CSS Files -->
  <link id="pagestyle" href="http://127.0.0.1:8000/assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

  <!-- DataTables Export Buttons CSS & JS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.2/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.7.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>

</head>

<body class="g-sidenav-show bg-gray-100 ">
                    <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 blur blur-rounded shadow py-2 start-0 end-0 mx4">
  <div class="container-fluid container-fluid">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="http://127.0.0.1:8000/dashboard">
      <img src="../assets/img/logos/logo2.png" class="navbar-brand-img h-100" alt="..." width="40px" >
       CITO Medical
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
         <a class="nav-link me-2" href="javascript:history.back()">
            <i class="fas fa-key opacity-6 me-1 text-dark"></i>
            Kembali
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
                </div>
            </div>
        </div>
      <hr>
        
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
              <div class="container-fluid py-4">
  <div class="row">
    <br><hr>
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6>Laporan Transaksi</h6>
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
    </tr>
</tfoot>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>
      </div>
    </section>
  </main>

      
  <script src="http://127.0.0.1:8000/assets/js/core/popper.min.js"></script>
  <script src="http://127.0.0.1:8000/assets/js/core/bootstrap.min.js"></script>
  <script src="http://127.0.0.1:8000/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="http://127.0.0.1:8000/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="http://127.0.0.1:8000/assets/js/plugins/fullcalendar.min.js"></script>
  <script src="http://127.0.0.1:8000/assets/js/plugins/chartjs.min.js"></script>
      <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script src="http://127.0.0.1:8000/assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
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
</body>

</html>
