<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasGenericMutator {
    public function getCreatedAtAttribute($value) {
        //return Carbon::parse($value)->toFormattedDateString();
        return Carbon::parse($value)->format('Y-m-d g:i a');
    }
}
