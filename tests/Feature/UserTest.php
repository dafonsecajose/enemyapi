<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use RefreshDataBase;

    /**
     * @test
     */
    public function doReturnAllUsers()
    {
        User::factory()->create([
            'name' => 'John Doe1',
            'email' => 'johndoe1@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'name' => 'John Doe2',
            'email' => 'johndoe2@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $token = $this->getAutheticanteToken();
        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('GET', 'api/v1/users')
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Users found',
                'code' => 200,
                'error' => false,
                'results' => []
            ]);
    }

    /**
     * @test
     */
    public function doRequiredFieldsCreateUser()
    {
        $token = $this->getAutheticanteToken();
        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('POST', 'api/v1/users')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.']
                ]
            ]);
    }

    /**
     * @test
     */
    public function doRepeatPasswordCreateUser()
    {
        $token = $this->getAutheticanteToken();
        $userData = [
            "name" => "Maria Doe",
            "email" => "doemaria@test.com",
            "password" => "password"
        ];

        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('POST', 'api/v1/users', $userData)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password" => ["The password confirmation does not match."]
                ]
            ]);
    }

    /**
     * @test
     */
    public function doSuccessfullyCreadUser()
    {
        $token = $this->getAutheticanteToken();
        $userData = [
            "name" => "Maria Doe",
            "email" => "doemaria@test.com",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('POST', 'api/v1/users', $userData)
            ->assertStatus(201)
            ->assertJsonStructure([
                "message",
                "code" ,
                "error" ,
                "results" => [
                    "id",
                    "name",
                    "email"
                ]
            ]);
    }

    /**
     * @test
     */
    public function doNotReturnUserNonExist()
    {
        $token = $this->getAutheticanteToken();
        $wrongId = 177;

        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('GET', 'api/v1/users/' . $wrongId)
            ->assertStatus(404)
            ->assertJson([
                'message' => 'User not found',
                'error' => true,
                'code' => 404
            ]);
    }

    /**
     * @test
     */
    public function doReturnUserById()
    {
        $token = $this->getAutheticanteToken();
        $user = User::factory()->create([
            'name' => 'John Doe2',
            'email' => 'johndoe2@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('GET', 'api/v1/users/' . $user->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'User found',
                'error' => false,
                'code' => 200,
                'results' => [
                    'name' => 'John Doe2',
                    'email' => 'johndoe2@test.com',
                ]
            ]);
    }

    /**
     * @test
     */
    public function doNotUpdateUserNonExist()
    {
        $token = $this->getAutheticanteToken();
        $wrongUserId = 200;
        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('GET', 'api/v1/users/' . $wrongUserId)
            ->assertStatus(404)
            ->assertJson([
                'message' => 'User not found',
                'error' => true,
                'code' => 404,
            ]);
    }

    /**
     * @test
     */
    public function doSuccessfullyUpdateUser()
    {
        $token = $this->getAutheticanteToken();
        $user = User::factory()->create([
            'name' => 'Jose Doe',
            'email' => 'josedoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $userData = [
            "name" => "NEW Doe",
            "email" => "doenew@test.com"
        ];
        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('PATCH', 'api/v1/users/' . $user->id, $userData)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Updated user',
                'error' => false,
                'code' => 200,
                'results' => [
                    "name" => "NEW Doe",
                    "email" => "doenew@test.com"
                ]
            ]);
    }

    /**
     * @test
     */
    public function doNotDeleteUserNonExist()
    {
        $token = $this->getAutheticanteToken();
        $user = User::factory()->create([
            'name' => 'Joe Doe',
            'email' => 'joedoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('DELETE', 'api/v1/users/' . $user->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'User successfully removed',
                'error' => false,
                'code' => 200,
                'results' => []
            ]);
    }

    /**
     * @test
     */
    public function doSuccessfullyDeleteUser()
    {
        $token = $this->getAutheticanteToken();
        $wrongUserId = 200;
        $this->withHeaders(['Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'])
            ->json('DELETE', 'api/v1/users/' . $wrongUserId)
            ->assertStatus(404)
            ->assertJson([
                'message' => 'User not found exist',
                'error' => true,
                'code' => 404,
            ]);
    }



    private function getAutheticanteToken()
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $userData = [
            'email' => 'johndoe@test.com',
            'password' => 'password',
        ];

        $token = $this->withHeader('Accept', 'application/json')
            ->json('POST', 'api/v1/login', $userData)
            ->getContent();

        $token = json_decode($token)->token;

        return $token;
    }
}
