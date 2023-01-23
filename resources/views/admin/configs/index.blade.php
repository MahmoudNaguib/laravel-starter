@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    {!! Form::open(['method' => 'post','files' => true] ) !!} {{ csrf_field() }}
    {{ csrf_field() }}
    <div style="width:75%" class="form-group mt-3">
        @include('form.input',['name'=>'app_name','value'=>conf('app_name'),'type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Application name'),'placeholder'=>trans('app.Application name'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'contact_email','value'=>conf('contact_email'),'type'=>'email','attributes'=>['class'=>'form-control','label'=>trans('app.Contact email'),'placeholder'=>trans('app.Contact email'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'facebook','value'=>conf('facebook'),'type'=>'url','attributes'=>['class'=>'form-control','label'=>trans('app.Facebook'),'placeholder'=>trans('app.Facebook'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'twitter','value'=>conf('twitter'),'type'=>'url','attributes'=>['class'=>'form-control','label'=>trans('app.Twitter'),'placeholder'=>trans('app.Twitter'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'linkedin','value'=>conf('linkedin'),'type'=>'url','attributes'=>['class'=>'form-control','label'=>trans('app.Linkedin'),'placeholder'=>trans('app.Linkedin'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'youtube','value'=>conf('youtube'),'type'=>'url','attributes'=>['class'=>'form-control','label'=>trans('app.Youtube'),'placeholder'=>trans('app.Youtube'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'about','value'=>conf('about'),'type'=>'textarea','attributes'=>['class'=>'form-control','label'=>trans('app.About'),'placeholder'=>trans('app.About'),'autocomplete'=>"off",'required'=>1]])

        @include('form.input',['name'=>'terms_and_conditions','value'=>conf('terms_and_conditions'),'type'=>'textarea','attributes'=>['class'=>'form-control','label'=>trans('app.Terms and conditions'),'placeholder'=>trans('app.Terms and conditions'),'autocomplete'=>"off",'required'=>1]])

        @include('form.file',['name'=>'logo','attributes'=>['class'=>'form-control custom-file-input','label'=>trans('app.Logo'),'placeholder'=>trans('app.Logo'),'value'=>conf('logo')]])

        <div class="{{(lang()=='en')?'form-group text-end mt-3':'form-group text-start mt-3'}}">
            @include('form.submit',['label'=>trans('app.Submit')])
        </div>
    </div>
    {!! Form::close() !!}
@endsection

