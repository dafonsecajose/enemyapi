<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Validator;

class LoginJwtController extends Controller
{
    use ResponseApi;

    public function login(Request $request)
    {
        $credentials = $request->all(['email', 'password']);

        Validator::make($credentials, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ])->validate();

        if(!$token = auth('api')->attempt($credentials))
        {
            return $this->error("Unauthorized", 401);
        }

        return response()->json([
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        auth('api')->logout();
        return $this->success("Logout successfully", [],200);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();

        return $this->success("Refresh successfully", ['token' => $token], 200);
    }
}
