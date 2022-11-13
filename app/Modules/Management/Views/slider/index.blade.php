@extends('adminlte::page')  
@section('content') 
    <div id="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manajemen Slide</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        @include('Slider::list')
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    
@endsection
