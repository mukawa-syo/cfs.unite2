<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\LoginResponse;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
    {
        Gate::before(function ($user, $ability) {
            return ((int)($user->role_id ?? 0) === 1) ? true : null;
        });
        Schema::defaultStringLength(191);

         if (!Type::hasType('tinyinteger')) {
             Type::addType('tinyinteger', \Doctrine\DBAL\Types\SmallIntType::class);
         }
     }
   }
