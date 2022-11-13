 {{ Form::open(['method' => 'POST', 'route' => ['user.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 {{Form::hidden('jamaah', 1)}}
 {{Form::hidden('name', null,['id'=> 'name'])}} 
 <div class="card-body">
    <div class="form-group"> 
        {{ Form::select('people_id', Models\People::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'data-style' => 'btn-primary', 'id'=> 'people_id']) }}
     </div> 
     <div class="form-group">  
        {{Form::email('email', null,["class"=>"form-control", "id"=>"email", "placeholder"=>"Email/Username"])}}
    </div>
    <div class="form-group">  
        {{Form::password('password', ["class"=>"form-control", "id"=>"password", "placeholder"=>"Password", "autocomplete"=>"off","required"=> "required"])}}
    </div>
    <div class="form-group"> 
        {{Form::password('password_confirm', [ "class"=>"form-control", "id"=>"password_confirm", "placeholder"=>"Konfirmasi Password", "autocomplete"=>"off","required"=> "required"])}}          
    </div>
     <div class="form-group">
         <label for="parent">Role</label>
         {{ Form::select('role_id[]', Models\Role::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker', 'id' => 'role_id', 'multiple' => true, 'data-live-search' => 'true', 'data-style' => 'btn-primary']) }}
     </div>
 </div>
 {{ Form::close() }}
