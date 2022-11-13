{{ Form::open(['method' => 'POST', 'route' => ['district.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama Kecamatan</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
    </div>
    <div class="form-group">
        <label for="region_id">Kota/Kabupaten</label>
        {{ Form::select('city_id', \Models\City::pluck('name', 'id')->all(), $city?$city->id:null, ['class' => 'form-control selectpicker', 'id' => 'city_id', 'data-live-search' => 'true', 'data-style' => 'btn-success']) }}
    </div>
</div>
{{ Form::close() }}
