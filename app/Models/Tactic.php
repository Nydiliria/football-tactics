<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tactic extends Model
{
    protected $fillable = [
        'title',
        'description',
        'formation',
        'image_url',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

