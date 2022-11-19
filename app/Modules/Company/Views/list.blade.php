<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Tipe Asset</h3>
        {!!create(['url'=> route('company.create'), 'title'=> 'Tambah Tipe Asset', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="company" class="table table-bordered table-hover display standard" data-route="{{ route('company.getListAjax') }}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>    
            <th data-name="phone" nowrap="nowrap">No. Telp</th> 
            <th data-name="cellphone" nowrap="nowrap">No. Hp</th> 
            <th data-name="email" nowrap="nowrap">Email</th> 
            <th data-name="website" nowrap="nowrap">Website</th> 
            <th data-name="company_type" nowrap="nowrap"> Status </th> 
            <th data-name="address" nowrap="nowrap">Alamat</th>  
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