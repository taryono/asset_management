<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header"> 
         {!! create(['url'=> route('asset_status.create'), 'title'=> 'Tambah Kategori', 'style'=> "float: right;"])!!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="asset_status" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('asset_status.getListAjax') }}">
          <thead>
            <tr>
              <td data-name="id">No</td> 
              <td data-name="name">Nama</td>   
              <td data-name="bg_color" nowrap="nowrap">Warna Background</td> 
              <td data-name="action">Action</td> 
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