<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Halaman</h3>  
        {!!create(['url'=> route('page.create'), 'title'=> 'Tambah Mushola', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="page" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('page.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>
            <th data-name="parent">Parent</th>
            <th data-name="content">Content</th>
            <th data-name="sequence">Urutan</th>
            <th data-name="action" nowrap="nowrap">Action</th> 
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