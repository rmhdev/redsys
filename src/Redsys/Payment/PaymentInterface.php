<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment;

interface PaymentInterface
{
    /**
     * @return array
     */
    public function toArray();

    /**
     * @param string $name
     * @param mixed $default
     * @return string
     */
    public function get($name, $default = null);

    /**
     * @return array
     */
    public function customParameters();

    /**
     * @return bool
     */
    public function hasCustomParameters();

    /**
     * @return array
     */
    public static function defaultFields();
}
