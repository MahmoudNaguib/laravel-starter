@extends('layouts.master')
@section('title')
    <h1>{{$page_title}}</h1>
@endsection
@section('content')
    <div class="mt-3">
        <table class="table table-striped table-view">
            <tr>
                <td>{{trans('app.Title')}}</td>
                <td>
                    {{$row->title}}
                    @if(auth()->user()->type=='employee')
                        @if($row->entity_type=='applications')
                            <a href="{{lang()}}/employee/applications/view/{{$row->entity_id}}" class="btn btn-secondary">
                                {{trans('app.View application')}}
                            </a>
                        @elseif($row->entity_type=='jobs')
                            <a href="{{lang()}}/jobs/details/{{$row->entity_id}}" class="btn btn-secondary">
                                {{trans('app.View job')}}
                            </a>
                        @endif
                    @endif

                    @if(auth()->user()->type=='recruiter')
                        @if($row->entity_type=='applications')
                            <a href="{{lang()}}/recruiter/applications/view/{{$row->entity_id}}" class="btn btn-secondary">
                                {{trans('app.View application')}}
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td>{{trans('app.Content')}}</td>
                <td>{!!$row->content!!}</td>
            </tr>
            <tr>
                <td>{{trans('app.Seen at')}}</td>
                <td>{{@$row->seen_at}}</td>
            </tr>
            <tr>
                <td>{{trans('app.Created at')}}</td>
                <td>{{@$row->created_at}}</td>
            </tr>
        </table>
    </div>
@endsection

