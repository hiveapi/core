<?php

namespace HiveApi\Core\Abstracts\Tests\Cests;

use HiveApi\Core\Traits\Tests\TestsAuthenticationHelperTrait;
use HiveApi\Core\Traits\Tests\TestsResponseHelperTrait;
use HiveApi\Core\Traits\Tests\TestsUserHelperTrait;

abstract class BaseCest
{
    use TestsAuthenticationHelperTrait;
    use TestsResponseHelperTrait;
    use TestsUserHelperTrait;

}