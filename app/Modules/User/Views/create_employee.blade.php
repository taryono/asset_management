 {{ Form::open(['method' => 'POST', 'route' => ['user.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 {{ Form::hidden('employee', 1) }}
 <div class="card-body">
     <div class="row">
         {!! form(
             'select',
             'employee_id',
             ['class' => 'form-control selectpicker', 'placeholder' => 'Nama Pegawai', 'required', 'id' => 'employee_id'],
            
             \Models\Employee::pluck('name', 'id')->all(),
         ) !!}
         {!! form('email', 'email', [
             'class' => 'form-control',
             'id' => 'email',
             'placeholder' => 'Email',
             'required',
         ]) !!}
         {!! form('password', 'password', [
             'class' => 'form-control',
             'id' => 'password',
             'placeholder' => 'Password',
             'required',
         ]) !!}

         {!! form('password', 'password_confirm', [
             'class' => 'form-control',
             'id' => 'password_confirm',
             'placeholder' => 'Password Confirm',
             'required',
         ]) !!}
         {!! form(
             'select',
             'role_id[]',
             [
                 'class' => 'form-control selectpicker',
                 'placeholder' => 'Role',
                 'required',
                 'id' => 'role_id',
                 'multiple' => true,
                 'data-live-search' => 'true',
                 'data-style' => 'btn-primary',
             ], 
             \Models\Role::pluck('name', 'id')->all(),
         ) !!}
     </div>
 </div>
 {{ Form::close() }}
