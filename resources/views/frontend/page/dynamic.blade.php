@extends('frontend.index')

@php
    // dd($content)
@endphp

@section('content')
    <style>
        {!! json_decode($content)->css !!}
    </style>
    {!! json_decode($content)->html !!}
@endsection
