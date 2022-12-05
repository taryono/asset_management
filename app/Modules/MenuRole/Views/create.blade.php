{{ Form::open(['method' => 'POST', 'route' => ['menu_role.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body"> 
    {{Form::hidden('role_id', $role->id)}}
    <div class="form-group">
        <label for="role_id">Modul</label>
        {{ Form::select('menu_id[]', \Models\Menu::where('is_active', 1)->where('is_publish', 1)->pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker','multiple']) }}
    </div>
</div> 
{{ Form::close() }} 