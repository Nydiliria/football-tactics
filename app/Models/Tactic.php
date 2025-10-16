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
    ];
}

