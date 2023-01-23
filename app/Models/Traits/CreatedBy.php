<?php

namespace App\Models\Traits;

use DB;

trait CreatedBy {
    public static function bootCreatedBy() {
        static::saved(function ($model) {
            if (!$model->created_by) {
                $user = auth()->user();
                \DB::table($model->table)->where('id', $model->id)->update(['created_by' => (@$user->id) ?: 2]);
            }
        });
    }

    public function creator() {
        return $this->belongsTo(\App\Models\User::class, 'created_by')->withTrashed()->withDefault();
    }

}
