<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Webservice;

class Notification
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $response;

    /**
     * @param string $key
     * @param string $response
     */
    public function __construct($key, $response = "")
    {
        $this->key = $key;
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function toArray()
    {
        return array();
    }
}
