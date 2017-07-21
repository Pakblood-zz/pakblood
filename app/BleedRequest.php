<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BleedRequest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_bleed_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject','user_id','email','message','contact'];
}
