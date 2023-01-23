@extends('emails.master')

@section('title')
    {{appName().' - '.trans('email.Contact us message')}}
@endsection

@section('content')

    @if($row->name)
        <p>
            <strong>{{trans("email.Name")}} : </strong> {{$row->name}}
        </p>
    @endif

    @if($row->email)
        <p>
            <strong>{{trans("email.Email")}} : </strong> {{$row->email}}
        </p>
    @endif

    @if($row->mobile)
        <p>
            <strong>{{trans("email.Mobile")}} : </strong> {{$row->mobile}}
        </p>
    @endif

    @if($row->title)
        <p>
            <strong>{{trans("email.Title")}} : </strong> {{$row->title}}
        </p>
    @endif

    @if($row->content)
        <p>
            <strong>{{trans("email.Content")}} : </strong> {{$row->content}}
        </p>
    @endif

@endsection
