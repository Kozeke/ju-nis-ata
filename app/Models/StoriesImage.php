<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoriesImage extends Model
{
    use HasFactory;
    public $fillable = [
        'story_id',
        'img_url',
    ];
}
