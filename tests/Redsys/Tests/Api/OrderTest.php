<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\Order;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validValues
     */
    public function testGetValueShouldReturnStringValue($value)
    {
        $order = new Order($value);

        $this->assertEquals($value, $order->getValue());
    }

    public function validValues()
    {
        return array(
            array("1234aBc123"),
            //array("1234"),
        );
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

    /**
     * @dataProvider invalidValues
     * @expectedException \UnexpectedValueException
     */
    public function testNonNumericFirstPartOfValueShouldThrowException($value)
    {
        new Order($value);
    }

    public function invalidValues()
    {
        return array(
            array("a123aaaaaa"),
            array("123a3aaaa"),
            array("1232aaañaa"),
        );
    }
}
