<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Enemy;
use App\Models\EnemyPhoto;
use Illuminate\Support\Str;

class EnemySearchTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function doReturnAllEnemies()
    {
        $enemy = Enemy::factory()->create([
            'name' => 'John Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('John Doe')
        ]);

        $this->withHeader('Accept','application/json')->json('GET', 'api/v1/search/enemies/')
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'All enemies',
                'error' => false,
                'code' => 200,
                'results' =>[
                    'data' => [
                    [
                        'name' => 'John Doe',
                        'link' => route('search.enemies.show', ['slug' => Str::slug('John Doe')])
                    ]
                ],
                "current_page"=> 1,
                "total" => 1,
                "per_page" => 200,
                "last_page"=> 1,
                "first_page_url"=>  route('search.enemies.index', ['page'=> '1']),
                "last_page_url" =>  route('search.enemies.index', ['page'=> '1']),
                "next_page_url" =>  null,
                "prev_page_url" => null,
                "path" => route('search.enemies.index'),
            ]

            ]);
    }

    /**
     * @test
     */
    public function doReturnEnemyBySlug(){
        $enemy = Enemy::factory()->create([
            'name' => 'John Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('John Doe')
        ]);

        $this->withHeader('Accept','application/json')->json('GET', 'api/v1/search/enemies/' . $enemy->slug, [])
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Enemy found',
                'error' => false,
                'code' => 200,
                'results' => [
                            'name' => 'John Doe',
                            'rank' => 'Jounin',
                            'level' => 'A',
                            'affiliation' => 'Vila do Som',
                            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
                            'photos' => []
                ]
            ]);
    }

    /**
     * @test
     */
    public function doReturnBook(){
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

        $this->withHeader('Accept','application/json')->json('GET', 'api/v1/search/enemies/book')
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Enemy found',
                'error' => false,
                'code' => 200,
                'results' => [
                    "current_page"=> 1,
                    'data' =>[
                        [
                                'name' => 'John Doe',
                                'rank' => 'Jounin',
                                'level' => 'A',
                                'affiliation' => 'Vila do Som',
                                'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
                                'photos' => []
                        ]
                    ],
                    "total" => 2,
                    "per_page" => 1,
                    "last_page"=> 2,
                    "first_page_url"=>  route('search.enemies.book', ['page'=> '1']),
                    "last_page_url" =>  route('search.enemies.book', ['page'=> '2']),
                    "next_page_url" =>  route('search.enemies.book', ['page'=> '2']),
                    "prev_page_url" => null,
                    "path" => route('search.enemies.book'),
                ]
            ]);
    }

    /**
     * @test
     */
    public function doReturnSearchByName()
    {
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
        Enemy::factory()->create([
            'name' => 'Jane Doe',
            'rank' => 'Jounin',
            'level' => 'A',
            'affiliation' => 'Vila do Som',
            'description' => 'Lorem ipsum dolor sitsto quis quae rerum fuga!',
            'slug' => Str::slug('Jane Doe')
        ]);

        $name = 'John';

        $this->withHeader('Accept','application/json')->json('GET', 'api/v1/search/enemies/search?name='. $name)
            ->assertStatus(200)
            ->assertExactJson ([
            'message' => 'Enemy found',
            'error' => false,
            'code' => 200,
            'results' => [
                "current_page"=> 1,
                'data' =>[
                    [
                        "name" => 'John Doe',
                        "link" => route('search.enemies.show', ['slug' => Str::slug('John Doe')])
                    ]
                ],
                "total" => 1,
                "per_page" => 200,
                "last_page"=> 1,
                "first_page_url"=>  route('search.enemies.search', ['page'=> '1']),
                "last_page_url" =>  route('search.enemies.search', ['page'=> '1']),
                "next_page_url" => null,
                "prev_page_url" => null,
                "path" => route('search.enemies.search'),
            ]
            ]);
    }

}


