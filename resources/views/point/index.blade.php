@extends('template')
@section('body')
<div class="col-12">
<div class="card">
  <div class="card-header">
    <h3 class="card-title">List Transaksi</h3>
  </div>
  {{-- <div class="table-responsive"> --}}
    {{-- <div class="table"> --}}
      <div>
    <table class="table card-table table-vcenter text-nowrap table-striped">
      <thead>
        <tr>
          <th class="w-1 text-start">Kode Transaksi</th>
          <th class="w-1">Kode Barang</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total Bayar</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transaksis as $transaksi)
     <tr>
       <td class="text-center">{{ "00" . $transaksi->kode_transaksi }}</td>
       <td>{{ "000" . $transaksi->kode_brg }}</td>
       <td>{{ $transaksi->nama_brg }}</td>
       <td>{{ $transaksi->harga }}</td>
       <td>{{ $transaksi->jumlah }}</td>
       <td>{{ $transaksi->total_bayar }}</td>
       <td>{{ $transaksi->tanggal }}</td>
    </tr>
    @endforeach
  </tbody>
  </table>
  </div>
  
  <div class="card-footer d-flex align-items-center">
    {!! $transaksis->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
  </div>
  </div>
</div>

<div class="card mt-5">
    <div class="card-header">
      <h3 class="card-title">Daftar Barang</h3>
    </div>
    <div class="table-responsive">
      {{-- <div class="table"> --}}
      <table class="table card-table table-vcenter text-nowrap table-striped">
        <thead>
          <tr>
            <th class="w-1">Kode Barang</th>
            <th>Nama Barang</th>
            <th>Merk</th>
            <th>Harga</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @foreach($barangs as $barang)
       <tr>
         <td class="text-center">{{ "000" . $barang->kode_brg }}</td>
         <td>{{ $barang->nama_brg }}</td>
         <td>{{ $barang->merk }}</td>
         <td>{{ $barang->harga }}</td>
         <td>{{ $barang->jumlah }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
    </div>
  
    <div class="card-footer d-flex align-items-center">
      {!! $barangs->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
    </div>
  </div>

@endsection

