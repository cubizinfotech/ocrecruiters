<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ResumeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'linkedin' => 'https://linkedin.com/in/' . fake()->userName(),
            'github' => 'https://github.com/' . fake()->userName(),
            'portfolio' => fake()->url(),
            'summary' => '<p><strong>Professional Summary:</strong> ' . fake()->sentence(8) . '</p>',
            'education' => json_encode([
                [
                    'degree' => fake()->word(),
                    'field' => fake()->word(),
                    'school' => fake()->company(),
                    'city' => fake()->city(),
                    'state' => fake()->state()
                ]
            ]),
            'experience' => json_encode([
                [
                    'position' => fake()->jobTitle(),
                    'start_date' => fake()->date(),
                    'end_date' => fake()->date(),
                    'company_name' => fake()->company(),
                    'company_city' => fake()->city(),
                    'company_state' => fake()->state(),
                    'company_summary' => fake()->sentence()
                ]
            ]),
            'skills' => json_encode(fake()->randomElements(['PHP', 'JavaScript', 'Laravel', 'Vue', 'React', 'SQL'], 3)),
            'file_path' => 'resumes/' . fake()->image('storage/app/public/resumes', 200, 200, null, false),
            'projects' => fake()->sentence(),
            'languages' => json_encode(['English', 'Hindi']),
            'certifications' => json_encode([
                [
                    'cert' => fake()->word(),
                    'field' => fake()->word(),
                    'school' => fake()->company(),
                    'city' => fake()->city(),
                    'state' => fake()->state()
                ]
            ]),
        ];
    }
}
