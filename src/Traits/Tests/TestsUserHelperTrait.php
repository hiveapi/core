<?php

namespace HiveApi\Core\Traits\Tests;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

trait TestsUserHelperTrait
{

    /**
     * Creates a new user and assigns specific roles / permissions to the latter
     *
     * @param array $data
     * @param null  $access
     *
     * @return mixed
     */
    protected function getTestingUser(array $data = [], $access = null)
    {
        $user = $this->createTestingUser($data);
        $user = $this->grantAccess($user, $access);

        return $user;
    }

    private function createTestingUser(array $userdata = [])
    {
        return factory(User::class)->create($this->prepareUserDetails($userdata));
    }

    private function prepareUserDetails(array $userdata = [])
    {
        $defaultUserDetails = $this->getDefaultUserData();

        $finalUserData = array_merge($defaultUserDetails, $userdata);

        $finalUserData['password'] = Hash::make($finalUserData['password']);

        return $finalUserData;
    }

    /**
     * Define the default attributes of a user
     *
     * @return array
     */
    private function getDefaultUserData()
    {
        $faker = Factory::create();

        return [
            'name'     => $faker->name,
            'email'    => $faker->email,
            'password' => 'password',
            'confirmed' => true,
        ];
    }

    /**
     * Define the default role / permissions for a user
     *
     * @return array
     */
    private function getDefaultAccess()
    {
        return [
            'roles' => [],
            'permissions' => [],
        ];
    }

    protected function grantAccess(User $user, $access = null)
    {
        $defaultAccess = $this->getDefaultAccess();

        if ($access === null) {
            $access = [];
        }

        $access = array_merge($defaultAccess, $access);

        $this->grantRoleAccessToUser($user, $access['roles']);
        $this->grantPermissionAccessToUser($user, $access['permissions']);

        $user->refresh();
        return $user;
    }

    /**
     * Grants the user specific roles
     *
     * @param User  $user
     * @param array $roles
     */
    private function grantRoleAccessToUser(User $user, array $roles = [])
    {
        foreach ($roles as $role)
        {
            $user->assignRole($role);
        }
    }

    /**
     * Grants the user specific permissions
     *
     * @param User  $user
     * @param array $permissions
     */
    private function grantPermissionAccessToUser(User $user, array $permissions = [])
    {
        foreach ($permissions as $permission)
        {
            $user->givePermissionTo($permission);
        }
    }

}