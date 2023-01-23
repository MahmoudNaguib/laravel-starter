<?php

namespace App\Http\Controllers\Api\Logged;

class MyPostsController extends \App\Http\Controllers\Controller {
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
        $this->rules = $model->rules;
    }

    public function index() {
        $rows = $this->model->filterAndSort()->own()->paginate(env('PAGE_LIMIT'));
        return \App\Http\Resources\PostResource::collection($rows);
    }

    public function show($id) {
        return new \App\Http\Resources\PostResource($this->model->includes()->own()->findOrFail($id));
    }

    public function store() {
        ValidateRequestApi(request()->all(), $this->rules);
        if ($row = $this->model->create(request()->except(['is_approved']))) {
            $row=$this->model->find($row->id);
            return response()->json([
                'message' => trans('app.Created successfully'),
                'data' => new \App\Http\Resources\PostResource($row)
            ], 201);
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 400);
    }

    public function update($id) {
        $row = $this->model->own()->findOrFail($id);
        ValidateRequestApi(request()->all(), $this->rules);
        if ($row->update(request()->except(['is_active']))) {
            return response()->json([
                'message' => trans('app.Updated successfully'),
                'data' => new \App\Http\Resources\PostResource($row)
            ], 200);
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 400);
    }

    public function destroy($id) {
        $row = $this->model->own()->findOrFail($id);
        if ($row->delete()) {
            return response()->json([
                'message' => trans('app.Deleted successfully'),
            ], 200);
            return response()->json(['message' => trans('app.Failed to handle your request')], 400);
        }
    }

}
