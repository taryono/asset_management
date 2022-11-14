@extends('adminlte::page')

@section('title', 'Management Assets')

@section('content_header')
    <h1 class="m-0 text-dark">Assalamu'alaikum wrwb...</h1>
@stop

@section('content')

    <div id="container"> 
        <div class="row">
            <div class="col-md-12">
                
                <x-adminlte-input-date name="date"/>
                <x-adminlte-date-range name="drBasic"/>
                <x-adminlte-input-switch name="iswMin"/> 
                <x-adminlte-input-switch name="iswText" data-on-text="YES" data-off-text="NO" data-on-color="teal" checked/>
            </div>
        </div>
    </div> 
@stop
