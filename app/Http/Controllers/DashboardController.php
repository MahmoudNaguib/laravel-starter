<?php

namespace App\Http\Controllers;

class DashboardController extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->module = 'dashboard';
        $this->title = trans('app.Dashboard');
    }

    public function getIndex() {
        $data['module'] = $this->module;
        $data['page_title'] = $this->title;
        return view( $this->module . '.index', $data);
    }

}
