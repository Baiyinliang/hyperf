<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Hyperf\Utils\Coordinator;

class CoordinatorManager
{
    /**
     * A container that use to store coordinator.
     *
     * @var array
     */
    private static $container = [];

    /**
     * You should initialize a Coordinator with the identifier before use it.
     */
    public static function initialize(string $identifier): void
    {
        static::$container[$identifier] = new Coordinator();
    }

    /**
     * Get a coordinator from container by the identifier.
     *
     * @throws \RuntimeException when the Lock with the identifier has not initialization
     */
    public static function get(string $identifier): Coordinator
    {
        if (! isset(static::$container[$identifier])) {
            static::$container[$identifier] = new Coordinator();
        }

        return static::$container[$identifier];
    }

    /**
     * Remove the coordinator by the identifier from container after used,
     * otherwise memory leaks will occur.
     */
    public static function clear(string $identifier): void
    {
        unset(static::$container[$identifier]);
    }
}
