<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Asset</h3> 
        {!!create(['url'=> route('admin.create'), 'title'=> 'Tambah Admin', 'style'=> "float: right;"]) !!}
          
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="admin" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('admin.getListAjax') }}">
          <thead>
          <tr>
            <th>No</th> 
            <th>Nama</th>   
            <th nowrap="nowrap">Tipe Admin</th>
            <th data-name="status">Status</th>
            <th>Kategori</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th data-name="description">Keterangan</th> 
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