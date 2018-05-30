<?php

namespace HiveApi\Core\Generator;

use HiveApi\Core\Generator\Commands\ActionGenerator;
use HiveApi\Core\Generator\Commands\ConfigurationGenerator;
use HiveApi\Core\Generator\Commands\ContainerApiGenerator;
use HiveApi\Core\Generator\Commands\ContainerGenerator;
use HiveApi\Core\Generator\Commands\ContainerWebGenerator;
use HiveApi\Core\Generator\Commands\ControllerGenerator;
use HiveApi\Core\Generator\Commands\EventGenerator;
use HiveApi\Core\Generator\Commands\EventHandlerGenerator;
use HiveApi\Core\Generator\Commands\ExceptionGenerator;
use HiveApi\Core\Generator\Commands\JobGenerator;
use HiveApi\Core\Generator\Commands\MailGenerator;
use HiveApi\Core\Generator\Commands\MigrationGenerator;
use HiveApi\Core\Generator\Commands\ModelGenerator;
use HiveApi\Core\Generator\Commands\NotificationGenerator;
use HiveApi\Core\Generator\Commands\ReadmeGenerator;
use HiveApi\Core\Generator\Commands\RepositoryGenerator;
use HiveApi\Core\Generator\Commands\RequestGenerator;
use HiveApi\Core\Generator\Commands\RouteGenerator;
use HiveApi\Core\Generator\Commands\SeederGenerator;
use HiveApi\Core\Generator\Commands\ServiceProviderGenerator;
use HiveApi\Core\Generator\Commands\SubActionGenerator;
use HiveApi\Core\Generator\Commands\TaskGenerator;
use HiveApi\Core\Generator\Commands\TestFunctionalTestGenerator;
use HiveApi\Core\Generator\Commands\TestTestCaseGenerator;
use HiveApi\Core\Generator\Commands\TestUnitTestGenerator;
use HiveApi\Core\Generator\Commands\TransformerGenerator;
use HiveApi\Core\Generator\Commands\TransporterGenerator;
use HiveApi\Core\Generator\Commands\ValueGenerator;
use Illuminate\Support\ServiceProvider;

/**
 * Class GeneratorsServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GeneratorsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // all generators ordered by name
        $this->registerGenerators([
            ActionGenerator::class,
            ConfigurationGenerator::class,
            ContainerGenerator::class,
            ContainerApiGenerator::class,
            ContainerWebGenerator::class,
            ControllerGenerator::class,
            EventGenerator::class,
            EventHandlerGenerator::class,
            ExceptionGenerator::class,
            JobGenerator::class,
            MailGenerator::class,
            MigrationGenerator::class,
            ModelGenerator::class,
            NotificationGenerator::class,
            ReadmeGenerator::class,
            RepositoryGenerator::class,
            RequestGenerator::class,
            RouteGenerator::class,
            SeederGenerator::class,
            ServiceProviderGenerator::class,
            SubActionGenerator::class,
            TestFunctionalTestGenerator::class,
            TestTestCaseGenerator::class,
            TestUnitTestGenerator::class,
            TaskGenerator::class,
            TransformerGenerator::class,
            TransporterGenerator::class,
            ValueGenerator::class,
        ]);
    }

    /**
     * Register the generators.
     * @param array $classes
     */
    private function registerGenerators(array $classes)
    {
        foreach ($classes as $class) {
            $lowerClass = strtolower($class);

            $this->app->singleton("command.porto.$lowerClass", function ($app) use ($class) {
                return $app[$class];
            });

            $this->commands("command.porto.$lowerClass");
        }
    }
}
