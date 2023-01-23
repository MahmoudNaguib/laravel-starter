<?php

namespace App\Http\Controllers;


class TermsController extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->module = 'terms';
    }

    public function index() {
        $data['page_title'] = trans('app.Terms and conditions');
        return view($this->module . '.index', $data);
    }
}
