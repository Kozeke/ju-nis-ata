<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationsImage extends Model
{
    use HasFactory;
    public $fillable = [
        'publication_id',
        'img_url'
    ];
}
