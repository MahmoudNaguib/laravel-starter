<?php

namespace App\Http\Controllers\Api;

class PostsController extends \App\Http\Controllers\Controller {
    /*
     * 200: success   // Can have message
     * 201 created    //Always have message
     * 401: unauthorized  //Always have message
     * 422: Validation error   //Always have message and errors object with the field key that has error
     * 403: Forbidden //Always have message
     * 404: page not found //Always have message
     * 400: Bad Request //Always have message
     */

    public function __construct(\App\Models\Post $model) {
        $this->model = $model;
    }

    public function index() {
        $rows = $this->model->orderBy('id', 'desc')->paginate(env('PAGE_LIMIT'));
        return \App\Http\Resources\PostResource::collection($rows);
    }

    public function show($id) {
        $row = $this->model->findOrFail($id);
        return new \App\Http\Resources\PostResource($row);
    }
}
