<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /** @use HasFactory<\Database\Factories\LangaugeFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }

}
