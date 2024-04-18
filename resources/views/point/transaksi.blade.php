@extends('template')
@section('body')
    
@if (session('success'))
<div class="alert alert-success" style="position: fixed; top: 0; right: 0; z-index: 9999; transition: right 0.5s ease-in-out;">
  {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger" style="position: fixed; top: 0; right: 0; z-index: 9999; transition: right 0.5s ease-in-out;">
  {{ session('error') }}
</div>
@endif
<script>
window.onload = function() {
  let alert = document.querySelector('.alert');
  alert.style.right = '0';
  setTimeout(() => {
    alert.style.right = '-100%';
  }, 2000);
}
</script>


<div class="card">
<div class="card-header">
  <h3 class="card-title">List Transaksi</h3>
  <div class="card-options">
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTransaksi">Tambah Transaksi</a>
  </div>
</div>
{{-- <div class="table-responsive"> --}}
  {{-- <div class="table"> --}}
    <div>
  <table class="table card-table table-vcenter text-nowrap datatable">
    <thead>
      <tr>
        <th class="w-1 text-start">Kode Transaksi</th>
        <th class="w-1">Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total Bayar</th>
        <th>Tanggal</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($transaksis as $transaksi)
      <div class="modal fade" id="hapusTransaksi-{{ $transaksi->kode_transaksi }}" tabindex="-1" aria-labelledby="hapusBarangLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="hapusBarangLabel">Hapus Transaksi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</a>
              <form action="{{ route('transaksi.hapus', $transaksi->kode_transaksi) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      {{-- Modals Edit --}}
      <div class="modal fade" id="editTransaksi-{{ $transaksi->kode_transaksi }}" tabindex="-1" aria-labelledby="editTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editTransaksiLabel">Edit Transaksi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form edit transaksi -->
              <form action="{{ route('transaksi.update', $transaksi->kode_transaksi) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="kodeTransaksi" class="form-label">Kode Transaksi</label>
                  <input type="number" class="form-control" id="kodeTransaksi" name="kode_transaksi" value="{{ "00" . $transaksi->kode_transaksi }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="kodebarang" class="form-label">Kode Barang</label>
                    <select class="form-select" id="kodeBarang" name="kode_brg">
                      @foreach($barangs as $barang)
                        <option value="{{ $barang->kode_brg }}" {{ $barang->kode_brg == $transaksi->kode_brg ? 'selected' : '' }}>{{ "000". $barang->kode_brg . " " . "( " . $barang->nama_brg . " )"}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="mb-3">
                  <label for="namaBarang" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" id="namaBarang" name="nama_brg" value="{{ $transaksi->nama_brg }}">
                </div>
                <div class="mb-3">
                  <label for="hargaBarang" class="form-label">Harga Barang</label>
                  <input type="number" class="form-control" id="hargaBarang" name="harga" value="{{ $transaksi->harga }}">
                </div>
                <div class="mb-3">
                  <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                  <input type="number" class="form-control" id="jumlahBarang" name="jumlah" value="{{ $transaksi->jumlah }}">
                </div>
                <div class="mb-3">
                  <label for="totalBayar" class="form-label">Total Bayar</label>
                  <input type="number" class="form-control" id="totalBayar" name="total_bayar" value="{{ $transaksi->total_bayar }}">
                </div>
                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $transaksi->tanggal }}">
                </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
          </div>
        </div>
      </div>
   <tr>
     <td class="text-center">{{ "00" . $transaksi->kode_transaksi }}</td>
     <td>{{ "000" . $transaksi->kode_brg }}</td>
     <td>{{ $transaksi->nama_brg }}</td>
     <td>{{ $transaksi->harga }}</td>
     <td>{{ $transaksi->jumlah }}</td>
     <td>{{ $transaksi->total_bayar }}</td>
     <td>{{ $transaksi->tanggal }}</td>
     <td class="text-end">
      <span class="dropdown">
        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTransaksi-{{ $transaksi->kode_transaksi }}">
            Edit
          </a>
          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapusTransaksi-{{ $transaksi->kode_transaksi }}">
            Delete
          </a>
        </div>
      </span>
    </td>
  </tr>
  @endforeach
</tbody>
</table>
</div>

<div class="card-footer d-flex align-items-center">
  {!! $transaksis->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahTransaksi" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="tambahTransaksi">Tambah Transaksi</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <!-- Form tambah barang -->
      <form action="{{ route('transaksi.tambah') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kodebarang" class="form-label">Kode Transaksi</label>
            <input type="number" class="form-control" id="kodeBarang" name="kode_transaksi" required>
          </div>
        <div class="mb-3">
          <label for="kodebarang" class="form-label">Kode Barang</label>
          <select class="form-select" id="kodeBarang" name="kode_brg" required>
            @foreach($barangs as $barang)
              <option value="{{ $barang->kode_brg }}">{{ "000". $barang->kode_brg . " " . "( " . $barang->nama_brg . " )"}}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="Barang" class="form-label">Nama Barang</label>
          <input type="text" class="form-control" id="namaTransaksi" name="nama_brg" required>
        </div>
        <div class="mb-3">
          <label for="hargaTransaksi" class="form-label">Harga Barang</label>
          <input type="number" class="form-control" id="hargaTransaksi" name="harga" required>
        </div>
        <div class="mb-3">
          <label for="jumlahTransaksi" class="form-label">Jumlah Beli</label>
          <input type="number" class="form-control" id="jumlahTransaksi" name="jumlah" required>
        </div>
        <div class="mb-3">
          <label for="totalBayar" class="form-label">Total Bayar</label>
          <input type="number" class="form-control" id="totalBayar" name="total_bayar" required>
        </div>
        <div class="mb-3">
          <label for="tanggalTransaksi" class="form-label">Tanggal Transaksi</label>
          <input type="date" class="form-control" id="tanggalTransaksi" name="tanggal" required>
        </div>
    </div>
    <div class="modal-footer">
      <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
    </div>
  </div>
</div>
</div>

@endsection