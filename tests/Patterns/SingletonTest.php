<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Utils\Patterns\Singleton;

final class SingletonTest extends TestCase
{
    public function testChildClassInstancesIsUniques()
    {
        $this->assertNotInstanceOf(
            First::class,
            Second::getInstance()
        );
    }

    public function testChildClassInstancesNotContainsTheSameAttribute()
    {
        $first = First::getInstance();
        $second = Second::getInstance();

        $this->assertObjectNotHasAttribute(
            'attributeOne',
            $second
        );

        $this->assertObjectNotHasAttribute(
            'attributeTwo',
            $first
        );
    }

    public function testHasOnlyInstanceOfChild()
    {
        $a =  First::getInstance();
        $a->attributeOne = 221;

        $this->assertSame(
            $a->attributeOne,
            First::getInstance()->attributeOne
        );
    }
}

class First extends Singleton
{
    public $attributeOne = 'I am the first';
}

class Second extends Singleton
{
    public $attributeTwo = 'I am the second!';
}