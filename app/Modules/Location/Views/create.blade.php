 {{ Form::open(['method' => 'POST', 'route' => ['location.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
     <div class="row">
         {!! text_div('name', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama', 'required']) !!}         
         {!! select_div('parent_id', ['class' => 'form-control', 'id' => 'parent_id', 'placeholder' => 'Sub Lokasi', 'required'],null, \Models\Location::pluck('name', 'id')->all()) !!} 
     </div>
 </div>
 {{ Form::close() }}
