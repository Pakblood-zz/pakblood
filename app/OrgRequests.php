<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgRequests extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_org_join_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'org_id', 'reason'];

}
