{{ Form::open(['method' => 'POST', 'route' => ['asset_purchase.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required', 'id' => 'name']) !!}
         
        {!! select_div(
            'supplier_id',
            [
                'class' => 'form-control selectpicker',
                'id' => 'supplier_id',
                'placeholder' => 'Supplier',
                'required',
            ],
            null,
            \Models\Supplier::pluck('name', 'id')->all(),
        ) !!}
        {!! date_div('date', [
            'class' => 'form-control amount',
            'id' => 'date',
            'placeholder' => 'Tanggal Beli',
            'required',
        ]) !!}
        {!! text_div('qty', [
            'class' => 'form-control amount',
            'id' => 'qty',
            'placeholder' => 'Jumlah',
            'required',
        ]) !!}
        {!! text_div('price', [
            'class' => 'form-control amount',
            'id' => 'price',
            'placeholder' => 'Harga',
            'required',
        ]) !!}
    </div>
</div>
{{ Form::close() }}
