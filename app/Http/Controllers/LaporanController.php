<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index(){
        return view('laporan.index');
    }

    public function transaksi(){
        $transactions = Transaksi::all();
        return view('laporan.transaksi',compact('transactions'));
    }
}
