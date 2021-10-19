<?php

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Job::create([
                'company' => $faker->address, 
                'title' => $faker->name, 
                'description' => $faker->text,
                'salary' => $faker->numberBetween($min = 1500, $max = 6000),
                'location' => $faker->state,
                'post_date' => $faker->dateTime,
                'category_id' => rand(1, 49), 
                'user_id' => rand(1,5)
            ]);
        }
    }
}
