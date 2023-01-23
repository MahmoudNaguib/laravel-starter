@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    <div class="loginForm">
        {!! Form::model($row,['method' => 'post','files' => true] ) !!}
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{request('token')}}">
        @include('form.password',['name'=>'password','attributes'=>['class'=>'form-control','label'=>trans('app.Password'),'placeholder'=>trans('app.Password'),'autocomplete'=>"off",'required'=>1]])

        @include('form.password',['name'=>'password_confirmation','attributes'=>['class'=>'form-control','label'=>trans('app.Password confirmation'),'placeholder'=>trans('app.Password confirmation'),'autocomplete'=>"off",'required'=>1]])

        <div class="form-group mt-3">
            @include('form.submit',['label'=>trans('app.Submit')])
            <div class="form_links mt-3">
                <a href="auth/login">{{ trans('app.Login') }}</a> |
                <a href="auth/register">{{ trans('app.Register') }}</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

