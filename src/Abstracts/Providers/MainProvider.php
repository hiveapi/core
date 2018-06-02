<?php

namespace HiveApi\Core\Abstracts\Providers;

use HiveApi\Core\Loaders\AliasesLoaderTrait;
use HiveApi\Core\Loaders\ProvidersLoaderTrait;
use Illuminate\Support\ServiceProvider as LaravelAppServiceProvider;

/**
 * Class MainProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class MainProvider extends LaravelAppServiceProvider
{

    use ProvidersLoaderTrait;
    use AliasesLoaderTrait;

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadServiceProviders();
        $this->loadAliases();
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {

    }

}
