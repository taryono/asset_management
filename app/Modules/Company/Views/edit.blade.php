{{ Form::model($company, ['method' => 'PUT', 'route' => ['company.update', $company->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required', 'id'=> 'name']) !!}
        {!! select_div('company_type_id', ['class' => 'form-control', 'placeholder' => 'Tipe Perusahaan', 'required', 'id'=> 'company_type_id'], Models\CompanyType::pluck('name', 'id')->all(),$company->company_type_id) !!}
        {!! text_div('cellphone', ['class' => 'form-control cellphone', 'placeholder' => 'No Hp', 'required', 'id'=> 'cellphone']) !!}
        {!! text_div('phone', ['class' => 'form-control phone', 'placeholder' => 'No Telephone', 'required', 'id'=> 'phone']) !!}
        {!! text_div('email', ['class' => 'form-control', 'placeholder' => 'Email', 'required', 'id'=> 'email']) !!}
        {!! text_div('website', ['class' => 'form-control', 'placeholder' => 'Alamat Website', 'required', 'id'=> 'website']) !!}
        {!! textarea_div('address', [
            'class' => 'form-control',
            'id' => 'address',
            'placeholder' => 'Alamat Perusahaan',
            'required',
            'rows'=> '3'
        ]) !!} 
    </div>
</div>
{{ Form::close() }}
