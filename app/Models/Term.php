<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    protected $fillable = [
        'name',
    ];

    public function stats(): HasMany
    {
        return $this->hasMany(Stat::class);
    }
}
