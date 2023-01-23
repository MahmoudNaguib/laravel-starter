@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="container">
            <h1>{{$row->title}}</h1>
            <p>{!! $row->content !!}</p>
            <h4 class="text-secondary">{{trans('app.By')}}: {{$row->creator->name}}</h4>
        </div>
    </div>
@endsection
