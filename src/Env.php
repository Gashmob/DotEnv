<?php

namespace Gashmob\Dotenv;

use Gashmob\Dotenv\exceptions\FileNotFoundException;

$_ENV = [];

class Env
{
    /**
     * Load a .env file and store it to $_ENV and $_SERVER['ENV']
     *
     * @param string $file
     * @return void
     * @throws FileNotFoundException
     */
    public static function load($file)
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException($file);
        }

        $content = file_get_contents($file);

        $lines = explode(PHP_EOL, $content);

        global $_ENV;
        $server = [];
        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }

            $line = trim($line);

            if (strpos($line, '#') === 0) {
                continue;
            }

            $parts = explode('=', $line, 2);
            assert(count($parts) === 2);
            $key = trim($parts[0]);
            $value = trim($parts[1]);

            $_ENV[$key] = $value;
            $server[$key] = $value;
        }
        $_SERVER['ENV'] = $server;
    }
}