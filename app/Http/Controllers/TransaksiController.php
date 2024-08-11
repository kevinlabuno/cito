<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Type;
use App\Models\User;
use App\Models\Method;
use App\Models\Overtime;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $times= Time::all();
        $type= Type::all();
        $md = User::where('role', 'Dokter')->get();
        $overtime = Overtime::all();
        $method = Method::all();
        $nurse = User::where('role','Perawat')->get();

        $lastTransaction = \App\Models\Transaksi::orderBy('id', 'desc')->first();

        if ($lastTransaction) { 
        $lastNumber = intval(substr($lastTransaction->rekam, 3));
        $newNumber = $lastNumber + 1; } else {$newNumber = 1;} $newRekam = 'CMC' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        

        return view('transaksi.transaksi',compact('times','type','md','nurse','method','overtime','newRekam'));
    }



public function add_transaksi(Request $request)
{
    $request->validate([
        'rekam' => 'required|string|unique:transaksi,rekam',
        'pasien' => 'required|string',
        'shift' => 'required|string',
        'type' => 'required|string',
        'md' => 'required|string',
        'id_md' => 'required|string',
        'nurse1' => 'nullable|string',
        'id_nurse1' => 'nullable|string',
        'nurse2' => 'nullable|string',
        'id_nurse2' => 'nullable|string',
        'overtime' => 'nullable|string',
        'lokasi' => 'nullable|string', 
        'driver' => 'nullable|string',
        'pembayaran' => 'required|string',
        'admin' => 'required|string',
        'bill' => 'required|numeric',
        'lab_bill' => 'required|numeric',
        'total' => 'required|numeric',
    ]);

    $data = $request->only([
        'rekam', 'pasien', 'shift', 'type', 'md','id_md','id_nurse1','id_nurse2','nurse1', 'nurse2',
        'overtime', 'lokasi', 'driver', 'pembayaran', 'admin',
        'bill', 'lab_bill', 'total'
    ]);

    $data['lokasi'] = $data['lokasi'] ?? 'Jl Batu Belig No 199, Kerobokan Kelod, Kuta Utara';

    if (empty($data)) {
        return redirect()->back()->withErrors(['error' => 'Data tidak valid atau kosong']);
    }

    if (empty($request->id_md)) {
        $doctor = User::where('name', $request->md)->first();
        if ($doctor) {
            $request->merge(['id_md' => $doctor->id]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Dokter tidak ditemukan']);
        }
    }

if (!empty($request->nurse1) && empty($request->id_nurse1)) {
    $nurse1 = User::where('name', $request->nurse1)->first();
    if ($nurse1) {
        $request->merge(['id_nurse1' => $nurse1->id]);
    } else {
        return redirect()->back()->withErrors(['error' => 'Perawat 1 tidak ditemukan']);
    }
}

   if (!empty($request->nurse2) && empty($request->id_nurse2)) {
    $nurse2 = User::where('name', $request->nurse2)->first();
    if ($nurse2) {
        $request->merge(['id_nurse2' => $nurse2->id]);
    } else {
        return redirect()->back()->withErrors(['error' => 'Perawat 2 tidak ditemukan']);
    }
}

    $transaksi = new Transaksi($data);
    $transaksi->input = Auth::user()->name; 
    $transaksi->save();

    $userRole = Auth::user()->role;
    if (in_array($userRole, ['Super', 'IT', 'Admin'])) {
        return redirect()->route('daftar.transaksi')->with('success', 'Data berhasil disimpan!');
    } elseif (in_array($userRole, ['Dokter', 'Perawat'])) {
        return redirect()->route('harian.transaksi')->with('success', 'Data berhasil disimpan!');
    } else {
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}

public function data_transaksi(){
    $transactions = Transaksi::all();
    
    return view('transaksi.data',compact('transactions'));
}

public function harian_transaksi() {
    $today = \Carbon\Carbon::now('Asia/Makassar')->startOfDay();
    $user = auth()->user();

    if ($user->role === 'Super') {
        $transactions = Transaksi::whereBetween('created_at', [$today, $today->copy()->endOfDay()])->get();
        $userHasData = $transactions->isNotEmpty();
    } else {
        $transactions = Transaksi::whereBetween('created_at', [$today, $today->copy()->endOfDay()])
            ->where(function ($query) use ($user) {
                $query->where('md', $user->name)
                      ->orWhere('nurse1', $user->name)
                      ->orWhere('nurse2', $user->name)
                      ->orWhere('driver', $user->name)
                      ->orWhere('input', $user->name)
                      ->orWhere('pasien', $user->name);
            })
            ->get();
        $userHasData = $transactions->isNotEmpty();
    }

    return view('transaksi.harian', [
        'transactions' => $transactions,
        'userHasData' => $userHasData
    ]);
}






public function del_transaksi($id)
{
    $transaction = Transaksi::findOrFail($id);

    try {
        $transaction->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus transaksi.');
    }
}

public function edit_transaksi($id)
{
    $transaction = Transaksi::findOrFail($id);
    $times = Time::all(); 
    $type = Type::all();
    $md = User::where('role','Dokter')->get();
    $nurse = User::where('role','Perawat')->get();
    $overtime = Overtime::all();
    $method = Method::all();

    return view('transaksi.edit', compact('transaction', 'times', 'type', 'md', 'nurse', 'overtime', 'method'));
}

public function update_transaksi(Request $request, $id)
{
    $request->validate([
        'rekam' => 'required|string',
        'pasien' => 'required|string',
        'shift' => 'required|string',
        'type' => 'required|string',
        'md' => 'required|string',
        'nurse1' => 'nullable|string',
        'nurse2' => 'nullable|string',
        'overtime' => 'nullable|string',
        'lokasi' => 'required|string',
        'driver' => 'nullable|string',
        'pembayaran' => 'required|string',
        'admin' => 'required|numeric',
        'bill' => 'required|numeric',
        'lab_bill' => 'required|numeric',
        'total' => 'required|numeric',
    ]);

    $transaction = Transaksi::findOrFail($id);
    $transaction->update([
        'rekam' => $request->rekam,
        'pasien' => $request->pasien,
        'shift' => $request->shift,
        'type' => $request->type,
        'md' => $request->md,
        'id_md' =>$request->id_md,
        'nurse1' => $request->nurse1,
        'id_nurse1' =>$request->id_nurse1,
        'nurse2' => $request->nurse2,
        'id_nurse2' =>$request->id_nurse2,
        'overtime' => $request->overtime,
        'lokasi' => $request->lokasi,
        'driver' => $request->driver,
        'pembayaran' => $request->pembayaran,
        'admin' => $request->admin,
        'bill' => $request->bill,
        'lab_bill' => $request->lab_bill,
        'total' => $request->total,
    ]);

    if (empty($request->id_md)) {
        $doctor = User::where('name', $request->md)->first();
        if ($doctor) {
            $request->merge(['id_md' => $doctor->id]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Dokter tidak ditemukan']);
        }
    }

if (!empty($request->nurse1) && empty($request->id_nurse1)) {
    $nurse1 = User::where('name', $request->nurse1)->first();
    if ($nurse1) {
        $request->merge(['id_nurse1' => $nurse1->id]);
    } else {
        return redirect()->back()->withErrors(['error' => 'Perawat 1 tidak ditemukan']);
    }
}

   if (!empty($request->nurse2) && empty($request->id_nurse2)) {
    $nurse2 = User::where('name', $request->nurse2)->first();
    if ($nurse2) {
        $request->merge(['id_nurse2' => $nurse2->id]);
    } else {
        return redirect()->back()->withErrors(['error' => 'Perawat 2 tidak ditemukan']);
    }
}

    $user = auth()->user();

    if ($user->role === 'Perawat' || $user->role === 'Dokter') {
        return redirect()->route('harian.transaksi')->with('success', 'Data Transaksi Berhasil diubah!');
    }

    return redirect()->route('daftar.transaksi')->with('success', 'Data Transaksi Berhasil diubah!');
}

}
