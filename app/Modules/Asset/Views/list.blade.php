<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Asset</h3>  
        {!!create(['url'=> route('asset.create'), 'title'=> 'Tambah Data Asset', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body"> 
        <table id="asset" data-filename="Data Asset Masjid" data-title="Data Asset Masjid" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('asset.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name" nowrap="nowrap">Nama</th>    
            <th data-name="photo">Image</th>
            <th data-name="asset_type" nowrap="nowrap">Status</th>
            <th data-name="asset_status" nowrap="nowrap">kondisi</th>
            <th data-name="asset_category" nowrap="nowrap">Kategori</th>
            <th data-name="amount">Jumlah</th>
            <th data-name="price" data-format="money">Harga</th>
            <th data-name="subtotal">Subtotal</th>
            <th data-name="description">Keterangan</th> 
            <th data-name="action" nowrap="nowrap" no-print>Action</th>  
          </tr>
          </thead>
          <tbody>
             
          </tbody> 
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card --> 
  </div>
  <!-- /.col -->
</div>