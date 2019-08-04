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
    public static function join(...$paths): string
    {
        for ($i = 0, $len = count($paths) - 1; $i <= $len; $i++) {
            if ($i === 0) {
                $paths[$i] = rtrim($paths[$i], DIRECTORY_SEPARATOR);
            } elseif ($i === $len) {
                $paths[$i] = ltrim($paths[$i], DIRECTORY_SEPARATOR);
            } else {
                $paths[$i] = trim($paths[$i], DIRECTORY_SEPARATOR);
            }
        }

        return implode(
            DIRECTORY_SEPARATOR,
            $paths
        );
    }
}
