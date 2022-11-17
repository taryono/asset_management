 {{ Form::open(['method' => 'POST', 'route' => ['supplier.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
     <div class="row">
         {!! text_div('name', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama', 'required']) !!}
         {!! text_div('phone', ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'No. Telephone', 'required']) !!}
         {!! text_div('cellphone', ['class' => 'form-control', 'id' => 'cellphone', 'placeholder' => 'No. Handphone', 'required']) !!}
         {!! textarea_div('address', ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Alamat', 'required']) !!}                  
     </div>
 </div>
 {{ Form::close() }}
