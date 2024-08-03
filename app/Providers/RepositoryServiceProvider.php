<?php

namespace App\Providers;

use App\Interface\Students\StudentRepositoryInterface;
use App\Interface\Teachers\TeacherRepositoryInterface;
use App\Repository\Students\StudentRepository;
use App\Repository\Teachers\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
