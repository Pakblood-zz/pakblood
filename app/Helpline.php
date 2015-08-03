<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helpline extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_dir';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'phone', 'city_id'];

}
