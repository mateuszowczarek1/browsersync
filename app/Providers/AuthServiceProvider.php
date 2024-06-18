<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Bookmark;
use App\Models\Catalogue;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }


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
