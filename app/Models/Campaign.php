<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }
}
