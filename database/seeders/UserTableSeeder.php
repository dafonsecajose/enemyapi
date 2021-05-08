<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(\App\User::class, 1)->create();
        User::factory()->create([
            'name' => 'First User',
            'email' => 'first@email.com',
            'password' => bcrypt('password')
        ]);
    }
}
