<?php

namespace HiveApi\Core\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Hive
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Hive extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Hive';
    }

}

