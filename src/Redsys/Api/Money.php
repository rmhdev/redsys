<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Api;

final class Money
{
    /**
     * @var number
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @param $amount
     * @param Currency $currency
     */
    public function __construct($amount, Currency $currency)
    {
        if (!is_numeric($amount)) {
            throw new \InvalidArgumentException(sprintf('Amount "%s" is not numeric', $amount));
        }
        if ($amount < 0) {
            throw new \InvalidArgumentException(sprintf('Amount "%s" can not be negative', $amount));
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (Currency::EUR === $this->getCurrency()->getValue()) {
            return sprintf("%d", $this->amount * 100);
        }

        return (string)$this->getAmount();
    }
}
