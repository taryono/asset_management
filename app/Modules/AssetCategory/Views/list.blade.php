<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Kategori Asset</h3>  
        {!!create(['url'=> route('asset_category.create'), 'title'=> 'Tambah Kategori Asset', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="asset_category" class="table table-bordered table-hover display standard" data-route="{{ route('asset_category.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>   
            <th data-name="bg_color" nowrap="nowrap">Warna Background</th> 
            <th data-name="description">Keterangan</th>  
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
<div class="scrolling-pagination"></div>