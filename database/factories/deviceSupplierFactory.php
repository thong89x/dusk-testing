<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// namespace Database\Factories;
use App\deviceSupplier;
use App\Helpers\CommonHelper;
use Faker\Generator as Faker;

$factory->define(deviceSupplier::class, function (Faker $faker) {
    $name =$faker->unique()->name();
    $name = preg_replace('/[^A-Za-z0-9]/', '', $name);
    $code = CommonHelper::stripVNAndRemoveSpecialCharsAndHandleZero($name);
    return [
        //
        'name' => $name,
        'code' => $code,
        'duration' => $faker->numberBetween(0,99999999),
        'creator_id' => 479,
        'company_branch_id' => 138,
        'created_at' => '2022-03-21 15:15:21',
        'updated_at' => '2022-03-21 15:15:21',
        'deleted_at' => NULL,
    ];
});

// // use App\deviceSupplier;
// use Illuminate\Database\Eloquent\Factories\Factory as Factory;
 
// class deviceSupplierFactory extends Factory
// {
//     /**
//      * The name of the factory's corresponding model.
//      *
//      * @var class-string<\Illuminate\Database\Eloquent\Model>
//      */
//     protected $model = deviceSupplier::class;
// }