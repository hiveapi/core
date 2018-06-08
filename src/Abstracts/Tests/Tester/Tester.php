<?php

namespace HiveApi\Core\Abstracts\Tests\Tester;

use Codeception\Actor;
use Codeception\Scenario;
use HiveApi\Core\Abstracts\Tests\PhpUnit\PhpUnitAssertWrapper;

abstract class Tester extends Actor
{
    public $usePHPUnitTo;

    public function __construct(Scenario $scenario)
    {
        parent::__construct($scenario);
        $this->usePHPUnitTo = new PhpUnitAssertWrapper();
    }

}