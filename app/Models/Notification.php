<?php

namespace App\Models;

class Notification extends BaseModel {
    protected $table = "notifications";
    protected $guarded = [
        'deleted_at',
    ];
    protected $hidden = [
        'deleted_at',
    ];

    public static function boot() {
        parent::boot();
        static::created(function ($row) {
           \App\Jobs\NotificationCreated::dispatch($row);
        });
    }

    public function scopeFilterAndSort() {
        return $this->when(request('order_field'), function ($q) {
            return $q->orderBy((request('order_field')), (request('order_type')) ?: 'desc');
        })->orderBy('id', 'desc');
    }

    public function scopeOwn($query) {
        return $query->where('user_id', auth()->user()->id);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withTrashed()->withDefault();
    }

    public function scopeUnreaded($query) {
        return $query->where('seen_at', NULl);
    }

    public function export($rows, $fileName) {
        return (new \Rap2hpoutre\FastExcel\FastExcel($rows))
            ->download($fileName . "_" . date("Y-m-d H:i:s") . '.xlsx', function ($row) {
                return [
                    'ID' => $row->id,
                    'User' => @$row->user->name,
                    'Title' => @$row->title,
                    'Content' => @$row->content,
                    'Send email' => @$row->send_email,
                    'Send push' => @$row->send_push,
                    'Entity' => @$row->entity_type,
                    'Entity ID' => @$row->entity_id,
                    'Seen at' => @$row->seen_at,
                    'Created at' => @$row->created_at,
                ];
            });
    }

}
