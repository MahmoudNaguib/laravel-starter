@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    @if (!$rows->isEmpty())
        <div>
            <div class="float-end">
                <b>{{ trans('app.Total')}}</b>: {{$rows->total()}} {{trans('app.records')}}
            </div>
            <div class="float-start">
                <button class="btn btn-danger delete_all btn-sm mb-2"
                        href="{{$module}}/delete-all"
                        data-confirm="{{trans('app.Are you sure you want to delete the selected')}}?">
                    {{trans('app.Delete selected')}}
                </button>
            </div>
        </div>
        <div class="grid-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="ml-1"><input type="checkbox" id="master"></th>
                    <th class="ml-1">{{trans('app.ID')}} </th>
                    <th class="ml-2">{{trans('app.Title')}} </th>
                    <th class="ml-2">{{trans('app.Seen at')}} </th>
                    <th class="ml-2">{{trans('app.Created at')}}</th>
                    <th class="ml-3">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <td>
                            <input type="checkbox" class="sub_chk" data-id="{{$row->id}}">
                        </td>
                        <td data-label="#">{{$row->id}}</td>
                        <td data-label="{{trans('app.Title')}}">
                            {{$row->title}}
                        </td>
                        <td data-label="{{trans('app.Seen at')}}">
                            {{($row->seen_at)?str_limit($row->seen_at,10,false):'----'}}
                        </td>
                        <td data-label="{{trans('app.Created at')}}">
                            {{$row->created_at}}
                        </td>
                        <td data-label="">
                            <a class="btn btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('app.View')}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs" href="{{$module}}/delete/{{$row->id}}" title="{{trans('app.Delete')}}" data-confirm="{{trans('app.Are you sure you want to delete')}}?">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $rows->render() !!}
        </div>
    @else
        <div class="container">{{trans("app.There is no results")}}</div>
    @endif
@endsection

