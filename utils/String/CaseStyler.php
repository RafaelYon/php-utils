<?php

declare(strict_types=1);

namespace Utils\String;

use Utils\Contracts\String\CaseStyleContract;

class CaseStyler
{
    protected $style;

    public function __construct(CaseStyleContract $style)
    {
        $this->setStyle($style);
    }
    
    public function setStyle(CaseStyleContract $style)
    {
        $this->style = $style;
    }

    public function getStyle(): CaseStyleContract
    {
        return $this->style;
    }

    public function split(string $text): array
    {
        return $this->style->split($text);
    }

    public function join(array $parts): string
    {
        return $this->style->join($parts);
    }
}
