<?php

namespace App\Http\Controllers;


class PostsController extends \App\Http\Controllers\Controller {

    public function __construct(\App\Models\Post $model) {
        $this->module = 'posts';
        $this->title = trans('app.Posts');
        $this->model = $model;
    }

    public function getIndex() {
        $data['page_title'] = trans('app.List') . " " . $this->title;
        $data['module'] = $this->module;
        $data['rows'] = $this->model->filterAndSort()->approved()->paginate(env('PAGE_LIMIT'));
        return view($this->module . '.index', $data);
    }

    public function getDetails($id, $slug = null) {
        $data['row'] = $row = $this->model->approved()->findOrFail($id);
        $data['page_title'] =  $row->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['module'] = $this->module;
        return view($this->module . '.details', $data);
    }
}
