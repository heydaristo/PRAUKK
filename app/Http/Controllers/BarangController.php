<?php

namespace App\Http\Controllers;
use App\Models\barang;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request) {
        $barangs = Barang::paginate(5);

              // if the request has data_count_shows
              if ($request->input('data_count_shows') != null) {
                $dataCountShows = $request->input('data_count_shows');
                $barangs = Barang::paginate($dataCountShows);
                return view('point.barang', compact('barangs'));
            }
    
            // if the request has search
            if ($request->input('search') != null) {
                $barangs = Barang::where('nama_brg', 'like', '%'. $request->search . '%')
                                ->orWhere('merk', 'like', '%' . $request->search . '%')
                                ->paginate(5);
                return view('point.barang', compact('barangs'));
            }

        return view('point.barang', compact('barangs'));
    }
    public function tambahBarang(Request $request) {
        $barang = new Barang;
        $barang->kode_brg = $request->kode_brg;
        $barang->nama_brg = $request->nama_brg;
        $barang->merk = $request->merk;
        $barang->harga = $request->harga;
        $barang->jumlah = $request->jumlah;
        if(Barang::where('kode_brg', $request->kode_brg)->exists()) {
            return redirect()->route('barang')->with('error', 'Kode Barang sudah ada');
        }
        $barang->save();

        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan');
    }
    public function editBarang($kode_brg) {
        $barang = Barang::find($kode_brg);
        return view('point.barang', compact('barang'));
    }
    public function updateBarang(Request $request, $kode_brg) {
        $barang = Barang::find($kode_brg);
        $barang->nama_brg = $request->nama_brg;
        $barang->merk = $request->merk;
        $barang->harga = $request->harga;
        $barang->jumlah = $request->jumlah;
        $barang->save();
        return redirect()->route('barang')->with('success', 'Barang berhasil diubah');
    }
    public function hapusBarang($kode_brg) {
        $barang = Barang::find($kode_brg);
        $barang->delete();
        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
    }
}
