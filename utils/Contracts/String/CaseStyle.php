<?php

namespace Utils\Contracts\String;

interface CaseStyleContract
{
    /**
     * Split words using Case Style rule.
     *
     * @param string    $text   The text in Case Stule rule.
     *
     * @return array    An array of strings
     */
    public function split(string $text): array;

    /**
     * Join the word using Case Style rule.
     *
     * @param array     $parts  The array of string to be join.
     *
     * @return string   The result word in the Case Style.
     */
    public function join(array $parts): string;
}
