@extends('adminlte::page')  
@section('content') 
    <div id="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manajemen Halaman</h1>
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
                                        <a class="nav-link active" id="custom-tabs-one-post-tab" data-toggle="pill"
                                            href="#custom-tabs-one-post" role="tab" aria-controls="custom-tabs-one-post"
                                            aria-selected="true">Page</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-category-tab" data-toggle="pill"
                                            href="#custom-tabs-one-category" role="tab" aria-controls="custom-tabs-one-category"
                                            aria-selected="true">Kategori</a>
                                    </li>
                                     
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-post" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-post-tab"> 
                                         
                                        @include('Page::list')
                                    </div> 
                                    <div class="tab-pane fade show" id="custom-tabs-one-category" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-category-tab"> 
                                    @include('Category::list')
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
