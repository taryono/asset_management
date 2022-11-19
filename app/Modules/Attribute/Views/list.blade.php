<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Attribute</h3>  
        {!!create(['url'=> route('attribute.create'), 'title'=> 'Tambah Attribute', 'style'=> "float: right;"]) !!}
        
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="attribute" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('attribute.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="key">Key</th>  
            <th data-name="name">Name</th>
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