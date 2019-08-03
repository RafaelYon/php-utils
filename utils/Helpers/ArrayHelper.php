<?php

declare(strict_types=1);

namespace Utils\Helpers;

class ArrayHelper
{
    protected function __construct()
    {
    }

    /**
     * Access nested array data by dot key string.
     * levelOne.levelTwo => [ 'levelOne' => [ 'levelTwo' => 'Wanted data' ] ]
     *
     * @param string        $key    The dot key string.
     * @param array         $source The array source.
     *
     * @return mixed|null   Return null if $source not include wanted data.
     *                      Or return the wanted data stored in array.
     */
    public static function keyDotAccess(string $key, array $source)
    {
        $keys = explode('.', $key);

        $result = $source;

        foreach ($keys as $key) {
            if (! isset($result[$key])) {
                return null;
            }

            $result = $result[$key];
        }

        return $result;
    }

    /**
     * Get all array data except some data in specified keys.
     *
     * @param array     $source     The array source.
     * @param array     $exceptKeys The expect array keys.
     *
     * @return array    Return the $source array without data in stored in
     *                  keys specified in $exceptKeys.
     */
    public static function except(array $source, array $exceptKeys): array
    {
        foreach ($exceptKeys as $key) {
            unset($source[$key]);
        }

        return $source;
    }

    /**
     * Get array data stored in specific keys from source array.
     * The array keys are keep.
     *
     * @param array     $source The array source
     * @param array     $keys   The wanted data keys.
     *
     * @return array    Return the data stored in the $keys from the $source.
     */
    public static function only(array $source, array $keys): array
    {
        $result = [];

        foreach ($keys as $key) {
            if (! isset($source[$key])) {
                continue;
            }

            $result[$key] = $source[$key];
        }

        return $result;
    }
}
