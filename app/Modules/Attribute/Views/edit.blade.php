{{ Form::model($attribute, ['method' => 'PUT', 'route' => ['attribute.update', $attribute->id], 'class' => 'form-horizontal']) }}
{{Form::hidden('menu_id')}}                
<div class="card-body">
    <div class="form-group">
        <label for="key">Key</label>
        {{ Form::text('key', null, ['class' => 'form-control', 'id' => 'key',"placeholder"=>"Key"]) }}
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name',"placeholder"=>"Nama"]) }}
    </div>
    <div class="form-group">
        <label for="is_active">Status</label>
        {{Form::select('is_active', [0=> 'Tidak Aktif', 1=> 'Aktif'],null, ["class" => "form-control", "id"=> "status", "placeholder"=> "Pilih Status"])}}    
    </div>
</div>
{{ Form::close() }}
