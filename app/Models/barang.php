<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_brg';
    protected $fillable=[
        'kode_brg',
        'nama_brg',
        'harga',
        'merk',
        'harga',
        'jumlah'
    ];
    public function transaksi() {
        return $this->hasMany('App\Models\barang');
    }
}
