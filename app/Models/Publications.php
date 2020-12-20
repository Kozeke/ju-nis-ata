<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publications extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'description',
        'is_main',
        'file',
        'downloaded'
    ];

    public function publication_images(){
        return $this->hasMany('App\Models\PublicationsImage','publication_id');
    }

}
