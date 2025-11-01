<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            'Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Mumbai', 'Pune', 'Delhi',
            'Bangalore', 'Hyderabad', 'Chennai', 'Kolkata', 'Indore', 'Jaipur',
            'Lucknow', 'Nagpur', 'Chandigarh', 'Bhopal', 'Coimbatore', 'Noida',
            'Gurugram', 'Vishakhapatnam', 'Trivandrum', 'Goa', 'Patna', 'Kanpur',
            'Nashik', 'Aurangabad', 'Vapi', 'Navsari', 'Gandhinagar', 'Mehsana',
            'Anand', 'Jamnagar', 'Udaipur', 'Surendranagar', 'Bharuch',
            'Junagadh', 'Amritsar', 'Agra', 'Ranchi'
        ];

        foreach ($locations as $name) {
            Location::firstOrCreate(['name' => $name]);
        }
    }
}
