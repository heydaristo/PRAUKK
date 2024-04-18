<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_transaksi';
    protected $fillable=[
        'kode_transaksi',
        'kode_brg',
        'nama_brg',
        'jumlah',
        'harga',
        'total_bayar',
        'tanggal'
    ];
    public function barang() {
        return $this->belongsTo('App\Models\barang');
    }
}
