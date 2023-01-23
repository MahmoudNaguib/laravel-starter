<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

    private $module;

    public function __construct() {
        $this->module = 'home';
    }

    public function index() {
        $data['page_title'] = trans('app.Home');
        return view($this->module . '.index', $data);
    }
}
