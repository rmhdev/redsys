<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Provider\Webservice;

use Http\Adapter\HttpAdapter;
use Redsys\Provider\Webservice\SandboxProvider as Provider;

class SandboxProvider extends AbstractProviderTest
{
    /**
     * @inheritdoc
     */
    protected function expectedUrl()
    {
        return "https://sis-t.redsys.es:25443/sis/services/SerClsWSEntrada";
    }

    /**
     * @inheritdoc
     */
    protected function createProvider(HttpAdapter $adapter)
    {
        return new Provider($adapter);
    }
}
