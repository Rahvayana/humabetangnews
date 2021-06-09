<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{

    protected $table 	= 'news';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'news_title',
        'news_slug',

        'category_id',
        'admin_id',
        'news_status',
        'news_headlines_status',

        'news_content',
        'news_img',
        'news_video',
        'news_publish_datetime',
        'news_status_delete',
        'news_status_slideshow',

    ];

    protected $dates = ['news_publish_datetime'];

    public function getAbbreviatedContentAttribute()
    {
        return Str::limit(strip_tags($this->news_content),100,'...');
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function views()
    {
        return $this->hasMany(NewsUserView::class, 'news_id');
    }

    public function likes()
    {
        return $this->hasMany(NewsUserLike::class, 'news_id');
    }

    public function status_like()
    {
        return $this->belongsToMany(NewsUserLike::class, 'users_id', 'news_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(NewsUserBookmark::class, 'news_id');
    }

    public function comments()
    {
        return $this->hasMany(NewsUserComent::class, 'news_id');
    }

    public function authors()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }







}
