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
use Redsys\Provider\Webservice\LiveProvider as Provider;

class LiveProvider extends AbstractProviderTest
{
    /**
     * @inheritdoc
     */
    protected function expectedUrl()
    {
        return "https://sis.redsys.es/sis/services/SerClsWSEntrada";
    }

    /**
     * @inheritdoc
     */
    protected function createProvider(HttpAdapter $adapter)
    {
        return new Provider($adapter);
    }
}
