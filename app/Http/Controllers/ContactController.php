<?php

namespace App\Http\Controllers;


class ContactController extends \App\Http\Controllers\Controller {

    public function __construct(\App\Models\Message $model) {
        $this->module = 'contact';
        $this->model = $model;
        $this->rules = $model->rules;
    }

    public function getIndex() {
        $data['page_title'] = trans('app.Contact us');
        $data['row'] = $this->model;
        return view($this->module . '.index', $data);
    }

    public function postIndex() {
        $this->validate(request(), $this->rules);
        if ($row = $this->model->create(request()->all())) {
            flash()->success(trans('app.Your message has been sent'));
            return back();
        }
        flash()->error(trans('app.Failed to handle your request'));
        return back();
    }
}
