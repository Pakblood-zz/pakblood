<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bleed extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_bleed_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'receiver_name', 'city', 'comment', 'date', 'mobile'];

}
