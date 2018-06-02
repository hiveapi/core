<?php

namespace HiveApi\Core\Abstracts\Events\Jobs;

use HiveApi\Core\Abstracts\Events\Interfaces\ShouldHandle;
use HiveApi\Core\Abstracts\Jobs\Job;

/**
 * Class EventJob
 *
 * @author  Arthur Devious
 */
class EventJob extends Job
{
    public $handler;

    /**
     * EventJob constructor.
     *
     * @param \HiveApi\Core\Abstracts\Events\Interfaces\ShouldHandle $handler
     */

    public function __construct(ShouldHandle $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Handle the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->handler->handle();
    }
}
