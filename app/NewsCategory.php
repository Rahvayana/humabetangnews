<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{



    protected $table 	= 'news_categories';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'news_categories_name',
        'news_categories_order',
        'news_categories_slug',

        'news_categories_app_img',
         'news_categories_web_img',
         'news_categories_status_delete',

    ];

}
