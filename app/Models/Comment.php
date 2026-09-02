<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'cmt',
        'id_user',
        'id_blog',
        'avatar_user',
        'name_user',
        'level',
    ];
}
