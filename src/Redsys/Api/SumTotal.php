<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Api;

final class SumTotal implements ApiInterface
{
    const MAX_LENGTH = 12;

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
        if (self::MAX_LENGTH < $length) {
            throw new \LengthException(
                sprintf('Sum total length (%d) exceeds max (%d)', $length, self::MAX_LENGTH)
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
