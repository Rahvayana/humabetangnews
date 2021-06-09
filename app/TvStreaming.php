<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvStreaming extends Model
{

    protected $table 	= 'tv_streamings';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tv_name',
        'tv_description',
        'tv_url_stream',
        'tv_status_active',
        'tv_img',
        'tv_status_delete'
    ];
    protected $with = ['channel'];


    public function channel()
    {
        return $this->hasOne(Channel::class, 'tv_id');
    }
}
