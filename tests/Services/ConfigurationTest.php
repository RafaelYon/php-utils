<?php

declare(strict_types=1);

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;
use Utils\Exceptions\FileNotFoundException;
use Utils\Helpers\PathHelper;
use Utils\Services\Configuration;

final class ConfigurationTest extends TestCase
{
    public function testCannotGetConfigDataBecauseWasPassedInvalidDotKey()
    {
        $this->expectException(InvalidArgumentException::class);
        
        Config::get('invalidKey');
    }

    public function testCannotGetConfigDataBecauseWasPassedInvalidFileNameInConfigPath()
    {
        $this->expectException(InvalidArgumentException::class);

        Config::get('.arrayOne');
    }

    public function testCannotGetConfigDataBecauseWasPassedNonExistentConfigFile()
    {
        $this->expectException(FileNotFoundException::class);

        Config::get('nonExistentFile.arrayOne');
    }

    public function testCannotGetConfigDataBecauseConfigFileNotReturnArray()
    {
        $this->expectException(UnexpectedValueException::class);

        Config::get('invalid.configOne');
    }

    public function testCanGetConfigDataBecauseConfigPathAndConfigFileIsValid()
    {
        $this->assertEquals(
            33321,
            Config::get('valid.configOne.value')
        );
    }

    public function testShouldReturnNullOnConfigFileDontContainerSpecifiedConfig()
    {
        $this->assertNull(
            Config::get('valid.invalidConfig')
        );
    }

    public function testShouldReturnNullOnEmptyConfigKey()
    {
        $this->assertNull(
            Config::get('valid.')
        );
    }
}

final class Config extends Configuration
{
    protected function getConfigDirectoryPath(): string
    {
        return PathHelper::join(__DIR__, 'configs');
    }
}