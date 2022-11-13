 {{ Form::model($user, ['method' => 'PUT', 'route' => ['user.update', $user->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 {{Form::hidden('jamaah', null)}}
 <div class="card-body">
     <div class="form-group"> 
         {{Form::text('name',null,[ "class"=>"form-control", "id"=>"name", "placeholder"=>"Name"])}}        
     </div>
     <div class="form-group"> 
         {{Form::email('email',null,[ "class"=>"form-control", "id"=>"email", "placeholder"=>"Email"])}}          
     </div>
     <div class="form-group">  
         {{Form::password('password', ["class"=>"form-control", "id"=>"password", "placeholder"=>"Password", "autocomplete"=>"off"])}}
     </div>
     <div class="form-group"> 
         {{Form::password('password_confirm',[ "class"=>"form-control", "id"=>"password_confirm", "placeholder"=>"Konfirmasi Password", "autocomplete"=>"off"])}}          
     </div>
     <div class="form-group">
         <label for="parent">Role</label>
         {{ Form::select('role_id[]', Models\Role::pluck('name', 'id')->all(), $user->roles->pluck('id', 'name')->all(), ['class' => 'form-control selectpicker', 'multiple' => true, 'data-live-search' => 'true', 'data-style' => 'btn-primary']) }}
     </div>
 </div>
 {{ Form::close() }}
