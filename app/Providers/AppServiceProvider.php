<?php

namespace App\Providers;

use App\City;
use App\Country;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\Org;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $data = array(
            'total_users' => User::where('status', '=', 'active')->count(),
            'total_org'   => Org::where('status', '=', 'active')->count(),
            'countries'   => Country::get(),
        );
        view()->share($data);
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
