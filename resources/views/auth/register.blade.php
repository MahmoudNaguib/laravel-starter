@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    <div class="loginForm">
        {!! Form::model($row,['method' => 'post','files' => true] ) !!}
        {{ csrf_field() }}

        @include('form.input',['name'=>'name','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Name'),'placeholder'=>trans('app.Name'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'email','type'=>'email','attributes'=>['class'=>'form-control','label'=>trans('app.Email'),'placeholder'=>trans('app.Email'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'mobile','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Mobile'),'placeholder'=>trans('app.Mobile'),'autocomplete'=>"off",'required'=>1]])

        @include('form.password',['name'=>'password','attributes'=>['class'=>'form-control','label'=>trans('app.Password'),'placeholder'=>trans('app.Password'),'required'=>1]])

        @include('form.password',['name'=>'password_confirmation','attributes'=>['class'=>'form-control','label'=>trans('app.Password confirmation'),'placeholder'=>trans('app.Password confirmation'),'required'=>1]])
        <div class="terms mt-3 text-left">
            <a href="{{lang()}}/terms" target="_blank">
                {{trans('app.Terms and conditions')}}
            </a>
            |
            <a href="{{lang()}}/privacy" target="_blank">
                {{trans('app.Privacy policy')}}
            </a>
        </div>
        <div class="form-group mt-3">
            @include('form.submit',['label'=>trans('app.Submit')])
            <div class="form_links mt-4">
                <a href="auth/forgot-password">{{ trans('app.Forgot password') }}</a> |
                <a href="auth/login">{{ trans('app.Login') }}</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

