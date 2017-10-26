<?php

use App\Helper;
use Illuminate\Database\Seeder;

class HelpersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('helpers')->truncate();
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 300; $i++){
            Helper::create([
                'name' => $faker->sentence(rand(2,5)),
                'description' => rand(1,3) == 3 ? $faker->text(200) : null,
                'task' => rand(1,50),
                'account' => rand(1,3) == 3 ? rand(1,10) : null,
            ]);
        }
    }
}
