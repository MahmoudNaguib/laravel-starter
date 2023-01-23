<?php

namespace App\Exceptions;


class ValidationApiException extends \Exception {

    public function render($request) {
        return response()->json([
            'message'=>trans('app.Validation errors'),
            'errors' => json_decode($this->getMessage(),false)
        ], 422);
    }
}
