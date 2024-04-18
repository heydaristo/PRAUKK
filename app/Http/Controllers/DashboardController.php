<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\transaksi;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $barangs = Barang::paginate(5);
        $transaksis = Transaksi::paginate(5);

        // if the request has data_count_shows
        if ($request->input('data_count_shows') != null) {
          $dataCountShows = $request->input('data_count_shows');
          $barangs = Barang::paginate($dataCountShows);
          $transaksis = Transaksi::paginate($dataCountShows);
          return view('point.index', compact('barangs', 'transaksis'));
      }

      // if the request has search
      if ($request->input('search') != null) {
          $barangs = Barang::where('nama_brg', 'like', '%'. $request->search . '%')
                          ->orWhere('merk', 'like', '%' . $request->search . '%')
                          ->paginate(5);
          return view('point.index', compact('barangs'));
      }
        return view('point.index', compact('barangs', 'transaksis'));
    }
}
