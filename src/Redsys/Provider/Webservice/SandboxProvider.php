<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Provider\Webservice;

use Http\Adapter\HttpAdapter;

class SandboxProvider
{
    const ENDPOINT_URL = "https://sis-t.redsys.es:25443/sis/services/SerClsWSEntrada";

    /**
     * @var HttpAdapter
     */
    private $adapter;

    /**
     * @param HttpAdapter $adapter
     */
    public function __construct(HttpAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return HttpAdapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    public function getUrl()
    {
        return self::ENDPOINT_URL;
    }
}
