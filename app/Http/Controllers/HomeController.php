<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('beranda');
    }
}
