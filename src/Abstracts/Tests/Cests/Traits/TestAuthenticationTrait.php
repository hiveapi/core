<?php

namespace HiveApi\Core\Abstracts\Tests\Cests\Traits;

use App\Containers\User\Models\User;

trait TestAuthenticationTrait
{

    protected function getAuthenticationTokenForUser(User $user)
    {
        $token = $user->createToken('testing');

        return $token->accessToken;
    }

}