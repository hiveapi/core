<?php

namespace HiveApi\CoreTest\Models\CallableTest;

use HiveApi\Core\Abstracts\Controllers\Controller;

class TestController extends Controller
{
    public function run()
    {
        return true;
    }
}