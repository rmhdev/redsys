<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\Currency;
use Redsys\Api\Money;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAmountShouldReturnGivenNumber()
    {
        $money = new Money(123.45, Currency::createEuro());

        $this->assertEquals(123.45, $money->getAmount());
    }

    public function testGetCurrencyShouldReturnGivenCurrency()
    {
        $currency = Currency::createEuro();
        $money = new Money(123, $currency);

        $this->assertEquals($currency, $money->getCurrency());
    }

    public function testToStringEurosShouldReturnSpeciallyFormattedAmount()
    {
        $currency = Currency::createEuro();
        $money = new Money(123, $currency);

        $this->assertEquals("12300", (string)$money);
    }

    public function testToStringNonEurosShouldReturnAmount()
    {
        $money = new Money(123, new Currency(840));

        $this->assertEquals("123", (string)$money);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider incorrectValues()
     * @param $value
     */
    public function testIncorrectAmountShouldThrowException($value)
    {
        new Money($value, Currency::createEuro());
    }

    public function incorrectValues()
    {
        return array(
            array(-1),
            array("test"),
            array(0x01),
        );
    }
}
