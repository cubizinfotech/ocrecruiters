<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
           ['name' => 'Birmingham', 'state_id' => 1],
            ['name' => 'Montgomery', 'state_id' => 1],
            ['name' => 'Mobile', 'state_id' => 1],
            ['name' => 'Huntsville', 'state_id' => 1],
            ['name' => 'Tuscaloosa', 'state_id' => 1],

            // 2. Alaska
            ['name' => 'Anchorage', 'state_id' => 2],
            ['name' => 'Fairbanks', 'state_id' => 2],
            ['name' => 'Juneau', 'state_id' => 2],
            ['name' => 'Sitka', 'state_id' => 2],
            ['name' => 'Ketchikan', 'state_id' => 2],

            // 3. Arizona
            ['name' => 'Phoenix', 'state_id' => 3],
            ['name' => 'Tucson', 'state_id' => 3],
            ['name' => 'Mesa', 'state_id' => 3],
            ['name' => 'Chandler', 'state_id' => 3],
            ['name' => 'Glendale', 'state_id' => 3],

            // 4. Arkansas
            ['name' => 'Little Rock', 'state_id' => 4],
            ['name' => 'Fort Smith', 'state_id' => 4],
            ['name' => 'Fayetteville', 'state_id' => 4],
            ['name' => 'Springdale', 'state_id' => 4],
            ['name' => 'Jonesboro', 'state_id' => 4],

            // 5. California
            ['name' => 'Los Angeles', 'state_id' => 5],
            ['name' => 'San Diego', 'state_id' => 5],
            ['name' => 'San Jose', 'state_id' => 5],
            ['name' => 'San Francisco', 'state_id' => 5],
            ['name' => 'Fresno', 'state_id' => 5],

            // 6. Colorado
            ['name' => 'Denver', 'state_id' => 6],
            ['name' => 'Colorado Springs', 'state_id' => 6],
            ['name' => 'Aurora', 'state_id' => 6],
            ['name' => 'Fort Collins', 'state_id' => 6],
            ['name' => 'Lakewood', 'state_id' => 6],

            // 7. Connecticut
            ['name' => 'Bridgeport', 'state_id' => 7],
            ['name' => 'New Haven', 'state_id' => 7],
            ['name' => 'Hartford', 'state_id' => 7],
            ['name' => 'Stamford', 'state_id' => 7],
            ['name' => 'Waterbury', 'state_id' => 7],

            // 8. Delaware
            ['name' => 'Wilmington', 'state_id' => 8],
            ['name' => 'Dover', 'state_id' => 8],
            ['name' => 'Newark', 'state_id' => 8],
            ['name' => 'Middletown', 'state_id' => 8],
            ['name' => 'Smyrna', 'state_id' => 8],

            // 9. Florida
            ['name' => 'Miami', 'state_id' => 9],
            ['name' => 'Orlando', 'state_id' => 9],
            ['name' => 'Tampa', 'state_id' => 9],
            ['name' => 'Jacksonville', 'state_id' => 9],
            ['name' => 'Tallahassee', 'state_id' => 9],

            // 10. Georgia
            ['name' => 'Atlanta', 'state_id' => 10],
            ['name' => 'Savannah', 'state_id' => 10],
            ['name' => 'Augusta', 'state_id' => 10],
            ['name' => 'Columbus', 'state_id' => 10],
            ['name' => 'Macon', 'state_id' => 10],

            // 11. Hawaii
            ['name' => 'Honolulu', 'state_id' => 11],
            ['name' => 'Hilo', 'state_id' => 11],
            ['name' => 'Kailua', 'state_id' => 11],
            ['name' => 'Kapolei', 'state_id' => 11],
            ['name' => 'Waipahu', 'state_id' => 11],

            // 12. Idaho
            ['name' => 'Boise', 'state_id' => 12],
            ['name' => 'Meridian', 'state_id' => 12],
            ['name' => 'Nampa', 'state_id' => 12],
            ['name' => 'Idaho Falls', 'state_id' => 12],
            ['name' => 'Pocatello', 'state_id' => 12],

            // 13. Illinois
            ['name' => 'Chicago', 'state_id' => 13],
            ['name' => 'Aurora', 'state_id' => 13],
            ['name' => 'Naperville', 'state_id' => 13],
            ['name' => 'Joliet', 'state_id' => 13],
            ['name' => 'Springfield', 'state_id' => 13],

            // 14. Indiana
            ['name' => 'Indianapolis', 'state_id' => 14],
            ['name' => 'Fort Wayne', 'state_id' => 14],
            ['name' => 'Evansville', 'state_id' => 14],
            ['name' => 'South Bend', 'state_id' => 14],
            ['name' => 'Carmel', 'state_id' => 14],

            // 15. Iowa
            ['name' => 'Des Moines', 'state_id' => 15],
            ['name' => 'Cedar Rapids', 'state_id' => 15],
            ['name' => 'Davenport', 'state_id' => 15],
            ['name' => 'Sioux City', 'state_id' => 15],
            ['name' => 'Iowa City', 'state_id' => 15],

            // 16. Kansas
            ['name' => 'Wichita', 'state_id' => 16],
            ['name' => 'Overland Park', 'state_id' => 16],
            ['name' => 'Kansas City', 'state_id' => 16],
            ['name' => 'Topeka', 'state_id' => 16],
            ['name' => 'Olathe', 'state_id' => 16],

            // 17. Kentucky
            ['name' => 'Louisville', 'state_id' => 17],
            ['name' => 'Lexington', 'state_id' => 17],
            ['name' => 'Bowling Green', 'state_id' => 17],
            ['name' => 'Owensboro', 'state_id' => 17],
            ['name' => 'Covington', 'state_id' => 17],

            // 18. Louisiana
            ['name' => 'New Orleans', 'state_id' => 18],
            ['name' => 'Baton Rouge', 'state_id' => 18],
            ['name' => 'Shreveport', 'state_id' => 18],
            ['name' => 'Lafayette', 'state_id' => 18],
            ['name' => 'Lake Charles', 'state_id' => 18],

            // 19. Maine
            ['name' => 'Portland', 'state_id' => 19],
            ['name' => 'Bangor', 'state_id' => 19],
            ['name' => 'Lewiston', 'state_id' => 19],
            ['name' => 'Auburn', 'state_id' => 19],
            ['name' => 'South Portland', 'state_id' => 19],

            // 20. Maryland
            ['name' => 'Baltimore', 'state_id' => 20],
            ['name' => 'Frederick', 'state_id' => 20],
            ['name' => 'Rockville', 'state_id' => 20],
            ['name' => 'Gaithersburg', 'state_id' => 20],
            ['name' => 'Bowie', 'state_id' => 20],

            // 21–50 (remaining states)
            ['name' => 'Boston', 'state_id' => 21],
            ['name' => 'Springfield', 'state_id' => 21],
            ['name' => 'Cambridge', 'state_id' => 21],
            ['name' => 'Lowell', 'state_id' => 21],
            ['name' => 'Worcester', 'state_id' => 21],

            ['name' => 'Detroit', 'state_id' => 22],
            ['name' => 'Grand Rapids', 'state_id' => 22],
            ['name' => 'Warren', 'state_id' => 22],
            ['name' => 'Sterling Heights', 'state_id' => 22],
            ['name' => 'Ann Arbor', 'state_id' => 22],

            ['name' => 'Minneapolis', 'state_id' => 23],
            ['name' => 'Saint Paul', 'state_id' => 23],
            ['name' => 'Rochester', 'state_id' => 23],
            ['name' => 'Duluth', 'state_id' => 23],
            ['name' => 'Bloomington', 'state_id' => 23],

            ['name' => 'Jackson', 'state_id' => 24],
            ['name' => 'Gulfport', 'state_id' => 24],
            ['name' => 'Southaven', 'state_id' => 24],
            ['name' => 'Hattiesburg', 'state_id' => 24],
            ['name' => 'Biloxi', 'state_id' => 24],

            ['name' => 'Kansas City', 'state_id' => 25],
            ['name' => 'Saint Louis', 'state_id' => 25],
            ['name' => 'Springfield', 'state_id' => 25],
            ['name' => 'Columbia', 'state_id' => 25],
            ['name' => 'Independence', 'state_id' => 25],

            ['name' => 'Billings', 'state_id' => 26],
            ['name' => 'Missoula', 'state_id' => 26],
            ['name' => 'Great Falls', 'state_id' => 26],
            ['name' => 'Bozeman', 'state_id' => 26],
            ['name' => 'Helena', 'state_id' => 26],

            ['name' => 'Omaha', 'state_id' => 27],
            ['name' => 'Lincoln', 'state_id' => 27],
            ['name' => 'Bellevue', 'state_id' => 27],
            ['name' => 'Grand Island', 'state_id' => 27],
            ['name' => 'Kearney', 'state_id' => 27],

            ['name' => 'Las Vegas', 'state_id' => 28],
            ['name' => 'Henderson', 'state_id' => 28],
            ['name' => 'Reno', 'state_id' => 28],
            ['name' => 'Sparks', 'state_id' => 28],
            ['name' => 'Carson City', 'state_id' => 28],

            ['name' => 'Manchester', 'state_id' => 29],
            ['name' => 'Nashua', 'state_id' => 29],
            ['name' => 'Concord', 'state_id' => 29],
            ['name' => 'Dover', 'state_id' => 29],
            ['name' => 'Rochester', 'state_id' => 29],

            ['name' => 'Newark', 'state_id' => 30],
            ['name' => 'Jersey City', 'state_id' => 30],
            ['name' => 'Paterson', 'state_id' => 30],
            ['name' => 'Elizabeth', 'state_id' => 30],
            ['name' => 'Trenton', 'state_id' => 30],

            ['name' => 'Albuquerque', 'state_id' => 31],
            ['name' => 'Las Cruces', 'state_id' => 31],
            ['name' => 'Rio Rancho', 'state_id' => 31],
            ['name' => 'Santa Fe', 'state_id' => 31],
            ['name' => 'Roswell', 'state_id' => 31],

            ['name' => 'New York City', 'state_id' => 32],
            ['name' => 'Buffalo', 'state_id' => 32],
            ['name' => 'Rochester', 'state_id' => 32],
            ['name' => 'Syracuse', 'state_id' => 32],
            ['name' => 'Albany', 'state_id' => 32],

            ['name' => 'Charlotte', 'state_id' => 33],
            ['name' => 'Raleigh', 'state_id' => 33],
            ['name' => 'Greensboro', 'state_id' => 33],
            ['name' => 'Durham', 'state_id' => 33],
            ['name' => 'Winston-Salem', 'state_id' => 33],

            ['name' => 'Fargo', 'state_id' => 34],
            ['name' => 'Bismarck', 'state_id' => 34],
            ['name' => 'Grand Forks', 'state_id' => 34],
            ['name' => 'Minot', 'state_id' => 34],
            ['name' => 'West Fargo', 'state_id' => 34],

            ['name' => 'Columbus', 'state_id' => 35],
            ['name' => 'Cleveland', 'state_id' => 35],
            ['name' => 'Cincinnati', 'state_id' => 35],
            ['name' => 'Toledo', 'state_id' => 35],
            ['name' => 'Akron', 'state_id' => 35],

            ['name' => 'Oklahoma City', 'state_id' => 36],
            ['name' => 'Tulsa', 'state_id' => 36],
            ['name' => 'Norman', 'state_id' => 36],
            ['name' => 'Broken Arrow', 'state_id' => 36],
            ['name' => 'Lawton', 'state_id' => 36],

            ['name' => 'Portland', 'state_id' => 37],
            ['name' => 'Eugene', 'state_id' => 37],
            ['name' => 'Salem', 'state_id' => 37],
            ['name' => 'Gresham', 'state_id' => 37],
            ['name' => 'Hillsboro', 'state_id' => 37],

            ['name' => 'Philadelphia', 'state_id' => 38],
            ['name' => 'Pittsburgh', 'state_id' => 38],
            ['name' => 'Allentown', 'state_id' => 38],
            ['name' => 'Erie', 'state_id' => 38],
            ['name' => 'Reading', 'state_id' => 38],

            ['name' => 'Providence', 'state_id' => 39],
            ['name' => 'Warwick', 'state_id' => 39],
            ['name' => 'Cranston', 'state_id' => 39],
            ['name' => 'Pawtucket', 'state_id' => 39],
            ['name' => 'East Providence', 'state_id' => 39],

            ['name' => 'Charleston', 'state_id' => 40],
            ['name' => 'Columbia', 'state_id' => 40],
            ['name' => 'North Charleston', 'state_id' => 40],
            ['name' => 'Mount Pleasant', 'state_id' => 40],
            ['name' => 'Rock Hill', 'state_id' => 40],

            ['name' => 'Sioux Falls', 'state_id' => 41],
            ['name' => 'Rapid City', 'state_id' => 41],
            ['name' => 'Aberdeen', 'state_id' => 41],
            ['name' => 'Brookings', 'state_id' => 41],
            ['name' => 'Watertown', 'state_id' => 41],

            ['name' => 'Nashville', 'state_id' => 42],
            ['name' => 'Memphis', 'state_id' => 42],
            ['name' => 'Knoxville', 'state_id' => 42],
            ['name' => 'Chattanooga', 'state_id' => 42],
            ['name' => 'Clarksville', 'state_id' => 42],

            ['name' => 'Houston', 'state_id' => 43],
            ['name' => 'Dallas', 'state_id' => 43],
            ['name' => 'Austin', 'state_id' => 43],
            ['name' => 'San Antonio', 'state_id' => 43],
            ['name' => 'Fort Worth', 'state_id' => 43],

            ['name' => 'Salt Lake City', 'state_id' => 44],
            ['name' => 'Provo', 'state_id' => 44],
            ['name' => 'Ogden', 'state_id' => 44],
            ['name' => 'Sandy', 'state_id' => 44],
            ['name' => 'St. George', 'state_id' => 44],

            // 45. Vermont
            ['state_id' => 45, 'name' => 'Burlington'],
            ['state_id' => 45, 'name' => 'South Burlington'],
            ['state_id' => 45, 'name' => 'Rutland'],
            ['state_id' => 45, 'name' => 'Barre'],
            ['state_id' => 45, 'name' => 'Montpelier'],

            // 46. Virginia
            ['state_id' => 46, 'name' => 'Virginia Beach'],
            ['state_id' => 46, 'name' => 'Norfolk'],
            ['state_id' => 46, 'name' => 'Chesapeake'],
            ['state_id' => 46, 'name' => 'Richmond'],
            ['state_id' => 46, 'name' => 'Arlington'],

            // 47. Washington
            ['state_id' => 47, 'name' => 'Seattle'],
            ['state_id' => 47, 'name' => 'Spokane'],
            ['state_id' => 47, 'name' => 'Tacoma'],
            ['state_id' => 47, 'name' => 'Vancouver'],
            ['state_id' => 47, 'name' => 'Bellevue'],

            // 48. West Virginia
            ['state_id' => 48, 'name' => 'Charleston'],
            ['state_id' => 48, 'name' => 'Huntington'],
            ['state_id' => 48, 'name' => 'Morgantown'],
            ['state_id' => 48, 'name' => 'Parkersburg'],
            ['state_id' => 48, 'name' => 'Wheeling'],

            // 49. Wisconsin
            ['state_id' => 49, 'name' => 'Milwaukee'],
            ['state_id' => 49, 'name' => 'Madison'],
            ['state_id' => 49, 'name' => 'Green Bay'],
            ['state_id' => 49, 'name' => 'Kenosha'],
            ['state_id' => 49, 'name' => 'Racine'],

            // 50. Wyoming
            ['state_id' => 50, 'name' => 'Cheyenne'],
            ['state_id' => 50, 'name' => 'Casper'],
            ['state_id' => 50, 'name' => 'Laramie'],
            ['state_id' => 50, 'name' => 'Gillette'],
            ['state_id' => 50, 'name' => 'Rock Springs'],
        ];

        DB::table('cities')->insert($cities);
    }
}
