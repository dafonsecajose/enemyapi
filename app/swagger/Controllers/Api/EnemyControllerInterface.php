<?php
namespace App\swagger\Controllers\Api;

use App\Http\Requests\EnemyRequest;

interface EnemyControllerInterface
{
    /**
     * @OA\Get(
     *      path="/enemies",
     *      operationId="getEnemyList",
     *      tags={"Enemies"},
     *      summary="Get list of enemies",
     *      description="Returns list of enemies",
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
    public function index();
    
    /**
     * @OA\Post(
     *      path="/enemies",
     *      operationId="storeEnemy",
     *      tags={"Enemies"},
     *      summary="Store new Enemy",
     *      description="Returns user data",
     *       security={{ "apiAuth": {} }},
     *      @OA\RequestBody(
     *          required= true,
     *          @OA\JsonContent(ref="#/components/schemas/EnemySearchRequestInterface")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EnemyInterface")
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      )
     * )
     */
    public function store(EnemyRequest $enemyRequest);


    /**
     * @OA\Get(
     *      path="/enemies/{id}",
     *      operationId="getEnemyById",
     *      tags={"Enemies"},
     *      summary="Get enemy information",
     *      description="Returns enemy data",
     *      security={{ "apiAuth": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Enemy Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      )
     * )
     */
    public function show($id);

    /**
     * @OA\Put(
     *      path="/enemies/{id}",
     *      operationId="updateEnemy",
     *      tags={"Enemies"},
     *      summary="Update existing enemy",
     *      security={{ "apiAuth": {} }},
     *      description="Returns updated enemy data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Enemy Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required= true,
     *          @OA\JsonContent(ref="#/components/schemas/EnemyRequestInterface")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#components/schemas/EnemyInterface")
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      )
     * )
     */
    public function update(EnemyRequest $request, $id);
    
    /**
     * @OA\Delete(
     *      path="/enemies/{id}",
     *      operationId="deleteEnemy",
     *      tags={"Enemies"},
     *      summary="Delete existing enemy",
     *      security={{ "apiAuth": {} }},
     *      description="Delete a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Enemy Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *      )
     * )
     */
    public function destroy($id);
}
