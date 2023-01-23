@extends('layouts.master')
@section('title')
    <h1>{{ $page_title }}</h1>
@endsection
@section('content')
    <div class="row mt-5">
        {{trans('app.Dashboard1')}}
    </div>
@endsection
