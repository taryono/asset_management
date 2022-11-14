{{ Form::model($company, ['method' => 'PUT', 'route' => ['company.update', $company->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
      {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required', 'id'=> 'name']) !!}
        {!! color_div('bg_color', [
            'class' => 'form-control',
            'id' => 'bg_color',
            'placeholder' => 'Background Color',
            'required',
        ]) !!}
    </div>
</div>
{{ Form::close() }}
