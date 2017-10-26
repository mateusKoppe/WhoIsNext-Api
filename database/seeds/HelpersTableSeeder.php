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
        factory(Helper::class, 250)->create();
    }
}
