<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('admin-level', function (User $user) {
            if ($user->isAdmin()) {
                return Response::allow();
            } else {
                return Response::deny('Brak dostępu.');
            }
        });

        Gate::define('teacher-level', function (User $user) {
            if ($user->isAdmin() || $user->isTeacher()) {
                return Response::allow();
            } else {
                return Response::deny('Brak dostępu.');
            }
        });
    }
}
