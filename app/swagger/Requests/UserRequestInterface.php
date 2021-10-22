<?php

namespace App\swagger\Requests;

/**
 * @OA\Schema(
 *      title="User Request",
 *      description="User request",
 *      type="object",
 *      required={"name", "email", "password"},
 *      @OA\Property(
 *          property="name",
 *          description="User name",
 *          example="John Doe"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="Mail user",
 *          example="johndoe@email.com"
 *      ),
 *      @OA\Property(
 *          property="password",
 *          description="Password user",
 *          example="password"
 *      ),
 * )
 */
interface UserRequestInterface
{
    public function rules();
}
