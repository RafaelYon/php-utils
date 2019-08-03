<?php

declare(strict_types=1);

namespace Utils\String\CaseStyles;

use Utils\String\CaseStyles\PascalCase;

class CamelCase extends PascalCase
{
    public function join(array $parts): string
    {
        $result = parent::join($parts);

        if (strlen($result) < 1) {
            return $result;
        }

        $result[0] = mb_strtolower($result[0]);
        return $result;
    }
}
