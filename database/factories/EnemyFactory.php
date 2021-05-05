<?php

namespace Database\Factories;

use App\Models\Enemy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EnemyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enemy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $levels = ['Genin', 'Chunnin', 'Jounin', 'ANBU', 'Sannin', 'Kage'];
        $ranks = ['A', 'B', 'C', 'D', 'SS'];
        $name = $this->faker->unique()->name;
        return [
            'name' => $name,
            'rank' => $this->faker->randomElement($ranks),
            'level' => $this->faker->randomElement($levels),
            'affiliation' => $this->faker->word,
            'description' => $this->faker->text,
            'slug' => Str::slug($name)

        ];
    }
}
