<?php

use App\User;
use App\TasksList;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tasks_lists')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        $faker = \Faker\Factory::create();
        User::create([
            'name' => 'Tonny Stark',
            'email' => 'tonny@stark.industries',
            'password' => bcrypt('iamironman'),
        ]);
        for($i = 0; $i < 9; $i++){
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
