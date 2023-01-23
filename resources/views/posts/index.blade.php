@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    <div class="container">
        @if (isset($rows) and !$rows->isEmpty())
            <div class="float-end">
                <b>{{ trans('app.Total')}}</b>: {{$rows->total()}} {{trans('app.records')}}
            </div>
            <div class="mt-3">
                <div class="row">
                    @foreach ($rows as $row)
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">{{$row->title}}</h3>
                                    <h4 class="text-secondary">{{trans('app.By')}}: {{$row->creator->name}}</h4>
                                    <a href="{{$row->link}}" class="btn btn-primary">
                                        {{trans('app.More')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {!! $rows->links() !!}
                </div>
            </div>
        @else
            {{ trans('app.There is no results') }}
        @endif
    </div>
@endsection
