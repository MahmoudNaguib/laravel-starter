<?php

namespace App\Models;

class Message extends BaseModel {

    protected $table = "messages";
    protected $guarded = [
        'deleted_at',
    ];
    protected $hidden = [
        'deleted_at',
    ];

    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'mobile' => 'required|mobile',
        'title' => 'required',
        'content' => 'required',
    ];

    public static function boot() {
        parent::boot();
        static::created(function ($row) {
            if (!app()->environment('testing')) {
                \App\Jobs\MessageCreated::dispatch($row);
            }
        });
    }

    public function scopeFilterAndSort() {
        return $this
            ->when(request('name'), function ($q) {
                return $q->where('name', 'LIKE', '%' . trim(request('name')) . '%');
            })
            ->when(request('email'), function ($q) {
                return $q->where('email', 'LIKE', '%' . trim(request('email')) . '%');
            })
            ->when(request('mobile'), function ($q) {
                return $q->where('mobile', 'LIKE', '%' . trim(request('mobile')) . '%');
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
                    'Name' => $row->name,
                    'Email' => @$row->email,
                    'Mobile' => @$row->mobile,
                    'Title' => @$row->title,
                    'Content' => @$row->content,
                    'Created at' => @$row->created_at,
                ];
            });
    }

}
