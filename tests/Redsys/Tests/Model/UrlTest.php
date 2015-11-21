<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\Url;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $unit = new Url("http://www.example.com");

        $this->assertEquals("http://www.example.com", $unit->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $unit = new Url("http://www.example.com");

        $this->assertEquals("http://www.example.com", (string)$unit);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new Url(str_repeat("1234567890", 25) . "a");
    }

    /**
     * @dataProvider invalidValues
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidUrlShouldThrowException($value)
    {
        new Url($value);
    }

    public function invalidValues()
    {
        return array(
            array("lorem.ipsum"),
            array("http:/nonono"),
        );
    }
}
