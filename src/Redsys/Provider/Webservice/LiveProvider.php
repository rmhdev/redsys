<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Provider\Webservice;

use Redsys\Provider\AbstractProvider;
use Redsys\Provider\ProviderInterface;

class LiveProvider extends AbstractProvider implements ProviderInterface
{
    const ENDPOINT_URL = "https://sis.redsys.es/sis/services/SerClsWSEntrada";

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return self::ENDPOINT_URL;
    }
}
