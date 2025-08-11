<?php

namespace App\Http\Controllers\Service\User;

use App\Contracts\User\UserServiceInterface;
use App\Exceptions\Contracts\User\UserNotFoundException;
use App\Models\Users;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function getAllUser(): Collection
    {
        return Users::all();
    }

    public function saveUser(array $data): Users
    {
        return Users::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function updateUser(Users $user, array $data): Users
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }


    public function getUserId(int $id): Users
    {

        $user = Users::find($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function destroyUser(Users $user): void
    {
        $user->delete();
    }
}
