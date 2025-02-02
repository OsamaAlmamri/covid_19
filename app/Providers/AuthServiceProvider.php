<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Route::group(['middleware' => 'passport-provider'], function () {
            Passport::routes();
        });
//        Passport::routes();

//        Passport::loadKeysFrom('/secret-keys/oauth');
//        Passport::tokensExpireIn(now()->addDays(15));
//
//        Passport::refreshTokensExpireIn(now()->addDays(30));
//
//        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        //
    }
}
