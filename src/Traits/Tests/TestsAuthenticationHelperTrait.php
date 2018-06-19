<?php

namespace HiveApi\Core\Traits\Tests;

use App\Containers\User\Models\User;

trait TestsAuthenticationHelperTrait
{
    /**
     * Creates a new auth-token for a given user and returns the access token (only)
     *
     * @param User $user
     *
     * @return mixed
     */
    protected function getAuthenticationTokenForUser(User $user)
    {
        $token = $user->createToken('testing');

        return $token->accessToken;
    }

}