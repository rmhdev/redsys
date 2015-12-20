<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction;

abstract class AbstractNotification implements NotificationInterface
{
    /**
     * @var mixed
     */
    private $response;

    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     * @param mixed $response
     */
    public function __construct($key, $response = null)
    {
        $this->response = $response;
        $this->key = $key;
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }

    protected function getKey()
    {
        return $this->key;
    }
}
