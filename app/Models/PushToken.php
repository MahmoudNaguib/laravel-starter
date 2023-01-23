<?php

namespace App\Models;

class PushToken extends BaseModel {
    protected $table = "push_tokens";
    protected $guarded = [
        'deleted_at',
    ];
    protected $hidden = [
        'deleted_at',
    ];
    public $rules = [
        'push_token' => 'required',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withTrashed()->withDefault();
    }
}
