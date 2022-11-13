
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Kota</h3>

                <?php 
                if(isset($parent)){
                  $region = $parent;
                }
                $url = ($region)?route('city.create',['region_id'=> $region->id]):route('city.create');
                $ajax_url = ($region)?route('city.getListAjax',['region_id'=> $region->id]):route('city.getListAjax');
                
                ?>
                {!!create(['url'=> $url, 'title'=> 'Tambah Kota', 'style'=> "float: right;"]) !!}
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="city" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{$ajax_url}}">
                  <thead>
                  <tr>
                    <th data-name="id">No</th> 
                    <th data-name="name">Nama</th> 
                    <th data-name="region.name">Provinsi</th>   
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