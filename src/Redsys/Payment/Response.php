<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment;

final class Response
{
    /**
     * @var array
     */
    private $parameters;

    public function __construct($parameters = array())
    {
        $this->parameters = $parameters;
    }


    public function toArray()
    {
        return $this->parameters;
    }
}
