<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Api;

final class Currency
{
    const EUR = 978;

    private $value;

    public function __construct($code)
    {
        if (!is_int($code) || $this->isOutOfBounds($code)) {
            throw new \InvalidArgumentException("Currency id should be greater than 0");
        }
        $this->value = (int)$code;
    }

    private function isOutOfBounds($code)
    {
        return ($code < 1 || $code > 9999);
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return self
     */
    public static function createEuro()
    {
        return new self(self::EUR);
    }
}
