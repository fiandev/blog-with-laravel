<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        
        Gate::define('admin', function (User $user) {
            error_log("gate :".$user->hasRole("administrator"));
            return $user->hasRole("administrator");
        });
        Gate::define('mod', function (User $user) {
            return $user->hasRole("moderator");
        });
        Gate::define('member', function (User $user) {
            return $user->hasRole("member");
        });
    }
}
