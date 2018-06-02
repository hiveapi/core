<?php

namespace HiveApi\CoreTest\Models\CallableTest;

use HiveApi\Core\Abstracts\Actions\SubAction;

class TestSubAction extends SubAction
{
    public function run()
    {
        return true;
    }
}