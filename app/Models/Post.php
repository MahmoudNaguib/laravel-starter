<?php

namespace App\Models;

class Post extends BaseModel {
    use \App\Models\Traits\CreatedBy;

    protected $table = "posts";
    protected $guarded = [
        'deleted_at',
    ];
    protected $hidden = [
        'deleted_at',
    ];
    public $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function includes() {
        return $this->with(['creator']);
    }

    public function scopeOwn($query) {
        return $query->where('created_by', '=', @auth()->user()->id);
    }

    public function scopeApproved($query) {
        return $query->where('is_approved', '=', 1);
    }

    public function scopeFilterAndSort() {
        return $this->includes()
            ->when(request('title'), function ($q) {
                return $q->where('title', 'LIKE', '%' . trim(request('title')) . '%');
            })
            ->when(request('order_field'), function ($q) {
                return $q->orderBy((request('order_field')), (request('order_type')) ?: 'desc');
            })
            ->orderBy('id', 'desc');
    }

    public function export($rows, $fileName) {
        return (new \Rap2hpoutre\FastExcel\FastExcel($rows))
            ->download($fileName . "_" . date("Y-m-d H:i:s") . '.xlsx', function ($row) {
                return [
                    'ID' => $row->id,
                    'Title' => @$row->title,
                    'Is approved' => @$row->is_approved,
                    'Created at' => @$row->created_at,
                ];
            });
    }

    public function getLinkAttribute() {
        return app()->make("url")->to('/') . '/' . lang() . '/posts/details/' . $this->id . '/' . slug($this->title);
    }

}
