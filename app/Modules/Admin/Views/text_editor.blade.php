@extends('adminlte::page')
 
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
 {{-- Minimal --}}
<x-adminlte-text-editor name="teBasic"/>

{{-- Disabled with content --}}
<x-adminlte-text-editor name="teDisabled" disabled>
    <b>Lorem ipsum dolor sit amet</b>, consectetur adipiscing elit.
    <br>
    <i>Aliquam quis nibh massa.</i>
</x-adminlte-text-editor>

{{-- With placeholder, sm size, label and some configuration --}}
@php
$config = [
    "height" => "100",
    "toolbar" => [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']],
    ],
]
@endphp
<x-adminlte-text-editor name="teConfig" label="WYSIWYG Editor" label-class="text-danger"
    igroup-size="sm" placeholder="Write some text..." :config="$config"/>
@section('adminlte_js')

@endsection
@endsection
