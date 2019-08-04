<?php

declare(strict_types=1);

namespace Utils\Helpers;

class PathHelper
{
    protected function __construct()
    {
    }

    /**
     * Join the path parts using the DIRECTORY_SEPARATOR.
     *
     * @param array $paths  The paths parts.
     *
     * @return string   The full path.
     */
    public static function join(array $paths): string
    {
        return implode(
            DIRECTORY_SEPARATOR,
            array_map(static function($path) {
                return rtrim($path, DIRECTORY_SEPARATOR);
            }, $paths)
        );
    }
}
