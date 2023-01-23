@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    <div class="alert alert-{{$type}}" role="alert">
        {{$message}}
    </div>
@endsection

