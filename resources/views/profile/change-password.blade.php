@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    {!! Form::model($row,['method' => 'post','files' => true] ) !!}
    {{ csrf_field() }}

    @include('form.password',['name'=>'old_password','attributes'=>['class'=>'form-control','label'=>trans('app.Old password'),'placeholder'=>trans('app.Old password'),'required'=>1]])

    @include('form.password',['name'=>'password','attributes'=>['class'=>'form-control','label'=>trans('app.Password'),'placeholder'=>trans('app.Password'),'required'=>1]])

    @include('form.password',['name'=>'password_confirmation','attributes'=>['class'=>'form-control','label'=>trans('app.Password confirmation'),'placeholder'=>trans('app.Password confirmation'),'required'=>1]])

    <div class="{{(lang()=='en')?'form-group text-end mt-3':'form-group text-start mt-3'}}">
        @include('form.submit',['label'=>trans('app.Submit')])
    </div>
    {!! Form::close() !!}
@endsection

