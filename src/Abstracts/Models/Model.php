<?php

namespace HiveApi\Core\Abstracts\Models;

use HiveApi\Core\Contracts\Models\CoreModelContract;
use Illuminate\Database\Eloquent\Model as LaravelEloquentModel;

/**
 * Class Model.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Model extends LaravelEloquentModel implements CoreModelContract
{

}
