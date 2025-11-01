<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Information Technology',
            'Finance',
            'Healthcare',
            'Education',
            'Marketing',
            'Engineering',
            'Hospitality',
            'Legal',
            'Retail',
            'Transportation',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
