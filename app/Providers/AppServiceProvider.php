<?php

namespace App\Providers;

use App\Http\Middleware\IsStudent;
use App\Http\Middleware\IsTeacher;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register middleware
        $router = $this->app['router'];
        $router->aliasMiddleware('is.teacher', IsTeacher::class);
        $router->aliasMiddleware('is.student', IsStudent::class);

        // Define Blade directives for role checking
        Blade::if('teacher', function () {
            return auth()->check() && auth()->user()->isTeacher();
        });

        Blade::if('student', function () {
            return auth()->guard('student')->check();
        });
    }
}