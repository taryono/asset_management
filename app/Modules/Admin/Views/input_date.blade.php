@extends('adminlte::page')
 
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    {{-- Minimal --}}
    <x-adminlte-input-date name="idBasic" />

    {{-- Disabled with predefined value --}}
    @php
    $config = ['format' => 'YYYY-MM-DD'];
    @endphp
    <x-adminlte-input-date name="idDisabled" value="2020-10-04" :config="$config" disabled />

    {{-- Placeholder, time only and prepend icon --}}
    @php
    $config = ['format' => 'LT'];
    @endphp
    <x-adminlte-input-date name="idTimeOnly" :config="$config" placeholder="Choose a time...">
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-clock"></i>
            </div>
        </x-slot>
    </x-adminlte-input-date>

    {{-- Placeholder, date only and append icon --}}
    @php
    $config = ['format' => 'L'];
    @endphp
    <x-adminlte-input-date name="idDateOnly" :config="$config" placeholder="Choose a date...">
        <x-slot name="appendSlot">
            <div class="input-group-text bg-gradient-danger">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </x-slot>
    </x-adminlte-input-date>

    {{-- With Label --}}
    @php
    $config = ['format' => 'DD/MM/YYYY HH:mm'];
    @endphp
    <x-adminlte-input-date name="idLabel" :config="$config" placeholder="Choose a date..." label="Datetime"
        label-class="text-primary">
        <x-slot name="appendSlot">
            <x-adminlte-button theme="outline-primary" icon="fas fa-lg fa-birthday-cake" title="Set to Birthday" />
        </x-slot>
    </x-adminlte-input-date>

    {{-- SM size, restricted to current month and week days --}}
    @php
    $config = [
        'format' => 'YYYY-MM-DD HH.mm',
        'dayViewHeaderFormat' => 'MMM YYYY',
        'minDate' => "js:moment().startOf('month')",
        'maxDate' => "js:moment().endOf('month')",
        'daysOfWeekDisabled' => [0, 6],
    ];
    @endphp
    <x-adminlte-input-date name="idSizeSm" label="Working Datetime" igroup-size="sm" :config="$config"
        placeholder="Choose a working day...">
        <x-slot name="appendSlot">
            <div class="input-group-text bg-dark">
                <i class="fas fa-calendar-day"></i>
            </div>
        </x-slot>
    </x-adminlte-input-date>

    {{-- LG size with multiple datetimes --}}
    @php
    $config = [
        'allowMultidate' => true,
        'multidateSeparator' => ',',
        'format' => 'DD MMM YYYY',
    ];
    @endphp
    <x-adminlte-input-date name="idSizeLg" label="Multiple Datetimes" label-class="text-danger" igroup-size="lg"
        placeholder="Multidate..." :config="$config">
        <x-slot name="prependSlot">
            <div class="input-group-text bg-white">
                <i class="far fa-lg fa-calendar-alt text-danger"></i>
            </div>
        </x-slot>
    </x-adminlte-input-date>

@section('adminlte_js')

@endsection
@endsection
