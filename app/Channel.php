<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table 	= 'channel';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tv_id',
        'channel_name',

    ];

    public function tv()
    {
        return $this->belongsTo(TvStreaming::class, 'tv_id');
    }

    public function messages(){
        return $this->hasMany(Conversation::class, 'channel_id');

    }

}
