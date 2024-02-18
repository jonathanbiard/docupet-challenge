<?php
namespace App\Models;

use Random\RandomException;

class Helpers
{
    public static function getRandomInteger(): int
    {
        try {
            $number = random_int(0, 100);
        } catch (RandomException) {
            $number = 999;
        }

        return $number;
    }
}
