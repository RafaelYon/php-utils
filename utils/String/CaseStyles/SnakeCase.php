<?php

declare(strict_types=1);

namespace Utils\String\CaseStyles;

use Utils\Contracts\String\CaseStyleContract;

class SnakeCase implements CaseStyleContract
{
    public function split(string $text): array
    {
        return explode('_', $text);
    }

    public function join(array $parts): string
    {
        $result = implode('_', $parts);

        return mb_strtolower($result);
    }
}
