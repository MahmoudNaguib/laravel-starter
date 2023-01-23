<?php

namespace App\Http\Controllers\Admin;


class PostsController extends \App\Http\Controllers\Controller {

    public function __construct(\App\Models\Post $model) {
        $this->module = 'admin/posts';
        $this->title = trans('app.Posts');
        $this->model = $model;
        $this->rules = $model->rules;
    }

    public function getIndex() {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.List') . " " . $this->title;
        $data['rows'] = $this->model->filterAndSort()->paginate(env('PAGE_LIMIT'));
        $data['row'] = $this->model;
        return view($this->module . '.index', $data);
    }

    public function getCreate() {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Create') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model;
        return view($this->module . '.create', $data);
    }

    public function postCreate() {
        $this->validate(request(), $this->rules);
        if ($row = $this->model->create(request()->all())) {
            flash()->success(trans('app.Created successfully'));
            return redirect($this->module);
        }
        flash()->error(trans('app.Failed to handle your request'));
    }

    public function getEdit($id) {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->module . '.edit', $data);
    }

    public function postEdit($id) {
        $row = $this->model->findOrFail($id);
        $this->rules['attach'] = 'nullable|max:4000';
        $this->validate(request(), $this->rules);
        if ($row->update(request()->all())) {
            flash(trans('app.Update successfully'))->success();
            return back();
        }
    }

    public function getView($id) {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.View') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->module . '.view', $data);
    }

    public function getDeleteAll() {
        $rows = $this->model->whereIn('id', explode(',', request('ids')))->get();
        if ($rows) {
            foreach ($rows as $row) {
                $row->delete();
            }
        }
        flash()->success(trans('app.Deleted successfully'));
        return back();
    }

    public function getDelete($id) {
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('app.Deleted successfully'));
        return back();
    }

    public function getExport() {
        $rows = $this->model->filterAndSort()->get();
        if ($rows->isEmpty()) {
            flash()->error(trans('app.There is no results to export'));
            return back();
        }
        return $this->model->export($rows, $this->module);
    }

}
