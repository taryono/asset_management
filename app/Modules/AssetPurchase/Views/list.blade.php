<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Pembelian Asset</h3>
        {!!create(['url'=> route('asset_purchase.create'), 'title'=> 'Tambah Tipe Asset', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="asset_purchase" class="table table-bordered table-hover display standard" data-route="{{ route('asset_purchase.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>  
            <th data-name="supplier">Supplier</th>  
            <th data-name="date" nowrap="nowrap">Tanggal Pembelian</th> 
            <th data-name="qty" nowrap="nowrap">Jumlah</th> 
            <th data-name="price" nowrap="nowrap" data-format="money">Harga</th> 
            <th data-name="action">Action</th> 
          </tr>
          </thead>
          <tbody>
             
          </tbody> 
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

    
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>