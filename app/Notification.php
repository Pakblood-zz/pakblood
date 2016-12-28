<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_users_notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'message', 'is_seen'];
}
