<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

class Url
{
    const MAX_LENGTH = 250;

    private $value;

    public function __construct($value)
    {
        $length = strlen($value);
        if (self::MAX_LENGTH < $length) {
            throw new \LengthException(
                sprintf('Url length (%d) exceeds max (%d)', $length, self::MAX_LENGTH)
            );
        }
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            throw new \UnexpectedValueException(
                sprintf('Url "%s" is invalid', $value)
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

    public function __toString()
    {
        return $this->getValue();
    }
}
