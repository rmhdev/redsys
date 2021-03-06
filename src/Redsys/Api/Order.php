<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Api;

class Order implements ApiInterface
{
    const MAX_LENGTH = 12;

    private $value;

    /**
     * Order constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $value = str_replace(" ", "", trim($value));
        $length = strlen($value);
        if (self::MAX_LENGTH < $length) {
            throw new \LengthException(
                sprintf('Code "%s" is too long (%d), max is %d', $value, $length, self::MAX_LENGTH)
            );
        }
        if (preg_match('/(\d{4})([a-zA-Z0-9]+$)/', $value) !== 1) {
            throw new \UnexpectedValueException(sprintf('Order value "%s" is incorrect', $value));
        }
        $this->value = (string)$value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
