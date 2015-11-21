<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

final class CardCountry implements ModelInterface
{
    const LENGTH = 3;

    /**
     * @var string
     */
    private $value;

    public function __construct($value)
    {
        if (!is_numeric($value)) {
            throw new \UnexpectedValueException(
                sprintf('Value "%s" is not numeric', $value)
            );
        }
        $length = strlen($value);
        if (self::LENGTH != $length) {
            throw new \LengthException(
                sprintf('Card country length (%d) must be (%d)', $length, self::LENGTH)
            );
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
