
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Slider</h3> 
                {!!create(['url'=> route('slider.create'), 'title'=> 'Tambah Slider', 'style'=> "float: right;"]) !!}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="slider" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('slider.getListAjax') }}">
                  <thead>
                  <tr>
                    <th data-name="id">No</th> 
                    <th data-name="title">Judul</th>  
                    <th data-name="text">Text</th>  
                    <th data-name="status">Status</th> 
                    <th data-name="image">Gambar</th> 
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

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content --> 