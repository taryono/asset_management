@extends('print.index')

@section('header')
    @if($enable_header ) 
        @include('print.header')
    @endif
@stop

@section('body') 
    @include('print.scriptStart') 
        @include($template) 
    @include('print.scriptEnd') 
@stop
 
@section('footer')
    @if($enable_footer)
        @if(view()->exists('print.footer'))
            @include('print.footer')
        @endif
    @endif
@stop