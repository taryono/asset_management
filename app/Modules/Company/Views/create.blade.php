{{ Form::open(['method' => 'POST', 'route' => ['company.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required', 'id'=> 'name']) !!}
         
    </div>
</div>
    {{ Form::close() }}
