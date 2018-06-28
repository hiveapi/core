<?php

namespace HiveApi\Core\Traits\Tests;

use Laravel\Passport\ClientRepository;
use Laravel\Passport\PersonalAccessClient;

trait TestsResponseHelperTrait
{
    /**
     * Converts a simple Response to a JSON object
     *
     * @param $response
     *
     * @return mixed
     */
    protected function getResponseContentObject($response)
    {
        return json_decode($response, false);
    }

    /**
     * Converts a simple Response to an array
     *
     * @param $response
     *
     * @return array
     */
    protected function getResponseContentArray($response)
    {
        return json_decode($response, true);
    }
}