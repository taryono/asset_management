{{ Form::open(['method' => 'POST', 'route' => ['menu_user.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
{{Form::hidden('user_id', $user_id)}}
<div class="card-body">  
    <div class="form-group">
        <label for="role_id">Modul</label>
        {{ Form::select('menu_id[]', \Models\Menu::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker','multiple']) }}
    </div> 
</div> 
{{ Form::close() }} 