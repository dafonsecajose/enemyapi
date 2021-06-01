<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllUsers()
    {
        try {
            $users = $this->model->paginate(200);
            if (!$users) {
                return $this->error("Users not found", 404);
            }
            return $this->success("Users found", $users, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createUser(UserRequest $request)
    {
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

        if (!$request->has('password') || !$request->get('password')) {
            return $this->error("It is necessary to send the password", 422);
        }

        try {
            $data['password'] = bcrypt($data['password']);
            $user = $this->model->create($data);

            return $this->success("User successfully registered", $user, 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getUser($id)
    {
        try {
            $user = $this->model->find($id);
            if (!$user) {
                return $this->error("User not found", 404);
            }

            return $this->success("User found", $user, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

        try {
            if ($request->has('password') || $request->get('password')) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            $user = $this->model->find($id);

            if (!$user) {
                return $this->error("User not found", 404);
            }

            $user->update($data);
            return $this->success("Updated user", $user, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this->model->find($id);

            if (!$user) {
                return $this->error("User not found exist", 404);
            }

            $user->delete();
            return $this->success("User successfully removed", $user);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
