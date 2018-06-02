<?php

namespace HiveApi\CoreTest\Models\CallableTest;

use HiveApi\Core\Abstracts\Tasks\Task;

class TestTask extends Task
{
    public function run()
    {
        return true;
    }
}