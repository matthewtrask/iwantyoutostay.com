<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $fillable = ['reason_id', 'ip_address', 'type'];

    public function reason(): BelongsTo
    {
        return $this->belongsTo(Reason::class);
    }
}
