<?php
namespace App\swagger\Models;


/**
 * @OA\Schema(
 *      title="User",
 *      description="User model",
 *      @OA\Xml(
 *          name="User"
 *      ),
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
interface UserInterface {}