<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;

class BerandaController extends Controller
{
    public function index(){
        $today = Carbon::today();

        $pasientoday = Transaksi::whereDate('created_at', $today)->count('pasien');
        $billtoday = Transaksi::whereDate('created_at', $today)->sum('bill');
        $labbilltoday = Transaksi::whereDate('created_at', $today)->sum('lab_bill');
        $totaltoday = Transaksi::whereDate('created_at', $today)->sum('total');


        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek();

        $pasienWeek = Transaksi::whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])->count('pasien');
        $billWeek = Transaksi::whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])->sum('bill');
        $labbillWeek = Transaksi::whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])->sum('lab_bill');
        $totalWeek = Transaksi::whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])->sum('total');

        $thisMonthStart = Carbon::now()->startOfMonth();
        $thisMonthEnd = Carbon::now()->endOfMonth();

        $pasienMonth = Transaksi::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count('pasien');
        $billMonth = Transaksi::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('bill');
        $labbillMonth = Transaksi::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('lab_bill');
        $totalMonth = Transaksi::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('total');
        

        return view('beranda.beranda',compact('pasientoday','billtoday','labbilltoday','totaltoday','pasienWeek',
        'billWeek','labbillWeek','totalWeek','pasienMonth','billMonth','labbillMonth','totalMonth'));
    }

    public function coming(){
        return view ('coming.coming');
    }
}
