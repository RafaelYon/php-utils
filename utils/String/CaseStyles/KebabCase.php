<?php

declare(strict_types=1);

namespace Utils\String\CaseStyles;

use Utils\Contracts\String\CaseStyleContract;

class KebabCase implements CaseStyleContract
{
    public function split(string $text): array
    {
        return explode('-', $text);
    }

    public function join(array $parts): string
    {
        $result = implode('-', $parts);

        return mb_strtolower($result);
    }
}
