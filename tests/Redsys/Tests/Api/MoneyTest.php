<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\Money;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAmountShouldReturnGivenNumber()
    {
        $money = new Money(123, 978);

        $this->assertEquals(123, $money->getAmount());
    }

    public function testGetCurrencyShouldReturnGivenNumber()
    {
        $money = new Money(123, 978);

        $this->assertEquals(978, $money->getCurrency());
    }
}
