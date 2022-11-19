<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Staff Pengurus</h3> 
        {!!create(['url'=> route('staff.create'), 'title'=> 'Tambah Anggota', 'style'=> "float: right;"]) !!}              
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="staff" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('staff.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="employee.full_name">Nama</th>   
            <th data-name="position.name">Jabatan</th>
            <th data-name="structure.name">Nama Kepengurusan</th>
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