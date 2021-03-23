<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\Auth\JwtGuard;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Services\Auth\AdminGuard;

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

           // add custom guard provider
        Auth::provider('admins', function ($app, array $config) {
           return new AdminProvider($app->make('App\Admin'));
        });
   
        // add custom guard
        Auth::extend('token', function ($app, $name, array $config) {
           return new AdminGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });

        Auth::viaRequest('token', function ($request) {
           return User::where('api_token', $request->api_token)->first();
        });
    }
}
