<div class="card" style="margin-top: 10px; min-height: 1000px;">
    <div class="card-header">
        <div class="card-title">
            {{ is_exists($data, 'name') }}
        </div>
    </div>
    <div class="card-body">  
        <div class="row">
            <div class="col-md-6">Nama Pendapatan</div>
            <div class="col-md-6"> {!! is_exists($data, 'name', 'Content tidak ditemukan') !!} </div>
        </div>
        <div class="row">
            <div class="col-md-6">Jumlah Nominal Uang (Diuangkan)</div>
            <div class="col-md-6"> {!! rupiahFormat(is_exists($data, 'amount', 0)) !!} </div>
        </div>
        <div class="row">
            <div class="col-md-6">Jenis Pendapatan</div>
            <div class="col-md-6"> {!! is_exists($data->income_type, 'name', '') !!} </div>
        </div>
        <div class="row">
            <div class="col-md-6">Kategori Pendapatan</div>
            <div class="col-md-6"> {!! is_exists($data->income_category, 'name', '') !!} </div>
        </div>
        <div class="row">
            <div class="col-md-6">Asal Pendapatan</div>
            <div class="col-md-6"> {{is_exists($data->from_type, 'name', 'Hamba Allah')}} </div>
        </div>
        <div class="row">
            <div class="col-md-6">Atas Nama</div>
            <div class="col-md-6"> {{$data->from}} </div>
        </div> 
        <div class="row">
            <div class="col-md-6">Uang/Barang </div>
            <div class="col-md-6"> {{is_exists($data->material_type, 'name', '-')}} </div>
        </div>
        <div class="row">
            <div class="col-md-6">Tanggal Perolehan Pendapatan</div>
            <div class="col-md-6"> {!! dateToIndo(is_exists($data, 'date', '')) !!} </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">Keterangan</div>
            <div class="col-md-6"> {!! is_exists($data, 'description', '') !!} </div>
        </div>
        <div class="row">
            <div class="col-md-6">Nota</div>
            <div class="col-md-6"> 
                <a href="#" data-toggle="modal" data-target="#modalImage"> <img src="{{asset('nota/'. $data->nota?$data->nota:asset('assets/images/mushola.png'))}}" class="img-responsive" onerror="this.src='{{asset('assets/images/mushola.png')}}'" width="200px" height="200px"></a>
            </div>  
        </div>
    </div>
    <div class="card-footer">
        <blockquote>Semoga Bermanfaat Untuk Umat</blockquote>
    </div>
</div>