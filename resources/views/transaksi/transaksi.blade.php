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
                 <form role="form" action="{{ route('add.transaksi') }}" method="POST">
                     @csrf

                  <label>No Rekam Medis</label>
                  <div class="mb-3">
                  <input type="text" name="rekam" id="rekam" value="{{$newRekam}}" class="form-control" placeholder="rekam" aria-label="rekam" aria-describedby="rekam-addon" required readonly>
                  </div>

                  <label>Nama Pasien</label>
                  <div class="mb-3">
                  <input type="text" name="pasien" id="pasien" class="form-control" placeholder="pasien" aria-label="pasien" aria-describedby="pasien-addon" required>
                  </div>

                  <label>Shift</label>
                  <div class="mb-3">
                  <select name="shift" id="shift" class="form-control" required>
                    @foreach($times as $time)
                                <option value="{{ $time->jenis }}">{{ $time->jenis }}</option>
                    @endforeach
                  </select>
                  </div>


                  <label>WI/OC</label>
                  <div class="mb-3">
                  <select name="type" id="type" class="form-control" required>
                    @foreach($type as $time)
                        <option value="{{ $time->jenis }}">{{ $time->jenis }}</option >
                    @endforeach
                  </select>
                  </div>

                  <label>MD</label>
                  <div class="mb-3">
                      <select name="md" id="md" class="form-control" required>
                        <option value="">Pilih Dokter</option>
                          @foreach($md as $doctor)
                            <option value="{{ $doctor->name }}" data-id="{{ $doctor->id }}">{{ $doctor->name }}</option>
                          @endforeach
                      </select>
                   </div>

                  <input type="text" name="id_md" id="id_md" hidden>

                  <label>Perawat 1 <i>(Optional)</i></label>
                  <div class="mb-3">
                  <select name="nurse1" id="nurse1" class="form-control">
                    <option value="">Pilih Perawat</option>
                    @foreach($nurse as $time)
                       <option value="{{ $time->name }}" data-id="{{$time->id}}">{{ $time->name }}</option>
                    @endforeach
                  </select>
                  </div>

                  <input type="text" name="id_nurse1" id="id_nurse1" hidden>

                  <label>Perawat 2 <i>(Optional)</i></label>
                  <div class="mb-3">
                  <select name="nurse2" id="nurse2" class="form-control">
                    <option value="">Pilih Perawat</option>
                     @foreach($nurse as $time)
                       <option value="{{ $time->name }}" data-id="{{$time->id}}">{{ $time->name }}</option>
                    @endforeach
                  </select>
                  </div>
                   
                  <input type="text" name="id_nurse2" id="id_nurse2" hidden>

                  <label>Overtime <i>(Optional)</i></label>
                  <div class="mb-3">
                  <select name="overtime" id="overtime" class="form-control">
                    <option value="">Pilih Waktu</option>
                     @foreach($overtime as $time)
                       <option value="{{ $time->jenis }}">{{ $time->jenis }}</option>
                    @endforeach
                  </select>
                  </div>

                  <label>Lokasi</label>
                  <div class="mb-3">
                  <input type="text" required name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi" aria-label="Lokasi" value="Jl Batu Belig No 199, Kerobokan Kelod, Kuta Utara" aria-describedby="Lokasi">
                  </div>

                  <label>Driver <i>(Optional)</i></label>
                  <div class="mb-3">
                  <input type="text" name="driver" id="driver" class="form-control" placeholder="driver" aria-label="driver" aria-describedby="driver">
                  </div>

                  <label>Jenis Pembayaran</label>
                  <div class="mb-3">
                  <select name="pembayaran" required id="pembayaran" class="form-control" name="pembayaran">
                    <option value="">Pilih Jenis Pembayaran</option>
                     @foreach($method as $time)
                       <option value="{{ $time->jenis }}">{{ $time->jenis }}</option>
                    @endforeach
                  </select>
                  </div>

                  <label>Biaya Admin</label>
                  <div class="mb-3">
                  <input type="text" name="admin" required id="admin" class="form-control" placeholder="Rp" aria-label="Rp" aria-describedby="Rp">
                  </div>

                  <label>Total Bill</label>
<div class="mb-3">
  <input type="number" id="total" required name="total" class="form-control" placeholder="Rp" aria-label="Rp">
  <input type="hidden" id="total_raw" name="total_raw"> <!-- Hidden field to store raw total value -->
</div>

<label>Lab Bill</label>
<div class="mb-3">
  <input type="number" required name="lab_bill" id="lab_bill" class="form-control" placeholder="Rp" aria-label="Rp">
</div>

<label>Bill</label>
<div class="mb-3">
  <input type="text" name="bill" id="bill" class="form-control" placeholder="Rp" aria-label="Rp" readonly>
  <input type="hidden" id="bill_raw" name="bill"> <!-- Hidden field to store raw bill value -->
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
    return parseFloat(value.replace(/[^0-9.-]+/g, "")) || 0;
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

    // Update formatted display value for Bill
    billField.value = formatCurrency(bill);

    // Store raw values for database
    totalRawField.value = total;
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


