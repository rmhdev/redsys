<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\Date;

class DateTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $date = new Date("2015-11-21");
        $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", "2015-11-21 00:00:00");

        $this->assertEquals($dateTime, $date->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $date = new Date("2015-11-21");

        $this->assertEquals("2015-11-21", (string)$date);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new Date("2015-11-21 12:00:00");
    }

    /**
     * @dataProvider invalidValues
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidDateShouldThrowException($value)
    {
        new Date($value);
    }

    public function invalidValues()
    {
        return array(
            array("lorem"),
            array("21/11/2015"),
        );
    }
}
