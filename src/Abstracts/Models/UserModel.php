<?php

namespace HiveApi\Core\Abstracts\Models;

use HiveApi\Core\Contracts\Models\CoreModelContract;
use Illuminate\Foundation\Auth\User as LaravelAuthenticatableUser;

/**
 * Class UserModel.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class UserModel extends LaravelAuthenticatableUser implements CoreModelContract
{

}
