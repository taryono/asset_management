 {{ Form::open(['method' => 'POST', 'route' => ['user.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 {{Form::hidden('employee', 1)}} 
 <div class="card-body">
    {{textDiv()}}
 </div>
 {{ Form::close() }}
