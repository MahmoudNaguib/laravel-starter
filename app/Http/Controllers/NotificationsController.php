<?php

namespace App\Http\Controllers;


class NotificationsController extends \App\Http\Controllers\Controller {

    public function __construct(\App\Models\Notification $model) {
        $this->module = 'notifications';
        $this->title = trans('app.Notifications');
        $this->model = $model;
    }

    public function getIndex() {
        $data['page_title'] = trans('app.List') . " " . $this->title;
        $data['module'] = $this->module;
        $data['rows'] = $this->model->filterAndSort()->own()->paginate(env('PAGE_LIMIT'));
        return view($this->module . '.index', $data);
    }

    public function getView($id) {
        $data['page_title'] = trans('app.View') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['module'] = $this->module;
        $data['row'] = $this->model->own()->findOrFail($id);
        if ($data['row']) {
            $data['row']->seen_at = date("Y-m-d H:i:s");
            $data['row']->save();
        }
        return view($this->module . '.view', $data);
    }

    public function getDelete($id) {
        $row = $this->model->own()->findOrFail($id);
        if ($row->delete()) {
            flash()->success(trans('app.Deleted Successfully'));
            return back();
        }
    }

    public function getDeleteAll() {
        $rows = $this->model->whereIn('id', explode(',', request('ids')))->get();
        if ($rows) {
            foreach ($rows as $row) {
                $row->delete();
            }
        }
        flash()->success(trans('app.Deleted successfully'));
        return back();
    }
}
