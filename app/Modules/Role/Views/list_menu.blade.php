<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header"> 
        <h3 class="card-title">Daftar Akses {{$role->name}}</h3> 
        {!!create(['url'=> route('menu_role.create'), 'title'=> 'Tambah Akses', 'style'=> "float: right;"]) !!}
         
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="menu_role" class="table table-bordered table-hover display" style="width: 100%">
          <thead>
          <tr>
            <th>No</th> 
            <th>Menu</th>  
            <th>Daftar</th>   
            <th>Create</th> 
            <th>Edit</th> 
            <th>Detail</th> 
            <th>Cetak</th> 
            <th>Hapus</th>  
          </tr>
          </thead>
          <tbody>
             
          </tbody> 
        </table>
        {!! kembali(['url'=> route('management.acl'),'title'=>'Kembali', 'style' =>'float:left']) !!}
         
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
      </div>
      <!-- /.col -->
  </div>
  <!-- /.row -->
</div>