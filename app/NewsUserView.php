<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsUserView extends Model
{
    protected $table 	= 'news_user_views';
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
