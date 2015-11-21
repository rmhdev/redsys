<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\SumTotal;

class SumTotalTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $total = new SumTotal("10025");

        $this->assertEquals("10025", $total->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $total = new SumTotal("10025");

        $this->assertEquals("10025", (string)$total);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new SumTotal("1234567890123");
    }

    /**
     * @dataProvider invalidValues
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidDateShouldThrowException($value)
    {
        new SumTotal($value);
    }

    public function invalidValues()
    {
        return array(
            array("lorem"),
            array("123abc456"),
        );
    }
}
