<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Tipe Menu</h3>
                {!! create(['url' => route('menu_type.create'), 'title' => 'Tambah Kecamatan', 'style' => 'float: right;']) !!}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="menu_type" class="table table-bordered table-hover display standard"
                    style="width: 100%" data-route="{{ route('menu_type.getListAjax') }}">
                    <thead>
                        <tr>
                            <th data-name="id">No</th>
                            <th data-name="name">Nama</th>
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
@push('js')
    <script>
        $(function() {
            $("body").on('click', '.show_detail', function(e) {
                e.preventDefault();

                let tr = $(this).parents('tr');
                let id = $(tr).attr('data-id');
                let is_tr_exists = $("table#menu_type").find("tr.detail-" + id);
                if ($("table#menu_type").find("tr.detail-" + id).length > 0) {
                    $("table#menu_type tr.detail-" + id).remove();
                } else {
                    $('<tr role="row" class="detail-' + id + '"><th colspan="7"></th></tr>').insertAfter(
                    tr);
                    $.ajax({
                        url: $(this).attr("href data-href"),
                        type: "GET",
                        success: function(e) {
                            $("table#menu_type tr.detail-" + id + " th").html(e);
                        },
                        error: function(xhr) {

                        }
                    });
                }
            })
        });
    </script>
@endpush
