<?php

declare(strict_types=1);

namespace Utils\Services;

use InvalidArgumentException;
use stdClass;
use UnexpectedValueException;
use Utils\Exceptions\FileNotFoundException;
use Utils\Helpers\ArrayHelper;
use Utils\Helpers\PathHelper;
use Utils\Patterns\Singleton;

abstract class Configuration extends Singleton
{
    /**
     * @property array $configs The loaded configs.
     */
    protected $configs;

    /**
     * Get the config directory path.
     *
     * @return string   The config directory path
     */
    protected abstract function getConfigDirectoryPath(): string;

    /**
     * Handler informed config path.
     *
     * @param string $configPath    The config path in "doted key" format
     *
     * @return \stdClass    The instace has "file" and "configKey" attributes
     *
     * @throws \InvalidArgumentException    If $configPath is not a valid
     *                                      doted key.
     *                                      Ex.: "one.two.tree"
     * @throws \InvalidArgumentException    If fileName passed in $configPath
     *                                      is invalid.
     */
    protected function handlerConfigPath(string $configPath): stdClass
    {
        $fileSeparatorPos = mb_strpos($configPath, '.');

        if ($fileSeparatorPos === false) {
            throw new InvalidArgumentException(
                'The $configPath is not a valid doted key'
            );
        }

        $result = new stdClass();
        $result->file       = mb_substr($configPath, 0, $fileSeparatorPos);

        if (mb_strlen($result->file) < 1) {
            throw new InvalidArgumentException(
                'The file name of $configPath is invalid.'
            );
        }

        $result->configKey  = mb_substr($configPath, $fileSeparatorPos);
        return $result;
    }

    /**
     * Get the config file contents.
     * The config file should return array.
     *
     * @param string $fileName  The the config file name.
     *
     * @return array    The config file array return.
     *
     * @throws \Utils\Exceptions\FileNotFoundException  If file was not found.
     * @throws \UnexpectedValueException                If the content of config
     *                                                  file is not a array.
     */
    protected function getConfigFileContents($fileName): array
    {
        $fileName = PathHelper::join([
            $this->getConfigDirectoryPath(),
            $fileName . '.php',
        ]);

        if (! file_exists($fileName)) {
            throw new FileNotFoundException($fileName);
        }

        $config = require $fileName;

        if (! is_array($config)) {
            throw new UnexpectedValueException('The value of "' .
                $fileName . '" config file is inválid.');
        }

        return $config;
    }

    /**
     * Get configuration from config from array file using the configKey.
     *
     * @param string $configPath    The dot string key to access config.
     *                              Ex.: "fileName.arrayKeyOne.arrayKeyTwo"
     *                                      => configDirectory/fileName.php
     *                                      -> [ 'arrayKeyOne' => [
     *                                              'arrayKeyTwo' =>
     *                                                  'Wanted data'
     *                                          ] ]
     *
     * @return mixed    The value stored into specified "config path"
     *
     * @throws \InvalidArgumentException    If $configPath is not a vlaid doted
     *                                      key.
     *                                      Ex.: "one.two.tree"
     * @throws \InvalidArgumentException    If fileName passed in $configPath
     *                                      is invalid.
     * @throws \Utils\Exceptions\FileNotFoundException  If file was not found.
     * @throws \UnexpectedValueException                If the content of config
     *                                                  file is not a array.
     */
    protected function getConfig(string $configPath): mixed
    {
        $configAccess = $this->handlerConfigPath($configPath);

        if (! isset($this->configs[$configAccess->file])) {
            $this->configs[$configAccess->file] = $this->getConfigFileContents(
                $configAccess->file
            );
        }

        return ArrayHelper::keyDotAccess(
            $configAccess->configKey,
            $this->configs[$configAccess->file]
        );
    }

    /**
     * Get configuration from config from array file using the configKey.
     *
     * @param string $configPath    The dot string key to access config.
     *                              Ex.: "fileName.arrayKeyOne.arrayKeyTwo"
     *                                      => configDirectory/fileName.php
     *                                      -> [ 'arrayKeyOne' => [
     *                                              'arrayKeyTwo' =>
     *                                                  'Wanted data'
     *                                          ] ]
     *
     * @return mixed    The value stored into specified "config path"
     *
     * @throws \InvalidArgumentException    If $configPath is not a valid
     *                                      doted key.
     *                                      Ex.: "one.two.tree"
     * @throws \InvalidArgumentException    If fileName passed in $configPath
     *                                      is invalid.
     * @throws \Utils\Exceptions\FileNotFoundException  If file was not found.
     * @throws \UnexpectedValueException                If the content of
     *                                                  config file is not a
     *                                                  array.
     */
    public static function get(string $configPath): mixed
    {
        return static::getInstance()->getConfig($configPath);
    }
}
