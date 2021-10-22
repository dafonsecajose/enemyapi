<?php
namespace App\swagger\Controllers\Api;

use Illuminate\Http\Request;

interface EnemySearchControllerInterface
{
    /**
     * @OA\Get(
     *      path="/search/enemies",
     *      operationId="getSearchEnemyList",
     *      tags={"Search"},
     *      summary="Get list of enemies",
     *      description="Returns list of enemies",
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
    public function index();
    
    /**
     * @OA\Get(
     *      path="/search/enemies/{slug}",
     *      operationId="getSearchEnemyBySlug",
     *      tags={"Search"},
     *      summary="Get enemy information",
     *      description="Returns enemy data",
     *      @OA\Parameter(
     *          name="slug",
     *          description="Enemy slug",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#component/schemas/Enemy")
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
    public function show($slug);

    /**
     * @OA\Get(
     *      path="/search/enemies/book",
     *      operationId="getSearchBookEnemyList",
     *      tags={"Search"},
     *      summary="Get list of enemies paginate",
     *      description="Returns list of enemies",
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
    public function book();

    
    /**
     * @OA\Post(
     *      path="/search/enemies",
     *      operationId="getSearchEnemy",
     *      tags={"Search"},
     *      summary="Get search enemy information",
     *      description="Returns enemy data",
     *     @OA\RequestBody(
     *          required= true,
     *          @OA\JsonContent(ref="#/components/schemas/EnemySearchRequestInterface")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#component/schemas/Enemy")
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
    public function search(Request $request);
}
