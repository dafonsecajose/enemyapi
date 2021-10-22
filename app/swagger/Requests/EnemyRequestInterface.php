<?php
namespace App\swagger\Requests;

/**
 * @OA\Schema(
 *      title="Enemy Request",
 *      description="User request",
 *      type="object",
 *      required={"name", "rank", "level", "affliliation", "description"},
 *      @OA\Property(
 *          property="name",
 *          description="Enemy name",
 *          example="John Doe"
 *      ),
 *      @OA\Property(
 *          property="rank",
 *          description="Enemy rank",
 *          example="A"
 *      ),
 *      @OA\Property(
 *          property="level",
 *          description="Enemy level",
 *          example="Gennin"
 *      ),
 *      @OA\Property(
 *          property="affiliation",
 *          description="Enemy Affiliations",
 *          example="KONOHA"
 *      ),
 *      @OA\Property(
 *          property="description",
 *          description="Enemy description",
 *          example="Strong man with 1,80m more.."
 *      ),
 * )
 */
interface EnemyRequestInterface
{
    public function rules();
}