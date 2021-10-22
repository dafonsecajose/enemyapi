<?php
namespace App\swagger\Requests;

/**
 * @OA\Schema(
 *      title="Enemy Request",
 *      description="User request",
 *      type="object",
 *      required={"sarch"},
 *      @OA\Property(
 *          property="search",
 *          description="Field Serach",
 *          example="John Doe"
 *      )
 * )
 */
interface EnemySearchRequestInterface
{

}