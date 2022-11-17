@extends('adminlte::page')  
@section('content') 
    <div id="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Asset</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-secondary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-asset-tab" data-toggle="pill"
                                            href="#custom-tabs-one-asset" role="tab" aria-controls="custom-tabs-one-asset"
                                            aria-selected="true">Asset</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-asset_type-tab" data-toggle="pill"
                                            href="#custom-tabs-one-asset_type" role="tab" aria-controls="custom-tabs-one-asset_type"
                                            aria-selected="true">Status Kepemilikan Asset</a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-asset_category-tab" data-toggle="pill"
                                            href="#custom-tabs-one-asset_category" role="tab" aria-controls="custom-tabs-one-asset_category"
                                            aria-selected="true">Kategori Asset</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-asset_status-tab" data-toggle="pill"
                                            href="#custom-tabs-one-asset_status" role="tab" aria-controls="custom-tabs-one-asset_status"
                                            aria-selected="true">Status Asset</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-asset" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-asset-tab"> 
                                        @include('Asset::list')
                                    </div> 
                                    <div class="tab-pane fade show" id="custom-tabs-one-asset_type" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-asset_type-tab"> 
                                        @include('AssetType::list')
                                    </div>  
                                    <div class="tab-pane fade show" id="custom-tabs-one-asset_category" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-asset_category-tab"> 
                                        @include('AssetCategory::list')
                                    </div>  
                                    <div class="tab-pane fade show" id="custom-tabs-one-asset_status" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-asset_status-tab"> 
                                        @include('AssetStatus::list')
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    
@endsection
