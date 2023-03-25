<?php

namespace App\Providers;

use App\Models\Config;
use App\Repositories\ConfigRepository;
use Illuminate\Support\ServiceProvider;
use Modules\Integraa\Entities\Integraa;
use Modules\Integraa\Repositories\IntegraaRepository;
use Modules\Integraa\Repositories\ProductRepository as IntegraaProductRepository;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\PeriodicityOrder;
use Modules\Order\Entities\Product;
use Modules\Order\Repositories\OrderRepository;
use Modules\Order\Repositories\PeriodicityOrderRepository;
use Modules\Order\Repositories\ProductRepository;
use Modules\PriceList\Entities\PriceList;
use Modules\PriceList\Repositories\PriceListRepository;
use Modules\Quotation\Entities\Quotation;
use Modules\Quotation\Repositories\QuotationRepository;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(QuotationRepository::class, function($app){
            return new QuotationRepository(new Quotation());
        });

        $this->app->singleton(OrderRepository::class, function($app){
            return new OrderRepository(new Order());
        });
        $this->app->singleton(IntegraaRepository::class, function($app){
            return new IntegraaRepository(new Integraa());
        });
        $this->app->singleton(UserRepository::class, function($app){
            return new UserRepository(new User());
        });
        $this->app->singleton(ProductRepository::class, function($app){
            return new ProductRepository(new Product());
        });
        $this->app->singleton(IntegraaProductRepository::class, function($app){
            return new IntegraaProductRepository(new Product());
        });
        $this->app->singleton(PeriodicityOrderRepository::class, function($app){
            return new PeriodicityOrderRepository(new PeriodicityOrder());
        });
        $this->app->singleton(ConfigRepository::class, function($app){
            return new ConfigRepository(new Config());
        });
        $this->app->singleton(PriceListRepository::class, function($app){
            return new PriceListRepository(new PriceList());
        });
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
