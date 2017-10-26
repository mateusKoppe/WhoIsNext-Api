<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Helper::class, function (Faker $faker) {
    $name_number_words = rand(2,4);
    $have_description = rand(1,2) == 2;
    $description = !$have_description ? null : $faker->text(200);
    $have_account = rand(1,3) == 3;
    $account = !$have_account ? null : $faker->randomElement(User::pluck('id')->toArray());
    return [
        'name' => $faker->sentence($name_number_words),
        'description' => $description,
        'task' => rand(1,50),
        'account' => $account,
    ];
});
