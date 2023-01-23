<?php

namespace App\Http\Controllers\Api\Logged;

class NotificationsController extends \App\Http\Controllers\Controller {
    /*
     * 200: success   // Can have message
     * 201 created    //Always have message
     * 401: unauthorized  //Always have message
     * 422: Validation error   //Always have message and errors object with the field key that has error
     * 403: Forbidden //Always have message
     * 404: page not found //Always have message
     * 400: Bad Request //Always have message
     */
    public function __construct(\App\Models\Notification $model) {
        $this->model = $model;
    }

    public function index() {
        $rows = $this->model->own()->orderBy('seen_at', 'asc')->orderBy('id', 'desc')->paginate(env('PAGE_LIMIT'));
        return \App\Http\Resources\NotificationResource::collection($rows);
    }

    public function show($id) {
        $row = $this->model->own()->findOrFail($id);
        $row->seen_at = date('Y-m-d H:i:s');
        $row->save();
        if ($row)
            return new \App\Http\Resources\NotificationResource($row);
    }

    public function destroy($id) {
        $row = $this->model->own()->findOrFail($id);
        if ($row->delete()) {
            return response()->json(['message' => trans('app.Deleted successfully')], 200);
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 204);
    }

    public function getUnseenCount() {
        $count = $this->model->own()->unreaded()->count();
        return response()->json(['data'=>['count'=>$count]], 200);
    }

    public function getSeeAll() {
        if ($this->model->own()->update(['seen_at' => date('Y-m-d H:i:s')])) {
            return response()->json(['message' => trans('app.Seen all successfully')], 200);
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 204);
    }

    public function getDeleteAll() {
        if ($this->model->own()->delete()) {
            return response()->json(['message' => trans('app.Deleted successfully')], 200);
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 204);
    }

}
