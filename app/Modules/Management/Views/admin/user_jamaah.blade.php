<div id="container">
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar User Jamaah</h3>
                            {!! create(['url' => route('user.create_jamaah'), 'title' => 'Tambah User', 'style' => 'float: right;']) !!}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="user-jamaah" class="table table-bordered table-hover display standard" style="width: 100%"
                                data-route="{{ route('user.getListJamaahAjax') }}">
                                <thead>
                                    <tr>
                                        <th data-name="id">No</th>
                                        <th data-name="name">Nama</th>
                                        <th data-name="email">Email</th>
                                        <th data-name="roles">Roles</th>
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
</div>

@section('js')
    <script>
        $(function() {
            $(document).on('change',"#people_id",function(){
                $.get('/people/getName/'+$(this).val(), function(res){
                    $("#name").val(res);
                });
            });
        }); 
    </script>
@stop 
