<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

final class CardType implements ModelInterface
{
    const DEBIT = "D";
    const CREDIT = "C";

    /**
     * @var string
     */
    private $value;

    public function __construct($value)
    {
        $processedValue = strtoupper($value);
        if (!in_array($processedValue, self::availableValues(), true)) {
            throw new \UnexpectedValueException(
                sprintf('Card type "%s" is not available', $value)
            );
        }
        $this->value = $processedValue;
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

    public static function availableValues()
    {
        return array(
            self::CREDIT,
            self::DEBIT,
        );
    }
}
