<?php

namespace HiveApi\Core\Abstracts\Tests\Cests;

use HiveApi\Core\Abstracts\Tests\Cests\Traits\TestAuthenticationTrait;
use HiveApi\Core\Abstracts\Tests\Cests\Traits\TestUserTrait;

abstract class BaseCest
{
    use TestAuthenticationTrait;
    use TestUserTrait;

}