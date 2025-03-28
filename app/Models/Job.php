<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'company_name',
        'salary_min',
        'salary_max',
        'is_remote',
        'job_type',
        'status',
        'published_at',
    ];
    
    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'is_remote' => 'boolean',
        'published_at' => 'datetime',
    ];

    
    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function jobAttributeValues()
    {
        return $this->hasMany(JobAttributeValue::class);
    }

}   
