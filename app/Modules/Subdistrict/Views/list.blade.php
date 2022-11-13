   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Kelurahan</h3>  
                <?php 
                if(isset($parent)){
                  $district = $parent;
                }
                $url = ($district)?route('subdistrict.create',['district_id'=> $district->id]):route('subdistrict.create');
                $ajax_url = ($district)?route('subdistrict.getListAjax',['district_id'=> $district->id]):route('subdistrict.getListAjax');
                ?>
                {!!create(['url'=> $url, 'title'=> 'Tambah Kelurahan', 'style'=> "float: right;"]) !!} 
                 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="subdistrict" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{$ajax_url }}">
                  <thead>
                  <tr>
                    <th data-name="id">No</th> 
                    <th data-name="name">Nama</th> 
                    <th data-name="district.name">Kecamatan</th>  
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