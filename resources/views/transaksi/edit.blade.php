@extends('layouts.user_type.auth')

@section('content')

<div class="row">
  <div class="col-xl-12 col-sm-12 mb-xl-0 mb-12">
    <div class="card">
      <div class="card-body p-3">
        <div class="card-body">
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
          
          <div class="text-start mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
          <form role="form" action="{{ route('update.transaksi', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Field form untuk transaksi yang ada -->
            <label>No Rekam Medis</label>
            <div class="mb-3">
              <input type="text" name="rekam" id="rekam" class="form-control" value="{{ $transaction->rekam }}" required>
            </div>

            <!-- Field lainnya dengan nilai default dari transaksi -->
            <label>Nama Pasien</label>
            <div class="mb-3">
              <input type="text" name="pasien" id="pasien" class="form-control" value="{{ $transaction->pasien }}" required>
            </div>

            <!-- Dropdown Shift -->
            <label>Shift</label>
            <div class="mb-3">
              <select name="shift" id="shift" class="form-control" required>
                <option value="">-- Pilih Shift --</option>
                @foreach($times as $time)
                  <option value="{{ $time->jenis }}" {{ $transaction->shift == $time->jenis ? 'selected' : '' }}>
                    {{ $time->jenis }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Dropdown WI/OC -->
            <label>WI/OC</label>
            <div class="mb-3">
              <select name="type" id="type" class="form-control" required>
                <option value="">-- Pilih WI/OC --</option>
                @foreach($type as $t)
                  <option value="{{ $t->jenis }}" {{ $transaction->type == $t->jenis ? 'selected' : '' }}>
                    {{ $t->jenis }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Dropdown MD -->
            <label>MD</label>
            <div class="mb-3">
              <select name="md" id="md" class="form-control" required>
                <option value="">-- Pilih MD --</option>
                @foreach($md as $doctor)
                  <option value="{{ $doctor->name }}" data-id="{{ $doctor->id }}" {{ $transaction->md == $doctor->name ? 'selected' : '' }}>
                    {{ $doctor->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Dropdown Nurse 1 -->
            <label>Perawat 1</label>
            <div class="mb-3">
              <select name="nurse1" id="nurse1" class="form-control">
                <option value="">-- Pilih Nurse 1 --</option>
                @foreach($nurse as $n)
                  <option value="{{ $n->name }}" data-id="{{ $n->id }}" {{ $transaction->nurse1 == $n->name ? 'selected' : '' }}>
                    {{ $n->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Dropdown Nurse 2 -->
            <label>Perawat 2</label>
            <div class="mb-3">
              <select name="nurse2" id="nurse2" class="form-control">
                <option value="">-- Pilih Nurse 2 --</option>
                @foreach($nurse as $n)
                  <option value="{{ $n->name }}" data-id="{{ $n->id }}" {{ $transaction->nurse2 == $n->name ? 'selected' : '' }}>
                    {{ $n->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="id_md" id="id_md" value="{{ $transaction->id_md }}">
            <input type="hidden" name="id_nurse1" id="id_nurse1" value="{{ $transaction->id_nurse1 }}">
            <input type="hidden" name="id_nurse2" id="id_nurse2" value="{{ $transaction->id_nurse2 }}">
            
            <label>Overtime</label>
            <div class="mb-3">
              <select name="overtime" id="overtime" class="form-control">
                <option value="">-- Pilih Overtime --</option>
                @foreach($overtime as $o)
                  <option value="{{ $o->id }}" {{ $transaction->overtime == $o->jenis ? 'selected' : '' }}>
                    {{ $o->jenis }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Dropdown Method (Pembayaran) -->
            <label>Jenis Pembayaran</label>
            <div class="mb-3">
              <select name="pembayaran" id="pembayaran" class="form-control" required>
                <option value="">-- Pilih Jenis Pembayaran --</option>
                @foreach($method as $m)
                  <option value="{{ $m->jenis }}" {{ $transaction->pembayaran == $m->jenis ? 'selected' : '' }}>
                    {{ $m->jenis }}
                  </option>
                @endforeach
              </select>
            </div>

            <label>Lokasi</label>
            <div class="mb-3">
              <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $transaction->lokasi }}" required>
            </div>

            <label>Biaya Admin</label>
            <div class="mb-3">
              <input type="number" name="admin" id="admin" class="form-control" value="{{ $transaction->admin }}" required>
            </div>
            
            <label>Total Bill</label>
            <div class="mb-3">
              <!-- Display Total Bill as formatted currency -->
              <input type="text" name="total" id="total" class="form-control" value="{{ number_format($transaction->total, 0, ',', '.') }}" >
              <input type="hidden" name="total_raw" id="total_raw" value="{{ $transaction->total }}">
            </div>

            <label>Lab Bill</label>
            <div class="mb-3">
              <!-- Use number input for raw value -->
              <input type="number" name="lab_bill" id="lab_bill" class="form-control" value="{{ $transaction->lab_bill }}" required>
            </div>

            <label>Bill</label>
            <div class="mb-3">
              <!-- Display Bill as formatted currency -->
              <input type="text" name="bill" id="bill" class="form-control" readonly>
              <input type="hidden" id="bill_raw" name="bill" value="{{ $transaction->bill }}">
            </div>


            <div class="text-center">
              <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function formatCurrency(value) {
    return `Rp ${value.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`;
  }

  function parseCurrency(value) {
    return parseFloat(value.replace(/[^\d]/g, '')) || 0;
  }

  function updateBill() {
    let totalField = document.getElementById('total');
    let labBillField = document.getElementById('lab_bill');
    let billField = document.getElementById('bill');
    let totalRawField = document.getElementById('total_raw');
    let billRawField = document.getElementById('bill_raw');

    let total = parseCurrency(totalField.value);
    let labBill = parseCurrency(labBillField.value);
    let bill = total - labBill;

    // Update display field with formatted bill
    billField.value = formatCurrency(bill);
    
    // Store raw values for form submission
    billRawField.value = bill;
  }

  document.getElementById('total').addEventListener('input', updateBill);
  document.getElementById('lab_bill').addEventListener('input', updateBill);

  document.addEventListener('DOMContentLoaded', function () {
    updateBill();
  });

  document.getElementById('md').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var doctorId = selectedOption.getAttribute('data-id');
    document.getElementById('id_md').value = doctorId;
  });

  document.getElementById('nurse1').addEventListener('change', function() {
    var selectoption2 = this.options[this.selectedIndex];
    var nurse1ID = selectoption2.getAttribute('data-id');
    document.getElementById('id_nurse1').value = nurse1ID;
  });

  document.getElementById('nurse2').addEventListener('change', function() {
    var selectoption3 = this.options[this.selectedIndex];
    var nurse2ID = selectoption3.getAttribute('data-id');
    document.getElementById('id_nurse2').value = nurse2ID;
  });
</script>

@endsection
