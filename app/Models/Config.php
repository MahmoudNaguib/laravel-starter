<?php

namespace App\Models;

class Config extends BaseModel {
    use \App\Models\Traits\CreatedBy;

    protected $table = "configs";
    protected $guarded = [
    ];
    protected $hidden = [
    ];
    public $rules = [
        'field' => 'required',
        'value' => 'required',
    ];

    public function scopeFilterAndSort() {
        return $this->when(request('order_field'), function ($q) {
            return $q->orderBy((request('order_field')), (request('order_type')) ?: 'desc');
        })->orderBy('id', 'desc');
    }
}
