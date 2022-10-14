<?php

namespace Gashmob\Dotenv\exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    /**
     * @param string $file
     */
    public function __construct($file)
    {
        parent::__construct("File not found: $file");
    }
}