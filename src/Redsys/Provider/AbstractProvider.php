<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Provider;

use Http\Adapter\HttpAdapter;

abstract class AbstractProvider implements ProviderInterface
{
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
     * @inheritdoc
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
