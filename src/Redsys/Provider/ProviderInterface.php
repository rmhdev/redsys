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

interface ProviderInterface
{
    /**
     * @return HttpAdapter
     */
    public function getAdapter();

    /**
     * @return string
     */
    public function getUrl();
}
