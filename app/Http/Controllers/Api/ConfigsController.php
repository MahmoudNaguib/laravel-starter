<?php

namespace App\Http\Controllers\Api;

class ConfigsController extends \App\Http\Controllers\Controller {
    /*
     * 200: success   // Can have message
     * 201 created    //Always have message
     * 401: unauthorized  //Always have message
     * 422: Validation error   //Always have message and errors object with the field key that has error
     * 403: Forbidden //Always have message
     * 404: page not found //Always have message
     * 400: Bad Request //Always have message
     */

    public function __construct(\App\Models\Config $model) {
        $this->model = $model;
    }

    public function getIndex() {
        $rows = getConfigsPairs();
        return response()->json(['data' => $rows], 200);
    }
}
