<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recruiter;
use App\Models\Resume;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call([
            CategorySeeder::class,
            LocationSeeder::class,
            RecruiterSeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class,
        ]);

        \App\Models\User::factory(15)->create()->each(function ($user) {
            $recruiter = \App\Models\Recruiter::factory()->create([
                'user_id' => $user->id,
            ]);

            \App\Models\Resume::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
