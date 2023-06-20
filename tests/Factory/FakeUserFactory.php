<?php

namespace Tests\Factory;

use Faker\Factory as Faker;

class FakeUserFactory
{
    public static function createUser($override = [])
    {
        $faker = Faker::create();
        $userData = [
            'name' => $faker->name,
            'email' => $faker->safeEmail,
            'password' => $faker->password,
        ];
        return [...$userData, ...$override];
    }
}
