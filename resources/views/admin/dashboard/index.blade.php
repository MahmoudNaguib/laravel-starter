@extends('layouts.master')
@section('title')
    <h1>{{ $page_title }}</h1>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
            <div class="single-funfact">
                <div class="funfact-content">
                    <span class="counter"><i class="fa fa-users"></i> {{ @$totalUsers }}</span>
                    <span class="text theme-color">{{ trans('app.Users') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if (can('view-users'))
            <div class="col-xl-12 col-12 mt-5">
                <div class="submited-applications">
                    <div class="applications-heading">
                        <h3>
                            {{ trans('app.Latest') }} {{ trans('app.Users') }}
                            <span class="fs-6">
                                (<a href="admin/users" class="small">
                                    {{ trans('app.View all') }}
                                </a>)
                            </span>
                        </h3>
                    </div>
                </div>
                <div class="job-applications-main-block">
                    <div class="job-applications-table">
                        <table class="table grid-responsive">
                            <thead>
                            <tr>
                                <th class="ml-1">{{ trans('app.ID') }} </th>
                                <th class="ml-2">{{ trans('app.Type') }} </th>
                                <th class="ml-2">{{ trans('app.Name') }} </th>
                                <th class="ml-2">{{ trans('app.Email') }} </th>
                                <th class="ml-2">{{ trans('app.Mobile') }} </th>
                                <th class="ml-2">{{ trans('app.Created at') }}</th>
                                <th class="ml-3">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!@$users->isEmpty())
                                @foreach ($users as $row)
                                    <tr>
                                        <td data-label="#">{{ $row->id }}</td>
                                        <td data-label="{{ trans('app.Type') }}">
                                            {{ $row->type }}
                                        </td>
                                        <td data-label="{{ trans('app.Name') }}">
                                            {{ $row->name }}
                                        </td>
                                        <td data-label="{{ trans('app.Email') }}">
                                            {{ $row->email }}
                                        </td>
                                        <td data-label="{{ trans('app.Mobile') }}">
                                            {{ $row->mobile }}
                                        </td>
                                        <td data-label="{{ trans('app.Created at') }}">
                                            {{ str_limit($row->created_at, 10, false) }}
                                        </td>
                                        <td class="align-last-td" data-label="">
                                            <a class="btn btn-xs" href="admin/users/view/{{ $row->id }}"
                                               title="{{ trans('app.View') }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
