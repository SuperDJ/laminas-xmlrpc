<?php

/**
 * @see       https://github.com/laminas/laminas-xmlrpc for the canonical source repository
 * @copyright https://github.com/laminas/laminas-xmlrpc/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-xmlrpc/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\XmlRpc\Client;

use Laminas\XmlRpc\Client as XMLRPCClient;

use function ltrim;

/**
 * The namespace decorator enables object chaining to permit
 * calling XML-RPC namespaced functions like "foo.bar.baz()"
 * as "$remote->foo->bar->baz()".
 */
class ServerProxy
{
    /** @var XMLRPCClient */
    private $client;

    /** @var string */
    private $namespace = '';

    /** @var array of \Laminas\XmlRpc\Client\ServerProxy */
    private $cache = [];

    /**
     * @param string             $namespace
     */
    public function __construct(XMLRPCClient $client, $namespace = '')
    {
        $this->client    = $client;
        $this->namespace = $namespace;
    }

    /**
     * Get the next successive namespace
     *
     * @param string $namespace
     * @return ServerProxy
     */
    public function __get($namespace)
    {
        $namespace = ltrim("$this->namespace.$namespace", '.');
        if (! isset($this->cache[$namespace])) {
            $this->cache[$namespace] = new $this($this->client, $namespace);
        }
        return $this->cache[$namespace];
    }

    /**
     * Call a method in this namespace.
     *
     * @param  string $method
     * @param  array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        $method = ltrim("{$this->namespace}.{$method}", '.');
        return $this->client->call($method, $args);
    }
}
