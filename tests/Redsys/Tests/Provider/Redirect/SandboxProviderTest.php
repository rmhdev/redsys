<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Provider\Redirect;

use Http\Adapter\HttpAdapter;
use Redsys\Provider\Redirect\SandboxProvider as Provider;
use Redsys\Tests\Provider\Webservice\AbstractProviderTest;

class SandboxProvider extends AbstractProviderTest
{
    /**
     * @inheritdoc
     */
    protected function expectedUrl()
    {
        return "https://sis-t.redsys.es:25443/sis/realizarPago";
    }

    /**
     * @inheritdoc
     */
    protected function createProvider(HttpAdapter $adapter)
    {
        return new Provider($adapter);
    }
}
