<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table 	= 'conversations';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'user_id',
        'channel_id',
    ];

    protected $with = ['user'];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function user()
    {
        return $this->belongsTo(MasterUsers::class, 'user_id');
    }
}
