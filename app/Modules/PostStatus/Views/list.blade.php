<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar PostStatus</h3> 
        {!!create(['url'=> route('post_status.create'), 'title'=> 'Tambah PostStatus', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="post_status" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('post_status.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="code">Kode</th> 
            <th data-name="bg_color">Nama</th>
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