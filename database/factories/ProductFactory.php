<?php

use Faker\Generator as Faker;

use App\Model\Category;
use App\User;

$factory->define(App\Model\Product::class, function (Faker $faker) {

	return [
        'name' => $faker->word,
        'detail' => $faker->paragraph,
        'price' => $faker->numberBetween(100,1000),
        'stock'=> $faker->randomDigit,
        'discount' => $faker->numberBetween(2,30),
        'user_id' => function(){
        	return App\User::all()->random();
        },
        'category_id' => function(){
           return Category::all()->random();
        }
    ];

});
