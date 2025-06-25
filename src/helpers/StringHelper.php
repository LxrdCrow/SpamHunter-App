<?php

namespace App\Helpers;

use Faker\Factory;

class StringHelper
{
    private static $faker;

    
    private static function init(): void
    {
        if (!self::$faker) {
            self::$faker = Factory::create('it_IT');
        }
    }

    public static function randomName(): string
    {
        self::init();
        return self::$faker->name();
    }

    public static function randomCompany(): string
    {
        self::init();
        return self::$faker->company();
    }

    public static function randomPhishingUrl(): string
    {
        self::init();
        $domain = self::$faker->domainName();
        $path = self::$faker->slug();
        $token = self::$faker->uuid;

        return "http://{$domain}/{$path}?id={$token}";
    }

    public static function randomEmail(): string
    {
        self::init();
        return self::$faker->safeEmail();
    }

    public static function randomSentence(): string
    {
        self::init();
        return self::$faker->sentence();
    }

    public static function randomParagraph(): string
    {
        self::init();
        return self::$faker->paragraph();
    }

    public static function randomIP(): string
    {
        self::init();
        return self::$faker->ipv4();
    }
}

