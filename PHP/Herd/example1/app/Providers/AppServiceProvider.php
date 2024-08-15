<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
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
     * Boot strap any application services.
     */
    public function boot(): void
    {
        //Triggered after all project dependencies have successfully been loaded
        Model::preventLazyLoading();

        //Paginator::useBootstrapFive();

        //USING GATES
        Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });

        //IMPORTANT: the above gate will always fail for guest (not logged in users)
        //if you have a case like that, you can make the User object optional:
        //1- Gate::define('edit-job', function (?User $user, Job $job) {..}
        //2- Gate::define('edit-job', function (User $user=null, Job $job) {..}
        // in case of 1 and 2, the gate will run to check even if user is not logged in
    }
}
