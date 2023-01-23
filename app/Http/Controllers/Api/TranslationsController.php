<?php

namespace App\Http\Controllers\Api;

class TranslationsController extends \App\Http\Controllers\Controller {
    /*
     * 200: success   // Can have message
     * 201 created    //Always have message
     * 401: unauthorized  //Always have message
     * 422: Validation error   //Always have message and errors object with the field key that has error
     * 403: Forbidden //Always have message
     * 404: page not found //Always have message
     * 400: Bad Request //Always have message
     */
    public function __construct() {}

    public function index() {
        $rows = getMainTranslations('app');
        return response()->json(['data' => $rows], 200);
    }
}
