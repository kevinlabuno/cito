<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NurseController extends Controller
{
public function index()
    {
        $user = Auth::user();
        $data = collect();

        if ($user->role == 'Perawat') {
            $transactions = Transaksi::where(function ($query) use ($user) {
                $query->where('id_nurse1', $user->id)
                      ->orWhere('id_nurse2', $user->id);
            })->get();

            $nurseData = [];

            foreach ($transactions as $item) {
                $nurses = [];
                if ($item->id_nurse1) {
                    $nurse1 = DB::table('users')->where('id', $item->id_nurse1)->value('name');
                    if ($nurse1) {
                        $nurses[$nurse1] = $item->bill;
                    }
                }
                if ($item->id_nurse2) {
                    $nurse2 = DB::table('users')->where('id', $item->id_nurse2)->value('name');
                    if ($nurse2) {
                        $nurses[$nurse2] = $item->bill;
                    }
                }

                foreach ($nurses as $nurse => $bill) {
                    if (!isset($nurseData[$nurse])) {
                        $nurseData[$nurse] = [
                            'nurse' => $nurse,
                            'pasien_count' => 0,
                            'bill_total' => 0,
                            'picture' => DB::table('users')->where('name', $nurse)->value('picture'),
                        ];
                    }
                    $nurseData[$nurse]['pasien_count'] += 1;
                    $nurseData[$nurse]['bill_total'] += $bill;
                }
            }

            $data = collect($nurseData);
        } elseif ($user->role == 'Super') {
            $transactions = Transaksi::get();

            $nurseData = [];

            foreach ($transactions as $item) {
                $nurses = [];
                if ($item->id_nurse1) {
                    $nurse1 = DB::table('users')->where('id', $item->id_nurse1)->value('name');
                    if ($nurse1) {
                        $nurses[$nurse1] = $item->bill;
                    }
                }
                if ($item->id_nurse2) {
                    $nurse2 = DB::table('users')->where('id', $item->id_nurse2)->value('name');
                    if ($nurse2) {
                        $nurses[$nurse2] = $item->bill;
                    }
                }

                foreach ($nurses as $nurse => $bill) {
                    if (!isset($nurseData[$nurse])) {
                        $nurseData[$nurse] = [
                            'nurse' => $nurse,
                            'pasien_count' => 0,
                            'bill_total' => 0,
                            'picture' => DB::table('users')->where('name', $nurse)->value('picture'),
                             'id' => $item->id
                        ];
                    }
                    $nurseData[$nurse]['pasien_count'] += 1;
                    $nurseData[$nurse]['bill_total'] += $bill;
                }
            }

            $data = collect($nurseData);
        }

        return view('perawat.index', ['data' => $data]);
    }

public function detail($id)
{
    // Ambil transaksi berdasarkan ID
    $transaction = Transaksi::find($id);

    // Jika transaksi tidak ditemukan, redirect atau tampilkan error
    if (!$transaction) {
        return redirect()->route('perawat.index')->with('error', 'Transaksi tidak ditemukan');
    }

    // Ambil informasi MD dan Nurse dari tabel users
    $md = DB::table('users')->where('id', $transaction->id_md)->value('name');
    $nurse1 = $transaction->id_nurse1 ? DB::table('users')->where('id', $transaction->id_nurse1)->value('name') : null;
    $nurse2 = $transaction->id_nurse2 ? DB::table('users')->where('id', $transaction->id_nurse2)->value('name') : null;

    return view('perawat.detail', [
        'transaction' => $transaction,
        'md' => $md,
        'nurse1' => $nurse1,
        'nurse2' => $nurse2,
    ]);
}



}


