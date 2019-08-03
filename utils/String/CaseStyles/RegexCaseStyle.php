<?php

declare(strict_types=1);

namespace Utils\String\CaseStyles;

abstract class RegexCaseStyle
{
    /**
     * Get the Regex rule used to find word separator.
     *
     * @return string   The regex rule.
     */
    protected abstract function getSeparatorRegexRule(): string;

    protected function handlerSplitedParts(string $text, array $parts): array
    {
        $result = [];
        $currentIndex = 0;

        foreach ($parts[0] as $part) {
            if ($part[1] === 0) {
                $part = null;
                continue;
            }

            $result[] = substr($text, $currentIndex, $part[1]);
            $currentIndex = $part[1];
        }

        if (! empty($part)) {
            $result[] = substr($text, $part[1]);
        }

        return $result;
    }

    public function split(string $text): array
    {
        $parts = [];

        preg_match_all(
            $this->getSeparatorRegexRule(),
            $text,
            $parts,
            PREG_OFFSET_CAPTURE
        );

        return $this->handlerSplitedParts($text, $parts);
    }
}
