<?php

namespace App\Providers;

use App\Models\Post;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Role
        Gate::define('super-admin', function (User $user) {
            return $user->id === 1;
        });
        Gate::define('admin', function (User $user) {
            return $user->isAdmin || $user->id === 1;
        });

        // Permission
        Gate::define('post.edit', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
        Gate::define('post.delete', function (User $user, Post $post) {
            return $user->isAdmin || $user->id === $post->user_id;
        });
    }
}
