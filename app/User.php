<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pb_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password', 'gender', 'dob', 'phone', 'mobile', 'address', 'city_id', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function ActivateAccount($code) {
        $user = User::where('confirmation_code', '=', $code)->first();
        if (!$user) return false;
        $user->status = 'active';
        $user->confirmation_code = '';
        if ($user->save()) {
            Auth::login($user);
        }
        return true;
    }

    public function accountIsActive($email) {
        $user = User::where('email', '=', $email)->first();
        if ($user && $user->status == 'active') {
            return true;
        }
        return 0;
    }

    public function hasUser($email) {
        $user = DB::select('select * from pb_users where email = ?', [$email]);
        if (count($user) > 0) {
            return true;
        }
        return 0;
    }

    public function isDeleted($email) {
        $user = User::where('email', '=', $email)->first();
        if ($user->is_deleted == '1') {
            return true;
        }
        return 0;
    }
}
