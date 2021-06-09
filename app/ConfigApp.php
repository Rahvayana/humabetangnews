<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigApp extends Model
{
    protected $table 	= 'config_apps';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logo',
        'logo_text',
        'web_app_name',
        'description_meta',
        'keyword_meta',
        'authors_meta',
        'footer',
    ];

   
}
