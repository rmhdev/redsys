<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

class TransactionType implements ModelInterface
{
    const AUTHORIZATION = "0";
    const PRE_AUTHORIZATION = "1";
    const PRE_AUTHORIZATION_CONFIRMED = "2";
    const AUTOMATIC_REFUND = "3";
    const RECURRENT_TRANSACTION = "5";
    const SUCCESSIVE_TRANSACTION = "6";
    const PRE_AUTHENTICATION = "7";
    const PRE_AUTHENTICATION_CONFIRMED = "8";
    const PRE_AUTHORIZATION_REVOKED = "9";
    const DEFERRED_AUTHORIZATION = "O";
    const DEFERRED_AUTHORIZATION_CONFIRMED = "P";
    const DEFERRED_AUTHORIZATION_REVOKED = "Q";
    const DEFERRED_INITIAL_FEE = "R";
    const DEFERRED_SUCCESSIVE_FEE = "S";

    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        if (strlen($value) > 1) {
            throw new \LengthException(sprintf(
                'Transaction type must be a character, "%s" received',
                $value
            ));
        }
        $checkValue = is_numeric($value) ? $value : strtoupper($value);
        if (!in_array($checkValue, self::availableTypes())) {
            throw new \UnexpectedValueException(sprintf('Value %s is not a valid type', $value));
        }
        $this->value = (string)$checkValue;
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

    /**
     * @return array
     */
    public static function availableTypes()
    {
        return array(
            self::AUTHORIZATION,
            self::PRE_AUTHORIZATION,
            self::PRE_AUTHORIZATION_CONFIRMED,
            self::AUTOMATIC_REFUND,
            self::RECURRENT_TRANSACTION,
            self::SUCCESSIVE_TRANSACTION,
            self::PRE_AUTHENTICATION,
            self::PRE_AUTHENTICATION_CONFIRMED,
            self::PRE_AUTHORIZATION_REVOKED,
            self::DEFERRED_AUTHORIZATION,
            self::DEFERRED_AUTHORIZATION_CONFIRMED,
            self::DEFERRED_AUTHORIZATION_REVOKED,
            self::DEFERRED_INITIAL_FEE,
            self::DEFERRED_SUCCESSIVE_FEE,
        );
    }
}
