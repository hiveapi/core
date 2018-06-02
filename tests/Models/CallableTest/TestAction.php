<?php

namespace HiveApi\CoreTest\Models\CallableTest;

use HiveApi\Core\Abstracts\Actions\Action;

class TestAction extends Action
{
    public function run($result = true)
    {
        return $result;
    }
}