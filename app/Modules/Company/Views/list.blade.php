
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Perusahaan</h3>
                {!!create(['url'=> route('company.create'), 'title'=> 'Tambah Tipe Asset', 'style'=> "float: right;"]) !!}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="company" class="table table-bordered table-hover display standard" data-route="{{ route('company.getListAjax') }}">
                  <thead>
                  <tr>
                    <th data-name="id">No</th> 
                    <th data-name="name">Nama</th>    
                    <th data-name="email">Email</th>  
                    <th data-name="website">Website</th>  
                    <th data-name="company_type.name">Tipe</th>  
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
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content --> 