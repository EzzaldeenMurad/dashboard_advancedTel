<?php

namespace App\Providers;

use App\Models\Offer;
use App\Repositories\AdminRepository;
use App\Repositories\OfferRepository;
use App\Repositories\OperationRepository;
use App\Repositories\RepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, OfferRepository::class);
        $this->app->bind(RepositoryInterface::class, OperationRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RepositoryInterface::class, AdminRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
