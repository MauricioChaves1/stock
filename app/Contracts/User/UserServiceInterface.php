<?php

namespace App\Contracts\User;

use App\Models\Users;
use Illuminate\Database\Eloquent\Collection;


interface UserServiceInterface
{
    public function getAllUser(): Collection;
    public function saveUser(array $data): Users;
    public function updateUser(Users $user, array $data): Users;
    public function getUserId(int $id): Users;
    public function destroyUser(Users $user): void;
}
