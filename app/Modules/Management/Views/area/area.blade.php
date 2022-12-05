<link rel="stylesheet" href="{{ asset('css/tree.css') }}">
<div class="row">
    <div class="col-lg-5">

        <div class="tree">
            <ul>
                <li class="parent_li">
                    <span title="Expand this branch"><i class="fa fa-minus"></i> {{ say('Daftar Negara') }}</span>
                    <ul>
                        @foreach (\Models\Country::select('name', 'id')->get() as $country)
                            <li class="parent_li">
                                <span data-model="{{ get_class($country) }}" data-id="{{ $country->id }}"
                                    data-target="{{ get_class(new \Models\Region()) }}" title="Expand this branch"><i
                                        class="fa fa-plus"></i> {{ $country->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="tree_content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Negara</h3>
                            {!! create(['url' => route('country.create'), 'title' => 'Tambah Negara', 'style' => 'float: right;']) !!}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="country" class="table table-bordered table-hover display standard"
                                style="width: 100%" data-route="{{ route('country.getListAjax') }}">
                                <thead>
                                    <tr>
                                        <th data-name="id">No</th>
                                        <th data-name="name">Nama</th>
                                        <th data-name="code">ISO</th>
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
        </div>
    </div>
</div>
@push('js')
    <script type="text/javascript">
        //<![CDATA[

        $(function() {
            $(".tree li:has(ul)")
                .addClass("parent_li")
                .find(" > span")
                .attr("title", "Collapse this branch");

            $(document).on("click", ".tree li.parent_li > span", function(e) {
                var children = $(this).parent("li.parent_li").find(" > ul > li");
                var p = this;
                var icon = $(this).attr("title", "Collapse this branch").find(" > i");

                if (children.is(":visible")) {
                    if ($(this).attr('data-model')) {
                        children.remove();
                        let model = $(this).attr('data-model');
                        let target = $(this).attr('data-target');
                        let id = $(this).attr('data-id');
                        if ($(this).attr('data-model')) {
                            $.get('{{ url('/management/addChildren') }}?model=' + model + '&target=' +
                                target +
                                '&id=' + id,
                                function(res) {
                                    $("div.tree_content").html(res)
                                });
                        }
                        if (!$(icon).hasClass("lastchild"))
                            $(icon).addClass("fa-plus").removeClass("fa-minus");
                    } else {
                        children.hide("fast");
                        if (!$(icon).hasClass("lastchild"))
                            $(icon).addClass("fa-plus").removeClass("fa-minus");
                    }
                } else {
                    let model = $(this).attr('data-model');
                    let target = $(this).attr('data-target');
                    let id = $(this).attr('data-id');

                    if (target) {
                        $.get('{{ url('/management/children') }}?model=' + model + '&target=' + target +
                            '&id=' +
                            id,
                            function(res) {
                                $(res).insertAfter(p)
                                $.get('{{ url('/management/addChildren') }}?model=' + model +
                                    '&target=' +
                                    target + '&id=' + id,
                                    function(res) {
                                        $("div.tree_content").html(res)
                                    })
                            })
                        var children = $(this).parent("li.parent_li").find(" > ul > li");
                        children.show("fast");
                        if (!$(icon).hasClass("lastchild"))
                            $(icon).addClass("fa-minus").removeClass("fa-plus");
                    } else {
                        var children = $(this).parent("li.parent_li").find(" > ul > li");

                        children.show("fast");
                        if (!$(icon).hasClass("lastchild"))
                            $(icon).addClass("fa-plus").removeClass("fa-minus");
                    }
                }
                e.stopPropagation();
            });
        });

        //]]>
    </script>
@endpush
