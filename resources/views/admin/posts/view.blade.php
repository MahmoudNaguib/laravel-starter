@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    <div class="mt-3">
        <table class="table table-striped table-view">
            <tr>
                <td>{{trans('app.Title')}}</td>
                <td>{{$row->title}}</td>
            </tr>
            <tr>
                <td>{{trans('app.Content')}}</td>
                <td>
                    {!! $row->content !!}
                </td>
            </tr>
            <tr>
                <td>{{trans('app.Is approved')}}</td>
                <td>
                    {{($row->is_approved)?trans('app.Yes'):trans('app.No')}}
                </td>
            </tr>
            <tr>
                <td>{{trans('app.Created at')}}</td>
                <td>{{@$row->created_at}}</td>
            </tr>
        </table>
    </div>
@endsection

