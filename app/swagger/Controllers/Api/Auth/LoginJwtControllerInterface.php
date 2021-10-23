<?php
namespace App\swagger\Controllers\Api\Auth;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

interface LoginJwtControllerInterface
{
    /**
     * @OA\Post(
     *      path="/auth/login",
     *      operationId="login",
     *      tags={"Authorization"},
     *      summary="Resquest access authorization",
     *      description="Returns authorization data",
     *     @OA\RequestBody(
     *          required= true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthRequestInterface")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      )
     * )
     */
    public function login(AuthRequest $request);

    /**
     * @OA\Get(
     *      path="/auth/logout",
     *      operationId="logout",
     *      tags={"Authorization"},
     *      summary="Request exit from the api",
     *      description="Returns logout data",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      ),
     * )
     */
    public function logout();

    /**
     * @OA\Get(
     *      path="/auth/refresh",
     *      operationId="refresh",
     *      tags={"Authorization"},
     *      summary="Request token refresh",
     *      description="Returns token refresh data",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      ),
     * )
     */
    public function refresh();
}
