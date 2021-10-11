<?php

/**
 * @see       https://github.com/laminas/laminas-xmlrpc for the canonical source repository
 * @copyright https://github.com/laminas/laminas-xmlrpc/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-xmlrpc/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\XmlRpc;

use Laminas\XmlRpc\Generator;

abstract class AbstractTestProvider
{
    public static function provideGenerators(): array
    {
        return [
            [new Generator\DomDocument()],
            [new Generator\XmlWriter()],
        ];
    }

    public static function provideGeneratorsWithAlternateEncodings(): array
    {
        return [
            [new Generator\DomDocument('ISO-8859-1')],
            [new Generator\XmlWriter('ISO-8859-1')],
        ];
    }
}
