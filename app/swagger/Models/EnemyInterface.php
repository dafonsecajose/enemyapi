<?php
namespace App\swagger\Models;

/**
 * @OA\Schema(
 *      title="Enemy",
 *      description="Enemy model",
 *      @OA\Xml(
 *          name="Enemy"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="Enemy name",
 *          example="Zabuza Momochi"
 *      ),
 *      @OA\Property(
 *          property="rank",
 *          description="Enemy Rank",
 *          example="Jounin"
 *      ),
 *      @OA\Property(
 *          property="level",
 *          description="Enemy Level",
 *          example="A",
 *      ),
 *      @OA\Property(
 *          property="affiliation",
 *          description="Enemy affiliation",
 *          example="hidden village of the mist "
 *      ),
 *      @OA\Property(
 *          property="description",
 *          description="Enemy Description",
 *          example="Jounin of hidden village of the mist more..."
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="Enemy create date",
 *          example="2021-05-04T12:46:49",
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="Enemy update date",
 *          example="2021-05-04T12:46:49",
 *      ),
 *      @OA\Property(
 *          property="slug",
 *          description="Enemy slug page",
 *          example="zabuza-momochi",
 *      ),
 * )
 */
interface EnemyInterface
{
}
