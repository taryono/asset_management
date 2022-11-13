@extends('layouts.w')
@section('content')
    <div class="card" style="margin-top: 10px; min-height: 1000px;">
        <div class="card-header">
            <div class="card-title">
                {{ is_exists($post, 'title') }}
            </div>
        </div>
        <div class="card-body"> 
            {{dump($post)}}
            {!! is_exists($post, 'content', 'Content tidak ditemukan') !!}
        </div>
        <div class="card-footer">
            <blockquote>Semoga Bermanfaat Untuk Umat</blockquote>
        </div>
    </div>
@stop
