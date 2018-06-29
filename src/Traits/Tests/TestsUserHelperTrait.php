<?php

namespace HiveApi\Core\Traits\Tests;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

trait TestsUserHelperTrait
{

    /**
     * Returns a specific test user. If it does not exist, it creates a new user!
     *
     * @param array $data
     *
     * @return mixed
     */
    protected function getTestingUser(array $data = [])
    {
        return $this->createTestingUser($data);
    }

    private function createTestingUser(array $userdata = [])
    {
        return factory(User::class)->create($this->prepareUserDetails($userdata));
    }

    private function prepareUserDetails(array $userdata = [])
    {
        $faker = Factory::create();

        $defaultUserDetails = [
            'name'     => $faker->name,
            'email'    => $faker->email,
            'password' => 'password',
            'confirmed' => true,
        ];

        $finalUserData = array_merge($defaultUserDetails, $userdata);

        $finalUserData['password'] = Hash::make($finalUserData['password']);

        return $finalUserData;
    }

}