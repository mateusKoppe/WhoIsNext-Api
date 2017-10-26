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
        Schema::disableForeignKeyConstraints();
        DB::table('helpers')->truncate();
        DB::table('tasks')->truncate();
        Schema::enableForeignKeyConstraints();
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
