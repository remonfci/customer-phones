<?php

declare(strict_types=1);

namespace App\Providers;

use DDD\Domain\Services\Country\CountryService;
use DDD\Domain\Services\Country\CountryServiceInterface;
use DDD\Domain\Services\Customer\CustomerService;
use DDD\Domain\Services\Customer\CustomerServiceInterface;
use DDD\Infrastructure\Eloquent\EloquentCustomerRepository;
use DDD\Infrastructure\Repositories\CustomerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(CustomerRepository::class, EloquentCustomerRepository::class);
        $this->app->bind(CountryServiceInterface::class, CountryService::class);
    }
}
