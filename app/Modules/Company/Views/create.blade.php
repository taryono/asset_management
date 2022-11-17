{{ Form::open(['method' => 'POST', 'route' => ['company.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required', 'id'=> 'name']) !!}
        {!! select_div('company_type_id', ['class' => 'form-control', 'placeholder' => 'Type Perusahaan', 'required', 'id'=> 'company_type_id'], null,Models\CompanyType::pluck('name', 'id')->all()) !!}
        {!! text_div('email', ['class' => 'form-control', 'placeholder' => 'Email', 'required', 'id'=> 'email']) !!}
        {!! text_div('website', ['class' => 'form-control', 'placeholder' => 'Alamat Website', 'required', 'id'=> 'website']) !!}
        {{-- {!! color_div('bg_color', [
            'class' => 'form-control',
            'id' => 'bg_color',
            'placeholder' => 'Background Color',
            'required',
        ]) !!}  --}}
    </div>
</div>
    {{ Form::close() }}
