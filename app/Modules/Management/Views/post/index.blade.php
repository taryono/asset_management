@extends('adminlte::page')  
@section('content') 
    <div id="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manajemen Blog</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-post-tab" data-toggle="pill"
                                            href="#custom-tabs-one-post" role="tab" aria-controls="custom-tabs-one-post"
                                            aria-selected="true">Post</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-post_status-tab" data-toggle="pill"
                                            href="#custom-tabs-one-post_status" role="tab" aria-controls="custom-tabs-one-post_status"
                                            aria-selected="true">Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-category-tab" data-toggle="pill"
                                            href="#custom-tabs-one-category" role="tab" aria-controls="custom-tabs-one-category"
                                            aria-selected="true">Kategori</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-category_group-tab" data-toggle="pill"
                                            href="#custom-tabs-one-category_group" role="tab" aria-controls="custom-tabs-one-category_group"
                                            aria-selected="true">Grup Kategori</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-post" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-post-tab"> 
                                        @include('Post::list')
                                    </div> 
                                    <div class="tab-pane fade show" id="custom-tabs-one-post_status" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-post_status-tab"> 
                                        @include('PostStatus::list')
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-category" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-category-tab"> 
                                        @include('Category::list')
                                    </div> 
                                    <div class="tab-pane fade show" id="custom-tabs-one-category_group" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-category_group-tab"> 
                                        @include('CategoryGroup::list')
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
