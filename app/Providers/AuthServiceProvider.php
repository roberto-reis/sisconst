<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Permissão admim
        Gate::define('permission-admin', function($user) {
            return $user->nivel === "admin"
                ? Response::allow()
                : Response::deny("Ação só permitida para usuários de nivel Admin! ");
        });

        // Permissão Operacional e admin
        Gate::define('permission-operacional', function($user) {
            if($user->nivel === "operacional" || $user->nivel === "admin") {
                return true;

            }
        });
        
        Gate::define('permission-convidado', function($user) {
            return $user->nivel === "convidado";
        });


    }
}
