<?php

namespace HiveApi\Core\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Hive
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 *
 * @method static call($class, $runMethodArguments = [], $extraMethodsToCall = [])
 * @method static transactionalCall($class, $runMethodArguments = [], $extraMethodsToCall = [])
 *
 * @see \HiveApi\Core\Foundation\Hive
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

