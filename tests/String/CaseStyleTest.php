<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Utils\String\CaseStyler;
use Utils\String\CaseStyles\CamelCase;
use Utils\String\CaseStyles\KebabCase;
use Utils\String\CaseStyles\PascalCase;
use Utils\String\CaseStyles\SnakeCase;

class CaseStyleTest extends TestCase
{    
    protected function assertSplit(string $className, array $equal, string $text)
    {
        $case = new $className();

        $this->assertEquals(
            $equal,
            $case->split($text)
        );
    }

    protected function assertJoin(string $className, string $equal, array $parts)
    {
        $case = new $className();

        $this->assertEquals(
            $equal,
            $case->join($parts)
        );
    }
    
    public function testCanSplitCamelCase()
    {
        $this->assertSplit(CamelCase::class, ['camel', 'Case'], 'camelCase');
    }

    public function testCanJoinCamelCase()
    {
        $this->assertJoin(CamelCase::class, 'camelCase', ['Camel', 'case']);
    }

    public function testCanSplitKebabCase()
    {
        $this->assertSplit(KebabCase::class, ['kebab', 'case'], 'kebab-case');
    }

    public function testCanJoinKebabCase()
    {
        $this->assertJoin(KebabCase::class, 'kebab-case', ['KeBab', 'CASE']);
    }

    public function testCanSplitPascalCase()
    {
        $this->assertSplit(PascalCase::class, ['Pascal', 'Case'], 'PascalCase');
    }

    public function testCanJoinPascalCase()
    {
        $this->assertJoin(PascalCase::class, 'PascalCase', ['pascal', 'Case']);
    }

    public function testCanSplitSnakeCase()
    {
        $this->assertSplit(SnakeCase::class, ['snake', 'case'], 'snake_case');
    }

    public function testCanJoinsnakeCase()
    {
        $this->assertJoin(SnakeCase::class, 'snake_case', ['SNAKE', 'cAse']);
    }

    public function testCanSetStyleToCaseStyler()
    {
        $this->assertInstanceOf(
            CaseStyler::class,
            new CaseStyler(new CamelCase())
        );
    }

    public function testCanChangeStyleOfCaseStyler()
    {
        $caseStyler = new CaseStyler(new CamelCase());
        $caseStyler->setStyle(new KebabCase());

        $this->assertInstanceOf(
            KebabCase::class,
            $caseStyler->getStyle()
        );
    }

    public function testCanJoinWithCaseStyler()
    {
        $caseStyler = new CaseStyler(new CamelCase());

        $this->assertEquals(
            'camelCase',
            $caseStyler->join(['Camel', 'case'])
        );
    }

    public function testCanSplitWithCaseStyler()
    {
        $caseStyle = new CaseStyler(new CamelCase());

        $this->assertEquals(
            ['camel', 'Case'],
            $caseStyle->split('camelCase')
        );
    }
}