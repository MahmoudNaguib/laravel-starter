@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    {!! conf('about') !!}
@endsection

