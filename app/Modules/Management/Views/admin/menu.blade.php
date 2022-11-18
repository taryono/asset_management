@push('css')
    <style>
        .toggle-vis {
            background-color: #6c757d;
            padding: 5px;
            border-radius: 20px;
            color: white;
            cursor: pointer;
        }

    </style>
@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Modul</h3>  
            </div>

            <!-- /.card-header -->
            <div class="card-body"> 
                <table id="menu" class="table table-bordered table-hover display standard" style="width: 100%"
                    data-route="{{ route('menu.getListAjax') }}">
                    <thead>
                        <tr>
                            <th data-name="id">No</th>
                            <th data-name="name">Nama</th> 
                            <th data-name="is_active">Status</th>
                            <th data-name="is_private">Private/Public</th> 
                            <th data-name="action" class="action" data-priority="2">Action</th>
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
    <script>
        $(function() { 

            $("body").on('click', 'a.show_detail', function(e) {
                e.preventDefault();
                let tr = $(this).parents('tr');
                let id = $(tr).attr('data-id');
                let is_tr_exists = $("table#menu").find("tr.detail-" + id);
                if ($("table#menu").find("tr.detail-" + id).length > 0) {
                    $("table#menu tr.detail-" + id).remove();
                } else {
                    $('<tr role="row" class="detail-' + id + '"><th colspan="7"></th></tr>').insertAfter(
                        tr);
                    $.ajax({
                        url: $(this).attr("data-href"),
                        type: "GET",
                        success: function(e) {
                            $("table#menu tr.detail-" + id + " th").html(e);
                        },
                        error: function(xhr) {

                        }
                    });
                }
            }).on('click', 'button.reload', function(e) {
                $.get('{{ url('/admin/refresh') }}', function() {});
            });
        }); 
    </script>
@endpush
