@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    <div class="loginForm">
        {!! Form::model($row,['method' => 'post','files' => true] ) !!}
        {{ csrf_field() }}
        @include('form.input',['name'=>'email','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Email'),'placeholder'=>trans('app.Email'),'autocomplete'=>"off",'required'=>1]])

        <div class="form-group mt-4">
            @include('form.submit',['label'=>trans('app.Submit')])
            <div class="form_links mt-3">
                <a href="auth/login">{{ trans('app.Login') }}</a> |
                <a href="auth/register">{{ trans('app.Register') }}</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

