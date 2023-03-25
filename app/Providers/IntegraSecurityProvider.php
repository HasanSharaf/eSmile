<?php

namespace App\Providers;

use App\Helpers\Classes\IntegraaAuth;
// use Illuminate\Support\ServiceProvider;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\User\Policies\UserPolicy as PoliciesUserPolicy;

class IntegraSecurityProvider extends ServiceProvider
{


      /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => PoliciesUserPolicy::class,
    ];
   
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    { 
        $this->registerPolicies();

            //add custom driver for auth
            Auth::extend('intgraa_auth', function () {
                return new IntegraaAuth();
            });
      
       
    }
}
