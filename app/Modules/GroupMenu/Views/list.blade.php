<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Grup Menu</h3>
        {!!create(['url'=> route('group_menu.create'), 'title'=> 'Tambah Grup Menu', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="group_menu" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('group_menu.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>  
            <th data-name="parent">Parent</th>
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