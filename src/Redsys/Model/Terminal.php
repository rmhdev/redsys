<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

final class Terminal implements ModelInterface
{
    const MAX_LENGTH = 3;

    private $value;

    public function __construct($value)
    {
        $value = str_replace(" ", "", trim($value));
        $length = strlen($value);
        if (self::MAX_LENGTH < $length) {
            throw new \LengthException(
                sprintf('Max terminal value length is %d, but "%s" code is %d', self::MAX_LENGTH, $value, $length)
            );
        }
        $this->value = (string)$value;
    }

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
