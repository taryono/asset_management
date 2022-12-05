<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Perawatan Asset</h3>
        {!!create(['url'=> route('asset_maintenance.create'), 'title'=> 'Tambah Tipe Asset', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="asset_maintenance" data-title="Data Maintenance Asset" class="table table-bordered table-hover display standard" data-route="{{ route('asset_maintenance.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="asset.name">Nama</th>     
            <th data-name="actions">Tindakan</th> 
            <th data-name="cost" nowrap="nowrap" data-format="money">Biaya Servis</th> 
            <th data-name="supplier.name">Supplier</th> 
            <th data-name="start" data-format="date" nowrap="nowrap">Tanggal Servis</th> 
            <th data-name="end" data-format="date" nowrap="nowrap">Tanggal Pengambilan</th> 
            <th data-name="description">Keterangan</th> 
            <th data-name="action">Aksi</th> 
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