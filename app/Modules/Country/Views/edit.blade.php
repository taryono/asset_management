{{ Form::model($country, ['method' => 'PUT', 'route' => ['country.update', $country->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama Negara</label>
        {{Form::text('name', null, ["class"=>"form-control", "id"=>"name"])}}
    </div> 
    <div class="form-group">
        <label for="code">Kode Negara</label>
        {{Form::text('code', null, ["class"=>"form-control", "id"=>"code"])}}
    </div> 
</div>
{{ Form::close() }}
