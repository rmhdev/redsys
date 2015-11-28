<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Api;

class Date implements ApiInterface
{
    const MAX_LENGTH = 10;

    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $length = strlen($value);
        if (self::MAX_LENGTH < $length) {
            throw new \LengthException(
                sprintf('Date value "%s", length exceeds max (%d)', $value, self::MAX_LENGTH)
            );
        }
        if (preg_match('/(\d{4})-(\d{2})-(\d{2})/', $value) !== 1) {
            throw new \UnexpectedValueException("Unexpected date");
        }
        $this->value = \DateTime::createFromFormat("Y-m-d H:i:s", "{$value} 00:00:00");
    }

    /**
     * @return \DateTime
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
        return $this->getValue()->format("Y-m-d");
    }
}
