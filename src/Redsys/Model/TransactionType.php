<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

class TransactionType
{
    private $value;

    public function __construct($value)
    {
        if (strlen($value) > 1) {
            throw new \LengthException(sprintf(
                'Transaction type must be a character, "%s" received',
                $value
            ));
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
