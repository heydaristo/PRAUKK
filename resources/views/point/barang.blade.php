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
    <h3 class="card-title">Daftar Barang</h3>
    <div class="card-options">
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarang">Tambah Barang</a>
    </div>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">
      <div class="text-secondary">
        Show
        <div class="mx-2 d-inline-block">
          <input type="text"  id="data_count_shows"  class="form-control form-control-sm" value="5" size="3" aria-label="Invoices count">
        </div>
        entries
      </div>
      <div class="ms-auto text-secondary">
        Search:
        <div class="ms-2 d-inline-block">
          <input type="text" id="search" class="form-control form-control-sm" aria-label="Search invoice">
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    {{-- <div class="table"> --}}
    <table class="table card-table table-vcenter text-nowrap datatable">
      <thead>
        <tr>
          <th class="w-1">Kode Barang</th>
          <th>Nama Barang</th>
          <th>Merk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($barangs as $barang)
        <div class="modal fade" id="hapusBarang-{{ $barang->kode_brg }}" tabindex="-1" aria-labelledby="hapusBarangLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="hapusBarangLabel">Hapus Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus barang ini?</p>
              </div>
              <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</a>
                <form action="{{ route('barang.hapus', $barang->kode_brg) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Ya</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="editBarang-{{ $barang->kode_brg }}" tabindex="-1" aria-labelledby="editBarangLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Edit Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form tambah barang -->
                <form action="{{ route('barang.edit', $barang->kode_brg) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label for="kodeBarang" class="form-label">Kode Barang</label>
                    <input type="number" class="form-control" id="kodeBarang" name="kode_brg" value="{{ "000" . $barang->kode_brg }}" disabled>
                  </div>
                  <div class="mb-3">
                    <label for="namaBarang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="namaBarang" name="nama_brg" value="{{ $barang->nama_brg }}">
                  </div>
                  <div class="mb-3">
                    <label for="merkBarang" class="form-label">Merk Barang</label>
                    <input type="text" class="form-control" id="merkBarang" name="merk" value="{{ $barang->merk }}">
                  </div>
                  <div class="mb-3">
                    <label for="hargaBarang" class="form-label">Harga Barang</label>
                    <input type="number" class="form-control" id="hargaBarang" name="harga" value="{{ $barang->harga }}">
                  </div>
                  <div class="mb-3">
                    <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                    <input type="number" class="form-control" id="jumlahBarang" name="jumlah" value="{{ $barang->jumlah }}">
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
       <td class="text-center">{{ "000" . $barang->kode_brg }}</td>
       <td>{{ $barang->nama_brg }}</td>
       <td>{{ $barang->merk }}</td>
       <td>{{ $barang->harga }}</td>
       <td>{{ $barang->jumlah }}</td>
       <td class="text-end">
        <span class="dropdown">
          <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editBarang-{{ $barang->kode_brg }}">
              Edit
            </a>
            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapusBarang-{{ $barang->kode_brg }}">
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
    {!! $barangs->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahBarangLabel">Tambah Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form tambah barang -->
        <form action="{{ route('barang.tambah') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="kodebarang" class="form-label">Kode Barang</label>
            <input type="number" class="form-control" id="kodeBarang" name="kode_brg">
          </div>
          <div class="mb-3">
            <label for="namaBarang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="namaBarang" name="nama_brg">
          </div>
          <div class="mb-3">
            <label for="merkBarang" class="form-label">Merk Barang</label>
            <input type="text" class="form-control" id="merkBarang" name="merk">
          </div>
          <div class="mb-3">
            <label for="hargaBarang" class="form-label">Harga Barang</label>
            <input type="number" class="form-control" id="hargaBarang" name="harga">
          </div>
          <div class="mb-3">
            <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="jumlahBarang" name="jumlah">
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

   {{-- add ajax --}}
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
       $(document).ready(function() {
           $('#data_count_shows').on('input',function() {
               var count_shows = $(this).val();
               // update the table and the pagination
               $.ajax({
                   url: "{{ route('barang') }}",
                   type: 'GET',
                   data: {
                       data_count_shows: count_shows
                   },
                   success: function(response) {
                       console.log(response);
                       var newTable = $(response).find('.datatable');
                       var newPagination = $(response).find('.pagination');
                       $('.datatable').html(newTable.html());
                       $('.pagination').html(newPagination.html());
                   }
               });
           });

           $('#search').on('input',function() {
               var search = $(this).val();
               // update only the table

               $.ajax({
                   url: "{{ route('barang') }}",
                   type: 'GET',
                   data: {
                       search: search
                   },
                   success: function(response) {
                       var newTable = $(response).find('.datatable');
                       $('.datatable').html(newTable.html());
                   }
               });
               
           });
       });
   </script>

@endsection