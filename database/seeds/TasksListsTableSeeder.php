<?php

use App\TasksList;
use Illuminate\Database\Seeder;

class TasksListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks_lists')->truncate();
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 50; $i++){
            TasksList::create([
                'name' => $faker->name,
                'description' => $faker->text,
                'creator' => rand(1,10)
            ]);
        }
    }
}
