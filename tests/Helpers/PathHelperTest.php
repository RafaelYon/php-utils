<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Utils\Helpers\PathHelper;

final class PathHelperTest extends TestCase
{
    public function testCanJoinPathsParts()
    {
        $this->assertEquals(
            'path/to/file.php',
            PathHelper::join(
                'path/',
                '/to/',
                'file.php'
            )
        );
        
        $this->assertEquals(
            '/path/to/file.php',
            PathHelper::join(
                '/path/',
                'to',
                '/file.php'
            )
        );

        $this->assertEquals(
            '/path/to/directory/',
            PathHelper::join(
                '/path',
                'to/',
                '/directory/'
            )
        );
    }
}