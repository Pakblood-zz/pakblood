<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_user_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reported_user_id', 'reporter_user_id', 'reporter_name', 'reporter_email', 'reporter_message', 'type'];

}
