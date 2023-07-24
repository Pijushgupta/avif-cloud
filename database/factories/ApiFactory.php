<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ApiFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{   
		$user_id = User::all()->pluck('id')->toArray();
		return [
			'user'		=> $this->faker->randomElement($user_id),
			'apikey'	=> $this->faker->uuid(64),
			'sites'		=> $this->faker->url(),
			'expiry'	=> $this->faker->date()
		];
	}
}
