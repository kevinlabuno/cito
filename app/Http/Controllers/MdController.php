<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MdController extends Controller
{
public function index(){
    $user = Auth::user();

    if ($user->role == 'Dokter') {
        // Jika role adalah Dokter, tampilkan hanya data untuk dokter yang sedang login
        $data = Transaksi::select('md', 'id_md')
            ->selectRaw('count(pasien) as pasien_count')
            ->selectRaw('sum(bill) as bill_total')
            ->where('md', $user->name)
            ->groupBy('md', 'id_md')
            ->get();
    } elseif ($user->role == 'Super') {
        // Jika role adalah Super, tampilkan semua data
        $data = Transaksi::select('md', 'id_md')
            ->selectRaw('count(pasien) as pasien_count')
            ->selectRaw('sum(bill) as bill_total')
            ->groupBy('md', 'id_md')
            ->get();
    } else {
        $data = collect(); 
    }
    
    foreach ($data as $item) {
        $item->image = DB::table('users')
            ->where('id', $item->id_md)
            ->value('picture');
    }

    return view('md.index', compact('data'));
}

    public function detail($id_md) {
    // Mengambil data transaksi berdasarkan id_md
    $transactions = Transaksi::where('id_md', $id_md)->get();

    // Mengambil data pengguna berdasarkan id_md (atau ID dokter, jika relevan)
    $user = User::where('id', $id_md)->first(); // Sesuaikan query ini dengan kebutuhan Anda

    return view('md.detail', [
        'transactions' => $transactions,
        'user' => $user
    ]);
}


}
