<?php

/**
 * @see       https://github.com/laminas/laminas-xmlrpc for the canonical source repository
 * @copyright https://github.com/laminas/laminas-xmlrpc/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-xmlrpc/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\XmlRpc\Server\TestAsset;

use Laminas\XmlRpc\Server\Fault;

class Observer
{
    /** @var self|null */
    private static $instance;

    /** @var array */
    public $observed = [];

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (! static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    public static function observe(Fault $fault): void
    {
        self::getInstance()->observed[] = $fault;
    }

    public static function clearObserved(): void
    {
        self::getInstance()->observed = [];
    }

    public static function getObserved(): array
    {
        return self::getInstance()->observed;
    }
}
