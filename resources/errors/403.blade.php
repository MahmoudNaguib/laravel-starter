@extends('layouts.master')
@section('title')
    <h2>{{trans('app.Unauthorized action')}}</h2>
@endsection
@section('content')
   403 {{trans('app.Unauthorized action')}}
@endsection

