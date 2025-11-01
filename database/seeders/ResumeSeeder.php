<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resume;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        Resume::create([
            'user_id' => 2,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'address' => '123 Main Street',
            'linkedin' => 'https://linkedin.com/in/johndoe',
            'github' => 'https://github.com/johndoe',
            'portfolio' => 'https://johndoe.com',
            'summary' => 'Experienced software developer with expertise in Laravel.',
            'education' => [
                ['degree' => 'B.Sc Computer Science', 'institution' => 'XYZ University', 'year' => '2020'],
                ['degree' => 'M.Sc Computer Science', 'institution' => 'XYZ University', 'year' => '2022']
            ],
            'experience' => [
                ['role' => 'Junior Developer', 'company' => 'ABC Inc', 'from' => '2020', 'to' => '2021'],
                ['role' => 'Senior Developer', 'company' => 'DEF Ltd', 'from' => '2021', 'to' => 'Present']
            ],
            'skills' => ['PHP', 'Laravel', 'JavaScript', 'Vue.js'],
            'projects' => [
                ['name' => 'Project A', 'description' => 'E-commerce website'],
                ['name' => 'Project B', 'description' => 'Blog platform']
            ],
            'languages' => ['English', 'Spanish'],
            'certifications' => ['AWS Certified Developer', 'Laravel Certification'],
            'hobbies' => 'Reading, Travelling'
        ]);
    }
}
