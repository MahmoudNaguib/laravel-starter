<?php

namespace App\Http\Controllers;


class AboutController extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->module = 'about';
    }

    public function index() {
        $data['page_title'] = trans('app.About us');
        return view($this->module . '.index', $data);
    }
}
