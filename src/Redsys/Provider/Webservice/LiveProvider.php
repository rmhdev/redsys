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

class LiveProvider
{
    private $adapter;

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
}
