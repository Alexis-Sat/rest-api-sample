<?php

namespace App\Providers;

use App\Interfaces\BuildingRepositoryInterface;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\OrganizationRepositoryInterface;
use App\Repositories\BuildingRepository;
use App\Repositories\BusinessRepository;
use App\Repositories\OrganizationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BuildingRepositoryInterface::class, BuildingRepository::class);
        $this->app->bind(BusinessRepositoryInterface::class, BusinessRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
