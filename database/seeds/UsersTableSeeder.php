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
        DB::table('tasks')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        $faker = \Faker\Factory::create();
        User::create([
            'name' => 'Tonny Stark',
            'email' => 'tonny@stark.industries',
            'password' => bcrypt('iamironman'),
            'api_token' => 'MDSU4AAp6gSQBpJW2Gcbp4RYaOMdIULmVQ1XkgDnq2FTPtTkTkj7DrrdINC87JcY',
        ]);
        for($i = 0; $i < 9; $i++){
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'api_token' => str_random(64),
            ]);
        }
    }
}
