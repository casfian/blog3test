<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

//add these
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
// utk guna faker

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Post::create(
        //     [
        //         'tajuk' => 'Post Satu',
        //         'kandungan' => 'kandungan Satu'
        //     ]
            
        // );

        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('Posts')->insert(
                [
                    'tajuk' => $faker->word,
                    'kandungan' => $faker->paragraph,
                    'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                    'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                ]
                );
        }
    
    }
}
