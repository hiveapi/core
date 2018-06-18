<?php

namespace HiveApi\Core\Traits\Tests;

use Laravel\Passport\ClientRepository;
use Laravel\Passport\PersonalAccessClient;

trait SetupPassportOAuth2Trait
{
    public function setupPassportOAuth2()
    {
        $client = (new ClientRepository())->createPersonalAccessClient(
            null,
            'Testing Personal Access Client',
            'http://localhost'
        );

        $accessClient = new PersonalAccessClient();
        $accessClient->client_id = $client->id;
        $accessClient->save();
    }
}