<?php

namespace Database\Factories;

use App\Models\EnemyPhoto;
use App\Models\Enemy;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnemyPhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EnemyPhoto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $positons = ['front', 'side', 'back'];
        return [
            'photo' => $this->faker->image('public/storage/images', 1,1, null, false),
            'position' => $this->faker->randomElement($positons),
            'enemy_id' => Enemy::factory(),
        ];
    }
}
