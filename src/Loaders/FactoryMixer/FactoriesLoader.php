<?php

/**
 * This files acts as the single factory php file of all the application.
 * Inside this file I am including every factory file found int he application.
 *
 * This currently only load factories from containers not form the ship as it is not necessary yet!
 */

use HiveApi\Core\Foundation\Facades\Hive;

// Default seeders directory in the container
$containersFactoriesPath = '/Data/Factories/';

// Automatically include Factory Files from all Containers to this file,
// which will be used by Laravel when dealing with Model Factories.

// Checkout the FactoriesLoaderTrait.php trait, to get an idea on how this works.
foreach (Hive::getContainersNames() as $containerName) {

    $containersDirectory = base_path('app/Containers/' . $containerName . $containersFactoriesPath);

    if (\File::isDirectory($containersDirectory)) {

        $files = \File::allFiles($containersDirectory);

        foreach ($files as $factoryFile) {

            if (\File::isFile($factoryFile)) {

                // Include the factory files
                include($factoryFile);

            }
        }
    }
}

