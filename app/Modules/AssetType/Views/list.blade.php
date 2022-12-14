<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Tipe Asset</h3>
        {!!create(['url'=> route('asset_type.create'), 'title'=> 'Tambah Tipe Asset', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="asset_type" class="table table-bordered table-hover display standard" data-filename="Data Asset Masjid" data-route="{{ route('asset_type.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>    
            <th data-name="bg_color" nowrap="nowrap">Warna Background</th> 
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