<?php

namespace App\Http\Controllers;


class PrivacyController extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->module = 'privacy';
    }

    public function index() {
        $data['page_title'] = trans('app.Privacy policy');
        return view($this->module . '.index', $data);
    }
}
