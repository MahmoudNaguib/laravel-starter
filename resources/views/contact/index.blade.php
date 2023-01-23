@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    {!! Form::model($row,['method' => 'post','files' => true] ) !!}
    {{ csrf_field() }}
    @include('form.input',['name'=>'name','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Name'),'placeholder'=>trans('app.Name'),'autocomplete'=>"off",'required'=>1]])

    @include('form.input',['name'=>'email','type'=>'email','attributes'=>['class'=>'form-control','label'=>trans('app.Email'),'placeholder'=>trans('app.Email'),'autocomplete'=>"off",'required'=>1]])

    @include('form.input',['name'=>'mobile','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Mobile'),'placeholder'=>trans('app.Mobile'),'autocomplete'=>"off",'required'=>1]])

    @include('form.input',['name'=>'title','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Title'),'placeholder'=>trans('app.Title'),'required'=>1]])

    @include('form.input',['name'=>'content','type'=>'textarea','attributes'=>['class'=>'form-control ','label'=>trans
    ('app.Content'),'placeholder'=>trans('app.Content'),'required'=>1]])

    <div class="{{(lang()=='en')?'form-group text-end mt-3':'form-group text-start mt-3'}}">
        @include('form.submit',['label'=>trans('app.Submit')])
    </div>
    {!! Form::close() !!}
@endsection

