{{ Form::model($city, ['method' => 'PUT', 'route' => ['city.update', $city->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group"> 
        <div class="form-group">
            <label for="name">Nama Kota</label>
            {{Form::text('name', null, ["class"=>"form-control", "id"=>"name"])}}
        </div> 
    </div>
    <div class="form-group">
      <label for="parent">Provinsi</label> 
        {{Form::select('region_id', \Models\Region::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "region_id", "data-live-search"=> "true", 'data-style'=> 'btn-success'])}}
    </div> 
</div>
{{ Form::close() }}
