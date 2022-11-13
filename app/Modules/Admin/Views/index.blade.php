@extends('adminlte::page')
 
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div id="container">
    @include('Admin::list')
</div> 
@stop


 
 