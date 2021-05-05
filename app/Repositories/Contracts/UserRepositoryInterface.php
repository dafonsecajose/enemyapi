<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAllUsers();

    public function createUser(UserRequest $request);

    public function updateUser(Request $request, $id);

    public function getUser($id);

    public function deleteUser($id);
}
