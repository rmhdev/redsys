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
    private $value;

    public function __construct($value)
    {
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
