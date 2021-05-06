<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class LoginJwtTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function doRequireFieldsForLogin()
    {
        $this->withHeader('Accept', 'application/json')->json('POST', 'api/v1/login')
            ->assertStatus(422)
            ->assertExactJson([
                "message" => "The given data was invalid.",
                "errors" => [
                "email" => ["The email field is required."],
                "password" => ["The password field is required."]
                ]
            ]);
    }

    /**
     * @test
     */
    public function doMinimumPasswordCharactersRequired()
    {
        $userData = [
            "email" => "test@test.com",
            "password" => "1234567"
        ];

        $this->withHeader('Accept', 'application/json')->json('POST', 'api/v1/login', $userData)
            ->assertStatus(422)
            ->assertExactJson([
                "message" => "The given data was invalid.",
                "errors" => [
                "password" => ["The password must be at least 8 characters."]
                ]
            ]);
    }

    /**
     * @test
     */

    public function doWrongEmailAndPassword()
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $userWrongData = [
            'email' => 'johndoe1@test.com',
            'password' => 'password1'
        ];

        $this->withHeader('Accept', 'application/json')->json('POST', 'api/v1/login', $userWrongData)
            ->assertStatus(401)
            ->assertExactJson([
                "error" => true,
                "code" => 401,
                "message" => "Unauthorized"
            ]);
    }

    /**
     * @test
     */
    public function doLoginAndReturnToken()
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $userData = [
            'email' => 'johndoe@test.com',
            'password' => 'password'
        ];
        $this->withHeader('Accept', 'application/json')->json('POST', 'api/v1/login', $userData)
            ->assertStatus(200)
            ->assertJsonStructure([
                "token"
            ]);
            $this->assertAuthenticated();
    }

    /**
    * @test
    */
    public function doLogoutSuccessfully()
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $userData = [
            'email' => 'johndoe@test.com',
            'password' => 'password'
        ];
        $this->withHeader('Accept', 'application/json')->json('POST', 'api/v1/login', $userData)
            ->assertStatus(200)
            ->assertJsonStructure([
                "token"
            ]);

        $this->withHeader('Accept', 'application/json')->json('GET', 'api/v1/logout')
                ->assertStatus(200)
                ->assertExactJson([
                    "code" => 200,
                    "error" => false,
                    "results" => [],
                    "message" => "Logout successfully"
                ]);
    }

    /**
     * @test
     */
    public function doRefresToken()
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $userData = [
            'email' => 'johndoe@test.com',
            'password' => 'password'
        ];
        $this->withHeader('Accept', 'application/json')->json('POST', 'api/v1/login', $userData)
            ->assertStatus(200)
            ->assertJsonStructure([
                "token"
            ]);

        $this->withHeader('Accept', 'application/json')->json('GET', 'api/v1/refresh')
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
                "results" => [
                    "token"
                ],
                "code",
                "error"
            ]);
    }
}
