<?php

namespace App\Providers;

use App\Repositories\Contracts\EmpRepositoryInterface;
use App\Repositories\Contracts\MeetingRepositoryInterface;
use App\Repositories\Eloquent\EmpRepository;
use App\Repositories\Eloquent\MeetingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmpRepositoryInterface::class,EmpRepository::class);
        $this->app->bind(MeetingRepositoryInterface::class,MeetingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
