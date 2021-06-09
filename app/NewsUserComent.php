<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsUserComent extends Model
{
    protected $table 	    = 'news_user_coments';
    protected $primaryKey   = 'id';

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'news_id',
        'text_coment',
        'status_delete_coment',
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function users()
    {
        return $this->belongsTo(MasterUsers::class, 'users_id');
    }

}
