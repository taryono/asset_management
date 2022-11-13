{{ Form::open(['method' => 'POST', 'route' => ['city.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body"> 
    <div class="form-group">
        <label for="name">Nama Kota</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
    </div>
    <div class="form-group">
        <label for="region_id">Provinsi</label>
        {{ Form::select('region_id', \Models\Region::pluck('name', 'id')->all(), $region?$region->id:null, ['class' => 'form-control selectpicker', 'id' => 'region_id', 'data-live-search' => 'true', 'data-style' => 'btn-success']) }}
    </div>
</div>
<!-- /.card-body -->
{{ Form::close() }}
@push('js')
    <script>
        $(function() {
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });
        })
    </script>
@endpush
