<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'content',
        'is_main',
        'author'
    ];

    public function story_images(){
        return $this->hasMany('App\Models\StoriesImage','story_id');

    }
}
