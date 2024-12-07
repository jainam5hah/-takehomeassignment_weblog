<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stat extends Model
{
    protected $fillable = [
        'campaign_id',
        'term_id',
        'revenue',
        'timestamp',
    ];

    protected $casts = [
        'revenue' => 'decimal:5',
        'timestamp' => 'datetime',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }
}
