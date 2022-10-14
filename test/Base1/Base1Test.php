<?php

namespace Gashmob\Dotenv\Test\Base1;

use Gashmob\Dotenv\Env;
use Gashmob\Dotenv\exceptions\FileNotFoundException;
use Gashmob\Dotenv\Test\Test;

class Base1Test implements Test
{

    /**
     * @inheritDoc
     * @throws FileNotFoundException
     */
    public function run()
    {
        Env::load(__DIR__ . '/.env');

        if (count($_ENV) !== 3 && count($_SERVER['ENV']) !== 3) {
            return false;
        }

        if ($_ENV != $_SERVER['ENV']) {
            return false;
        }

        if ($_ENV['MODE'] != 'prod' &&
            $_ENV['URL'] != 'http://localhost:8080' &&
            $_ENV['COMPLEX_URL'] != 'http://localhost:8080?param1=1&param2=2') {
            return false;
        }


        return true;
    }
}