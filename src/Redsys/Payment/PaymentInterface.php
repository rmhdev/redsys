<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment;

interface PaymentInterface extends \IteratorAggregate, \Countable
{
    /**
     * @param string $name
     * @param mixed $default
     * @return string
     */
    public function get($name, $default = null);

    /**
     * @param $name
     * @return bool
     */
    public function has($name);

    /**
     * @return array
     */
    public function all();

    /**
     * @return array
     */
    public function keys();

    /**
     * @return array
     */
    public function custom();

    /**
     * @return bool
     */
    public function hasCustom();

    /**
     * @return array
     */
    public static function defaultFields();
}
