<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = [
        'reason'
    ];

    public function scopeApproved(Builder $query): void
    {
        $query->where('approved', '=', 1);
    }
}
