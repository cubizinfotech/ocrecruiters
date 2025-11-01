<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recruiter;
use App\Models\Resume;
use Spatie\Permission\Models\Role;

class RecruiterSeeder extends Seeder
{
    public function run(): void
    {
        // Create 15 users with recruiter + resume
        $this->call([
            CategorySeeder::class,
            LocationSeeder::class,
        ]);

        if (!Role::where('name', 'recruiter')->exists()) {
            Role::create(['name' => 'recruiter', 'guard_name' => 'web']);
        }

        \App\Models\User::factory(15)->create()->each(function ($user) {

            if (method_exists($user, 'assignRole')) {
                $user->assignRole('recruiter');
            }

            \App\Models\Recruiter::factory()->create([
                'user_id' => $user->id,
            ]);

            \App\Models\Resume::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
