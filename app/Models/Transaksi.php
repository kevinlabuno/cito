<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['rekam','pasien','shift','type','md','nurse1','nurse2','id_md','id_nurse1','id_nurse2',
                           'overtime','lokasi','driver','pembayaran','admin','bill',
                           'lab_bill','total','input'];
}
