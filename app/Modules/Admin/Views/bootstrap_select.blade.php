@extends('adminlte::page') 
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
 {{-- Minimal --}}
<x-adminlte-select-bs name="selBsBasic">
    <option>Option 1</option>
    <option disabled>Option 2</option>
    <option selected>Option 3</option>
</x-adminlte-select-bs>

{{-- Disabled --}}
<x-adminlte-select-bs name="selBsDisabled" disabled>
    <option>Option 1</option>
    <option>Option 2</option>
</x-adminlte-select-bs>

{{-- With prepend slot, label and data-* config --}}
<x-adminlte-select-bs name="selBsVehicle" label="Vehicle" label-class="text-lightblue"
    igroup-size="lg" data-title="Select an option..." data-live-search
    data-live-search-placeholder="Search..." data-show-tick>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-info">
            <i class="fas fa-car-side"></i>
        </div>
    </x-slot>
    <option data-icon="fa fa-fw fa-car">Car</option>
    <option data-icon="fa fa-fw fa-motorcycle">Motorcycle</option>
</x-adminlte-select-bs>

{{-- With multiple slots, plugin config parameter and custom options --}}
@php
    $config = [
        "title" => "Select multiple options...",
        "liveSearch" => true,
        "liveSearchPlaceholder" => "Search...",
        "showTick" => true,
        "actionsBox" => true,
    ];
@endphp
<x-adminlte-select-bs id="selBsCategory" name="selBsCategory[]" label="Categories"
    label-class="text-danger" igroup-size="sm" :config="$config" multiple>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-red">
            <i class="fas fa-tag"></i>
        </div>
    </x-slot>
    <x-slot name="appendSlot">
        <x-adminlte-button theme="outline-dark" label="Clear" icon="fas fa-lg fa-ban text-danger"/>
    </x-slot>
    <option data-icon="fa fa-fw fa-running text-info" data-subtext="Running">Sports</option>
    <option data-icon="fa fa-fw fa-futbol text-info" data-subtext="Futbol">Sports</option>
    <option data-icon="fa fa-fw fa-newspaper text-danger">News</option>
    <option data-icon="fa fa-fw fa-gamepad text-warning">Games</option>
    <option data-icon="fa fa-fw fa-flask text-primary">Science</option>
    <option data-icon="fa fa-fw fa-calculator text-dark">Maths</option>
</x-adminlte-select-bs>
@section('adminlte_js')

@endsection
@endsection
