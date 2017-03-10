<?php

namespace App\Providers;

use App\Bleed;
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
            'total_users' => User::/*where('status', '=', 'active')->*/
            count(),
            'total_org' => Org::/*where('status', '=', 'active')->*/
            count(),
            'countries' => Country::get(),
            'pictorial' => Bleed::join('pb_users', 'pb_bleed_details.user_id', '=', 'pb_users.id')
                ->select('pb_bleed_details.*', 'pb_users.name')
                ->where('pb_bleed_details.is_approved', 1)->whereNotNull('pb_bleed_details.image')
                ->orWhere('pb_bleed_details.image', '')->get(),
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
