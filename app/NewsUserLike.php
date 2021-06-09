<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsUserLike extends Model
{
    protected $table 	= 'news_user_likes';
    protected $primaryKey = 'id';

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'news_id',
    ];

}
