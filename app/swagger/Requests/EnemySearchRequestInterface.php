<?php
namespace App\swagger\Requests;

/**
 * @OA\Schema(
 *      title="Enemy Request",
 *      description="User request",
 *      type="object",
 *      required={"name"},
 *      @OA\Property(
 *          property="name",
 *          description="Field Serach",
 *          example="John Doe"
 *      )
 * )
 */
interface EnemySearchRequestInterface
{

}