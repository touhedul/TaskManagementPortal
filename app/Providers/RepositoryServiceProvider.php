<?php

namespace App\Providers;

use App\Interfaces\BaseInterface;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\TaskInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\repo\BaseRepository;
use App\Repositories\TaskRepository;
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
        $this->app->bind(BaseInterface::class, BaseRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
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
