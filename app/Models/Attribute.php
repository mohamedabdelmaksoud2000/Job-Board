<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /** @use HasFactory<\Database\Factories\AttributeFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'option'
    ];

    public function jobAttributeValues()
    {
        return $this->hasMany(JobAttributeValue::class);
    }

}
