<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Contracts\IRestfulServiceFactory;
use App\Contracts\IRepositoryFactory;
use App\Models\RestfulServices\RestfulServiceFactory;
use App\Models\Repositories\RepositoryFactory;
use App\Http\Transformers\AppBaseTransformer;
use League\Fractal\TransformerAbstract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix for MySQL 5.6. See https://github.com/laravel/framework/issues/17508
        Schema::defaultStringLength(191);
        $this->registerBindings();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(\Reliese\Coders\CodersServiceProvider::class);
        }
    }

    private function registerBindings()
    {
        $this->app->bind(IRepositoryFactory::class, RepositoryFactory::class);
        $this->app->bind(IRestfulServiceFactory::class, RestfulServiceFactory::class);
        $this->app->bind(TransformerAbstract::class, AppBaseTransformer::class);
    }
}
