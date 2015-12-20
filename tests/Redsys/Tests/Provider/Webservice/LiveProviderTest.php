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
use Redsys\Provider\Webservice\LiveProvider as Provider;

class LiveProvider extends \PHPUnit_Framework_TestCase
{
    public function testGetAdapterShouldReturnHttpAdapter()
    {
        $adapter = new Guzzle6HttpAdapter(
            new Client(array(
                "handler" => new CurlHandler()
            ))
        );
        $provider = new Provider($adapter);

        $this->assertEquals($adapter, $provider->getAdapter());
    }
}
