<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\barang;

class TransaksiController extends Controller
{
    public function index(Request $request) {
        $transaksis = Transaksi::paginate(5);
          $barangs = Barang::paginate(5);

                // jika permintaan memiliki data_count_shows
              if ($request->input('data_count_shows') != null) {
                $dataCountShows = $request->input('data_count_shows');
                $transaksis = Transaksi::paginate($dataCountShows);
                return view('point.transaksi', compact('transaksis'));
            }
    
            // jika permintaan memiliki pencarian
            if ($request->input('search') != null) {
                $transaksis = Transaksi::where('kode_transaksi', 'like', '00'. $request->search . '%')
                                ->orWhere('kode_brg', 'like', '%'. $request->search . '%')
                                ->orWhere('nama_brg', 'like', '%' . $request->search . '%')
                                ->orWhere('harga', 'like', '%' . $request->search . '%')
                                ->orWhere('jumlah', 'like', '%' . $request->search . '%')
                                ->orWhere('total_bayar', 'like', '%' . $request->search . '%')
                                ->orWhere('tanggal', 'like', '%' . $request->search . '%')
                                ->paginate(5);
                return view('point.transaksi', compact('transaksis'));
            }

        return view('point.transaksi', compact('transaksis', 'barangs'));
    }


    public function tambahTransaksi(Request $request) {
        $transaksi = new Transaksi;
        $transaksi->kode_transaksi = $request->kode_transaksi;
        $transaksi->kode_brg = $request->kode_brg;
        $transaksi->nama_brg = $request->nama_brg;
        $transaksi->harga = $request->harga;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->save();
        return redirect()->route('transaksi')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function editTransaksi($id) {
        $transaksi = Transaksi::find($id);
        $barang = Barang::find($transaksi->kode_brg);
        return view('point.editTransaksi', compact('transaksi', 'barang'));
    }
    public function updateTransaksi(Request $request, $id) {
        $transaksi = Transaksi::find($id);
        $transaksi->kode_transaksi = $request->kode_transaksi;
        $transaksi->kode_brg = $request->kode_brg;
        $transaksi->nama_brg = $request->nama_brg;
        $transaksi->harga = $request->harga;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->save();
        return redirect()->route('transaksi')->with('success', 'Transaksi berhasil diupdate');
    }
    public function hapusTransaksi($id) {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return redirect()->route('transaksi')->with('success', 'Transaksi berhasil dihapus');
    }
}
