<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Tipe Asset</h3>
        {!!create(['url'=> route('asset_distribution.create'), 'title'=> 'Tambah Tipe Asset', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="asset_distribution" class="table table-bordered table-hover display standard" data-route="{{ route('asset_distribution.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="user.name">Nama User</th>    
            <th data-name="asset.name">Nama Asset</th>  
            <th data-name="location.name">Lokasi Asset</th>  
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
  </div>
  <!-- /.col -->
</div>