<?php

declare(strict_types=1);

namespace Utils\String\CaseStyles;

use Utils\Contracts\String\CaseStyleContract;

class PascalCase extends RegexCaseStyle implements CaseStyleContract
{
    public function getSeparatorRegexRule(): string
    {
        return '/[A-Z]/';
    }

    public function join(array $parts): string
    {
        $result = '';

        foreach($parts as $part) {
            $part[0] = mb_strtoupper($part[0]);
            $result .= $part;
        }

        return $result;
    }
}
