@extends('layouts.master')
@section('title')
    <h1>
        {{$page_title}}
        <div class="create-view-btns">
            <a href="{{$module}}/create" class="btn btn-success">
                <i class="fa fa-plus"></i> {{trans('app.Create')}}
            </a>
            <a href="{{$module}}/export?{{@$_SERVER['QUERY_STRING']}}" class="btn btn-secondary">
                <i class="fa fa-download"></i> {{trans('app.Export')}}
            </a>
        </div>
    </h1>
@endsection
@section('content')
    @include($module.'.partials.filters',['row'=>@$row])
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
                    <th class="ml-2">{{trans('app.Is approved')}} </th>
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
                        <td data-label="{{trans('app.Is approved')}}">
                            {{($row->is_approved)?trans('app.Yes'):trans('app.No')}}
                        </td>
                        <td data-label="{{trans('app.Created at')}}">
                            {{$row->created_at}}
                        </td>
                        <td data-label="">
                            <a class="btn btn-xs" href="{{lang()}}/{{$module}}/edit/{{$row->id}}"
                               title="{{trans('app.Edit')}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-xs" href="{{lang()}}/{{$module}}/view/{{$row->id}}"
                               title="{{trans('app.View')}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs" href="{{$module}}/delete/{{$row->id}}" title="{{trans('app.Delete')}}"
                               data-confirm="{{trans('app.Are you sure you want to delete')}}?">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $rows->appends([
        'title'=>request('title'),
        ])->links() !!}
        </div>
    @else
        <div class="container">{{trans("app.There is no results")}}</div>
    @endif
@endsection

