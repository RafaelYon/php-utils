<?php

declare(strict_types=1);

namespace Utils\Patterns;

abstract class Singleton
{
    /**
     * Get instance the unique instance of class.
     *
     * @return \Utils\Patterns\Singleton
     */
    public static function getInstance(): self
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * The construct method is setted as protected for prevent
     * external instances.
     */
    protected function __construct()
    {
    }

    /**
     * This method is setted as protected for prevent external calls.
     */
    protected function __clone()
    {
    }

    /**
     * This method is stted as protected fro prevent externall calls.
     */
    protected function __wakeup()
    {
    }
}
