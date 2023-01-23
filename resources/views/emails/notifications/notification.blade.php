@extends('emails.master')

@section('title'){{ trans('email.New notification') . '-' . appName() }} @endsection

@section('content')
    <h2>{{trans("email.New notification has been received")}}</h2>
    <p>
        <label>
            <strong>{{trans("email.Dear")}} {{ $row->user->name }}</strong> ,
        </label>
    </p>
    <p>
        {{$row->title}}
    </p>
    <p>
        {!! $row->content !!}
    </p>
@endsection
