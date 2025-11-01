<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use App\Models\Location;

class RecruiterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'location_id' => Location::inRandomOrder()->first()?->id ?? Location::factory(),
            'logo' => 'recruiter-logos/' . fake()->image('storage/app/public/recruiter-logos', 200, 200, null, false),
            'rating' => fake()->randomFloat(2, 3, 5),
            'jobs_open' => fake()->numberBetween(0, 10),
        ];
    }
}
