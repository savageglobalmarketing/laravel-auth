<?php

namespace Maxcelos\Auth\Database\Factories;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Maxcelos\Auth\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }
}
