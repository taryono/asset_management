{{ Form::model($menu_user, ['method' => 'PUT', 'route' => ['menu_user.update', $menu_user->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
{{Form::hidden('user_id', $user_id)}}
<div class="card-body"> 
    <div class="form-group">
        <label for="menu_id">Modul</label>
        {{ Form::select('menu_id', \Models\Menu::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker', 'id' => 'menu_id']) }}
    </div> 
    <div class="form-group"> 
        {{ Form::checkbox('index',null, $menu_user->index, ['id' => 'index']) }} List        
        {{ Form::checkbox('create',null,  $menu_user->create, [ 'id' => 'create']) }} Create
        {{ Form::checkbox('edit', null, $menu_user->edit, [ 'id' => 'edit']) }} Edit        
        {{ Form::checkbox('show', null, $menu_user->show, [ 'id' => 'show']) }} Detail
        {{ Form::checkbox('print',null,  $menu_user->print, [ 'id' => 'print']) }} Cetak
        {{ Form::checkbox('destroy', null, $menu_user->destroy, [ 'id' => 'destroy']) }} Delete

    </div>
</div> 
{{ Form::close() }}
