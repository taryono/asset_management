 {{ Form::open(['method' => 'POST', 'route' => ['location.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
     <div class="row">
         {!! text_div('name', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama', 'required']) !!}         
     </div>
 </div>
 {{ Form::close() }}
