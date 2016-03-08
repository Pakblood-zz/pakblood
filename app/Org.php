<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_org';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'username', 'name', 'address', 'phone', 'mobile', 'city_id', 'imgage', 'admin_name', 'program', 'email','application_image'];

}
