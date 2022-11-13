@extends('adminlte::page')
 
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    {{-- Minimal --}}
<x-adminlte-input-switch name="iswMin"/>

{{-- Disabled --}}
<x-adminlte-input-switch name="iswDisabled" disabled/>

{{-- With colors using data-* config --}}
<x-adminlte-input-switch name="iswColor" data-on-color="success" data-off-color="danger" checked/>

{{-- With custom text using data-* config --}}
<x-adminlte-input-switch name="iswText" data-on-text="YES" data-off-text="NO"
    data-on-color="teal" checked/>

{{-- Label, and prepend icon --}}
<x-adminlte-input-switch name="iswPrepend" label="Switch">
    <x-slot name="prependSlot">
        <div class="input-group-text bg-lightblue">
            <i class="fas fa-toggle-on"></i>
        </div>
    </x-slot>
</x-adminlte-input-switch>

{{-- Label, slots and lg size --}}
@php
$config = [
    'onColor' => 'orange',
    'offColor' => 'dark',
    'inverse' => true,
    'animate' => false,
    'state' => true,
    'labelText' => '<i class="fas fa-2x fa-fw fa-lightbulb text-orange"></i>',
];
@endphp
<x-adminlte-input-switch name="iswSizeLG" label="Switch LG" igroup-size="lg"
    :config="$config">
    <x-slot name="appendSlot">
        <x-adminlte-button icon="fas fa-caret-right" title="On"/>
    </x-slot>
    <x-slot name="prependSlot">
        <x-adminlte-button icon="fas fa-caret-left" title="Off"/>
    </x-slot>
</x-adminlte-input-switch>

{{-- Indeterminate with icon and SM size --}}
@php
$config = [
    'onColor' => 'indigo',
    'offColor' => 'gray',
    'onText' => '1',
    'offText' => '0',
    'indeterminate' => true,
    'labelText' => '<i class="fas fa-power-off text-muted"></i>',
];
@endphp
<x-adminlte-input-switch name="iswSizeSM" label="Switch SM (indeterminate)"
    igroup-size="sm" :config="$config"/>

@section('adminlte_js')

@endsection
@endsection
