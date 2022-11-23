<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Department</h3> 
        {!!create(['url'=> route('department.create'), 'title'=> 'Tambah Department', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="department" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('department.getListAjax') }}">
          <thead> 
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>   
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