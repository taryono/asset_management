<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Unit</h3>
                {!!create(['url'=> route('staff.create', ['structure_id'=> $structure_id]), 'title'=> 'Tambah Jabatan', 'style'=> "float: right;"]) !!}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="staff" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('structure.getListAjaxStaff', $structure_id) }}">
                    <thead>
                        <tr> 
                            
                            <th data-name="id">No</th> 
                            <th data-name="employee.full_name">Nama</th>    
                            <th data-name="position.name">Jabatan</th>
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
@push('js')
    <script type="text/javascript">
        $(function(){
            $.ajax({
                url: '{{route('structure.graph',1)}}',
                success: function(res) {
                     $("div#graph").html(res);
                },
                error: function(err) {
                    message('error', err.responseJSON.errors)
                }
            });
        });
    </script>
@endpush