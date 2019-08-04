<?php

declare(strict_types=1);

namespace Utils\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    /**
     * @property string $fileName The file was not found.
     */
    protected $fileName;

    /**
     * Create a new file not found exception.
     *
     * @param string $fileName  The file was not found.
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->message = 'The file "' . $fileName . '" was not found.';
    }
}
