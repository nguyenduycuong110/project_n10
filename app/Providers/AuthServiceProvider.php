<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Providers\CustomReceptionProvider;
use App\Providers\ConsultProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Auth::provider('custom', function ($app, array $config) {
            return new CustomReceptionProvider($app['hash'], $config['model']);
        });

        Auth::provider('consult', function ($app, array $config) {
            return new ConsultProvider($app['hash'], $config['model']);
        });

        Gate::define('modules', function($user, $permisionName){
            if($user->publish == 0) return false;
            $permission = $user->user_catalogues->permissions;
            if($permission->contains('canonical', $permisionName)){
                return true;
            }
            return false;
        });

        
        
    }
}
