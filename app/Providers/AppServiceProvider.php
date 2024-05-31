<?php

namespace App\Providers;

use App\Models\Bookmark;
use App\Models\Catalogue;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('edit-bookmark', function (User $user, Bookmark $bookmark) {
            return $bookmark->user->is($user);
        });

        Gate::define('clone-catalogue', function (User $user, Catalogue $catalogue) {
            return $catalogue->is_published === 1;
        });
    }
}
