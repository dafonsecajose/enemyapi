<?php
namespace App\swagger\Requests;

/**
 * @OA\Schema(
 *      title="Auth Request",
 *      description="Authorization request data",
 *      type="object",
 *      required={"email", "password"},
 *      @OA\Property(
 *          property="email",
 *          description="User email",
 *          example="first@email.com"
 *      ),
 *      @OA\Property(
 *          property="password",
 *          description="User password",
 *          example="password"
 *      ),
 * )
 */
interface AuthRequestInterface
{
}
