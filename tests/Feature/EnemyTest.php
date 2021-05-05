<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Enemy;
use Illuminate\Support\Str;

class EnemyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function doReturnAllEnimies()
    {
        $token = $this->getAuthenticateToken();


        Enemy::factory()->create([
            'name' => 'John Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('John Doe')
        ]);

        Enemy::factory()->create([
            'name' => 'Maria Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('Maria Doe')
        ]);

        $this->withHeaders(['Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json'])
        ->json('GET', 'api/v1/enemies', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Enemies found",
                "code" => 200,
                "error" => false,
                "results" => [
                    "data" => [
                        [
                            'name' => 'John Doe',
                            'rank' => 'Jounin',
                            'level' => 'A',
                            'affiliation' => 'Vila do Som',
                            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
                            'slug' => Str::slug('John Doe')
                        ],
                        [
                            'name' => 'Maria Doe',
                            'rank' => 'Jounin',
                            'level' => 'A',
                            'affiliation' => 'Vila do Som',
                            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
                            'slug' => Str::slug('Maria Doe')
                        ]
                    ],
                    "current_page" => 1,
                    "total" => 2,
                    "per_page" => 200,
                    "first_page_url" => route('enemies.index', ['page' => 1]),
                    "last_page_url" => route('enemies.index', ['page' => 1]),
                    "next_page_url" => null,
                    "prev_page_url" => null,
                    "path" => route('enemies.index')
                ]
            ]);
    }

    /**
     * @test
     */
    public function doShowEnemyById(){
        $token = $this->getAuthenticateToken();

        $enemy = Enemy::factory()->create([
            'name' => 'John Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('John Doe')
        ]);

        $this->withHeaders(['Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json' ])
            ->json('GET', 'api/v1/enemies/' . $enemy->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Enemy found',
                'code' => 200,
                'error' => false,
                'results' => [
                    'id' => $enemy->id,
                    'name' => 'John Doe',
                    'rank' => 'Jounin',
                    'level' => 'A',
                    'affiliation' => 'Vila do Som',
                    'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
                    'slug' => Str::slug('John Doe')
                ]
            ]);
    }

    /**
     * @test
     */

    public function doMistakeWhenSearchNonExistentEnemy()
    {
        $token = $this->getAuthenticateToken();
        $testId = 100;

        $this->withHeaders(['Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json'])
            ->json('GET', 'api/v1/enemies/' . $testId)
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Enemy not found',
                'error' => true,
                'code' => 404
            ]);
    }

    /**
     * @test
     */
    public function doDeleteEnemyById(){
        $token = $this->getAuthenticateToken();

        $enemy = Enemy::factory()->create([
            'name' => 'Amanda Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('Amanda Doe')
        ]);

        $this->withHeaders(['Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json'])
            ->json('DELETE', 'api/v1/enemies/' . $enemy->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Enemy successfully removed',
                'code' => 200,
                'error' => false,
            ]);
    }

    /**
     * @test
     */
    public function doNotDeleteNonExistendEnemy(){
        $token = $this->getAuthenticateToken();
        $wrongId = 300;

        $this->withHeaders(['Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json'])
            ->json('DELETE', 'api/v1/enemies/' .  $wrongId)
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Enemy does not exist',
                'code' => 404,
                'error' => true,
            ]);
    }

    /**
     * @test
     */
    public function doRequiredFieldsForCreateEnemy()
    {
        $token = $this->getAuthenticateToken();
        $this->withHeaders(['Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json'])
            ->json('POST', 'api/v1/enemies')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'rank' => ['The rank field is required.'],
                    'level' => ['The level field is required.'],
                    'affiliation' => ['The affiliation field is required.'],
                    'description'=> ['The description field is required.'],
                ]
            ]);
    }

    /**
     * @test
     */
    public function doSuccessfullyCreateEnemy()
    {
        $token = $this->getAuthenticateToken();

        $enemyData = [
            'name' => 'Amanda Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('Amanda Doe')
        ];

        $this->withHeaders(['Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json'])
            ->json('POST', 'api/v1/enemies', $enemyData)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'code',
                'error',
                'results' => [
                    'id',
                    'name',
                    'rank',
                    'level',
                    'affiliation',
                    'description',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /**
     * @test
     */
    public function doNotUpdateEnemyNonExist()
    {
        $token = $this->getAuthenticateToken();

        $wrongId = 300;

        $enemyData = [
            'name' => 'Amanda Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug("Amanda Doe")
        ];


        $this->withHeaders(['Authorization' => 'Bearer '. $token,
            'Accept' => 'application/json'])
            ->json('POST', 'api/v1/enemies/' . $wrongId, $enemyData)
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Enemy not found',
                'error' => true,
                'code' => 404,
            ]);
    }

    /**
     * @test
     */
    public function doSuccessfullyUpdateEnemy()
    {
        $token = $this->getAuthenticateToken();

        $enemy = Enemy::factory()->create([
            'name' => 'Amanda Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('Amanda Doe')
        ]);

        $enemyData = [
            'name' => 'Jessica Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('Jessica Doe')
        ];
        $this->withHeaders(['Authorization' => 'Bearer ' . $token ,
            'Accept' => 'application/json'])
            ->json('POST', 'api/v1/enemies/ ' . $enemy->id, $enemyData)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Enemy sucessfully updated',
                'code' => 200,
                'error' => false,
                'results' => [
                    'id' => $enemy->id,
                    'name' => 'Jessica Doe',
                    'rank' => $enemy->rank,
                    'level' => $enemy->level,
                    'affiliation' => $enemy->affiliation,
                    'description' => $enemy->description,
                    'slug' => 'jessica-doe'
                ]
            ]);
    }

    private function getAuthenticateToken(){
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $userData = [
            'email' => 'johndoe@test.com',
            'password' => 'password'
        ];

        $token = $this->json('POST', 'api/v1/login', $userData, ['Accept' => 'application/json'])
        ->getContent();

        $token = json_decode($token)->token;

        return $token;
    }
}


