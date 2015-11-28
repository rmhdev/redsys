<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Api;

final class CardCountry implements ApiInterface
{
    const LENGTH = 3;

    /**
     * @var string
     */
    private $value;

    /**
     * CardCountry constructor.
     * @param string $value  ISO 3166-1 numeric value
     * @url https://en.wikipedia.org/wiki/ISO_3166-1_numeric
     */
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
