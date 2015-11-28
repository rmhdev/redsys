<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\TransactionType;

class TransactionTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider availableTypes
     */
    public function testGetValueShouldReturnValue($value)
    {
        $transactionType = new TransactionType($value);

        $this->assertEquals($value, $transactionType->getValue());
    }

    public function availableTypes()
    {
        return array(
            array(0),
            array(1),
            array(2),
            array(3),
            array(5),
            array(6),
            array(7),
            array(8),
            array(9),
            array("O"),
            array("P"),
            array("Q"),
            array("R"),
            array("S")
        );
    }

    public function testAvailableTypesShouldReturnArray()
    {
        $this->assertEquals(array(
            0, 1, 2, 3, 5, 6, 7, 8, 9, "O", "P", "Q", "R", "S"
        ), TransactionType::availableTypes());
    }

    public function testToStringShouldReturnStringValue()
    {
        $transactionType = new TransactionType(2);

        $this->assertEquals("2", (string)$transactionType);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new TransactionType("ab");
    }

    /**
     * @dataProvider unexpectedValues
     * @expectedException \UnexpectedValueException
     * @param mixed $value
     */
    public function testUnexpectedValueShouldReturnException($value)
    {
        new TransactionType($value);
    }

    public function unexpectedValues()
    {
        return array(
            array("4"),
            array("T"),
        );
    }

    public function testCorrectLowerCaseTypesShouldBeAccepted()
    {
        $transactionType = new TransactionType("p");

        $this->assertEquals("P", $transactionType->getValue());
    }
}
