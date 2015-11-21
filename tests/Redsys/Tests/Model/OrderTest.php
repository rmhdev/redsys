<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\Order;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnStringValue()
    {
        $order = new Order("1234aBc123");

        $this->assertEquals("1234aBc123", $order->getValue());
    }

    /**
     * @dataProvider orderValues
     */
    public function testOrderShouldCleanReceivedValue($expected, $code)
    {
        $merchantCode = new Order($code);

        $this->assertEquals($expected, $merchantCode->getValue());
    }

    public function orderValues()
    {
        return array(
            array("1234aBc123", "123 4a Bc123"),
            array("1234aBc123", "\t1234aBc123\n"),
        );
    }

    public function testToStringShouldReturnStringValue()
    {
        $order = new Order(4567890);

        $this->assertEquals("4567890", (string)$order);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongCodeShouldThrowException()
    {
        new Order("1234567890123");
    }
}
