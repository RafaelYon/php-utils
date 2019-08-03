<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Utils\Helpers\ArrayHelper;

final class ArrayHelperTest extends TestCase
{
    public function testCanAccessArrayDataByValidKeyDotInKeyDotAccessMethod()
    {
        $this->assertEquals(
            2,
            ArrayHelper::keyDotAccess(
                'levelOne.levelTwo', 
                [
                    'levelOne' => [
                        'levelTwo' => 2
                    ]
                ]
            )
        );
    }

    public function testCannotAccessArrayDataByInvalidKeyDotInKeyDotAccessMethod()
    {
        $this->assertEmpty(
            ArrayHelper::keyDotAccess(
                'levelOne.levelTwo',
                [
                    'levelTwo' => 2
                ]
            )
        );
    }

    public function testCannotAccessArrayDataByEmptyArrayInKeyDotAccessMethod()
    {
        $this->assertEmpty(
            ArrayHelper::keyDotAccess('levelOne.levelTwo', [])
        );
    }

    public function testReturnDataExceptSpecifiedKeysOfArrayInExceptMethod()
    {
        $this->assertEquals(
            ['data1' => 1, 'data3' => 3],
            ArrayHelper::except(
                [
                    'data1' => 1,
                    'data2' => 2,
                    'data3' => 3,
                    'data4' => 4
                ],
                ['data2', 'data4']
            )
        );
    }

    public function testReturnDataIfExceptKeysNotExistsInSourceInExceptMethod()
    {
        $this->assertEmpty(
            ArrayHelper::except(
                [],
                ['data1', 'data3']
            )
        );
    }

    public function testReturnOnlySpecifiedDataKeysInOnlyMethod()
    {
        $this->assertEquals(
            ['data1' => 1, 'data3' => 3],
            ArrayHelper::only(
                [
                    'data1' => 1,
                    'data2' => 2,
                    'data3' => 3,
                    'data4' => 4
                ],
                ['data1', 'data3']
            )
        );
    }

    public function testReturnEmptyIfSpecifiedDataKeysNotExistsInSourceInOnlyMethod()
    {
        $this->assertEmpty(
            ArrayHelper::only(
                [
                    'data1' => 1,
                    'data2' => 2,
                    'data3' => 3,
                    'data4' => 4
                ],
                ['data5']
            )
        );
    }
}