<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Provider\Webservice;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use Http\Adapter\Guzzle6HttpAdapter;
use Http\Adapter\HttpAdapter;
use Redsys\Provider\Webservice\SandboxProvider as Provider;

class SandboxProvider extends \PHPUnit_Framework_TestCase
{
    public function testGetAdapterShouldReturnHttpAdapter()
    {
        $adapter = $this->createAdapter();
        $provider = $this->createProvider($adapter);

        $this->assertEquals($adapter, $provider->getAdapter());
    }

    public function testGetUrlShouldReturnUrl()
    {
        $provider = $this->createProvider($this->createAdapter());

        $this->assertEquals(
            "https://sis-t.redsys.es:25443/sis/services/SerClsWSEntrada",
            $provider->getUrl()
        );
    }

    protected function createAdapter()
    {
        return new Guzzle6HttpAdapter(
            new Client(array(
                "handler" => new CurlHandler()
            ))
        );
    }

    protected function createProvider(HttpAdapter $adapter)
    {
        return new Provider($adapter);
    }
}
