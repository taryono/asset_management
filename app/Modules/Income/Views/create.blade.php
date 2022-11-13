{{ Form::open(['method' => 'POST', 'route' => ['income.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama Pendapatan</label>
        {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name',"placeholder"=>"Nama pendapatan"]) }}
    </div> 
    <div class="form-group">
        <label for="date">Tanggal Perolehan</label>
        {{ Form::date('date', old('date'), ['class' => 'form-control datetimepicker', 'id' => 'date',"placeholder"=>"Nama pendapatan"]) }}
    </div>
    <div class="form-group">
        <label for="income_type_id">Tipe</label> 
        {{ Form::select('income_type_id', \Models\IncomeType::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker']) }}
    </div>
    <div class="form-group">
        <label for="income_category_id">Kategori</label> 
        {{ Form::select('income_category_id', \Models\IncomeCategory::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker']) }}
    </div> 
    <div class="form-group">
        <label for="from_type_id">Asal Pendapatan</label> 
        {{ Form::select('from_type_id', \Models\FromType::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker']) }}
    </div>  
    <div class="form-group">
        <label for="from_type_id">Atas Nama</label> 
        {{ Form::text('from', null, ['class' => 'form-control']) }}
    </div>  
    <div class="form-group">
        <label for="material_type_id">Uang/Barang</label> 
        {{ Form::select('material_type_id', \Models\MaterialType::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker']) }}
    </div>  
    <div class="form-group">
        <label for="amount">Nominal Uang (Diuangkan)</label>
        {{ Form::text('amount', old('amount'), ['class' => 'form-control', 'id' => 'amount',"placeholder"=>"Nama pendapatan"]) }}
    </div>
    <div class="form-group">
        <label for="post_status_id">Publish / Jangan Publish</label> 
        {{ Form::select('post_status_id', \Models\PostStatus::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker']) }}
    </div>  
    <div class="form-group">
        <label for="description">Keterangan</label>
        {{ Form::textarea('description', old('description'), ['class' => 'form-control text-editor', 'id' => 'description',"placeholder"=>"Nama pendapatan", 'rows'=> '3']) }}
    </div>
</div>
{{ Form::close() }} 