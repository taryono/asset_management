@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')

    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
    <x-notification-component/>
    <x-adminlte-modal id="modalMin" title="Tambah Data" theme="primary">
        <div style="height: 80%"></div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="" theme="success submit-button" label="Simpan"/>
            <x-adminlte-button class="closed" theme="danger" label="Batal" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>

    <x-adminlte-modal id="modalUpdate" title="Update Data" theme="primary">
        <div style="height: 80%"></div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="" theme="success update-button" label="Simpan"/>
            <x-adminlte-button class="closed" theme="danger" label="Batal" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>
    
    <x-adminlte-modal id="modalDelete" title="Apakah Anda Yakin Hapus Data Ini ?" theme="danger">
        <div style="height: 80%"></div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="" theme="success delete-button" label="Hapus"/>
            <x-adminlte-button class="closed" theme="danger" label="Batal" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>

    <x-adminlte-modal id="modalPopupDetail" theme="primary">
        <div style="height: 80%"></div> 
    </x-adminlte-modal>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
