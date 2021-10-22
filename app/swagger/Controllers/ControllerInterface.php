<?php
namespace App\swagger\Controllers;

interface ControllerInterface
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Enemy API Documentation",
     *      description="",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo Enemy Api"
     * )
     *
     *  @OA\Tag(
     *      name="Search",
     *      description="API Endpoints of Search"
     * )
     *
     *  @OA\Tag(
     *      name="Users",
     *      description="API Endpoints of Users"
     * )
     *
     * @OA\Tag(
     *      name="Enemies",
     *      description="API Endpoints of Enemies"
     * )
     *
     * @OA\Tag(
     *      name="Authorization",
     *      description="API Endpoints of Enemies"
     * )
     *
     *
     * /**
     * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="apiAuth",
     * )
     */
}
