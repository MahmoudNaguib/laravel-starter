@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    {!! Form::model($row,['method' => 'post','files' => true] ) !!}
    {{ csrf_field() }}
    @include($module.'.form',$row)
    <div class="form-group mt-3">
        @include('form.submit',['label'=>trans('app.Submit')])
    </div>
    {!! Form::close() !!}
@endsection

