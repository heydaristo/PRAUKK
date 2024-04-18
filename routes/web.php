<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;

// Index
Route::get('/', [DashboardController::class, 'index'])->name('index');
// Barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::post('/barang', [BarangController::class, 'tambahBarang'])->name('barang.tambah');
Route::get('/barang/{kode_brg}', [BarangController::class, 'editBarang'])->name('barang.edit');
Route::put('/barang/{kode_brg}', [BarangController::class, 'updateBarang'])->name('barang.update');
Route::delete('/barang/{kode_brg}', [BarangController::class, 'hapusBarang'])->name('barang.hapus');

// Transaksi

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::post('/transaksi', [TransaksiController::class, 'tambahTransaksi'])->name('transaksi.tambah');
Route::put('/transaksi/{kode_transaksi}', [TransaksiController::class, 'updateTransaksi'])->name('transaksi.update');
Route::delete('/transaksi/{kode_transaksi}', [TransaksiController::class, 'hapusTransaksi'])->name('transaksi.hapus');

