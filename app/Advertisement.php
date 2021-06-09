<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table 	= 'advertisements';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ads_name',
        'ads_description',
        'ads_img',
        'ads_link',
        'ads_status_active',
        'ads_status_delete',
        'ads_status_web'
    ];
}
