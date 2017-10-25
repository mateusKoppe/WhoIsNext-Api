<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->truncate();
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 50; $i++){
            Task::create([
                'name' => $faker->name,
                'description' => $faker->text,
                'creator' => rand(1,10)
            ]);
        }
    }
}
