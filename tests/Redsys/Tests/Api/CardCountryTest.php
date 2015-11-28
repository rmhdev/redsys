<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\CardCountry;

class CardCountryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $country = new CardCountry("724");

        $this->assertEquals("724", $country->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $country = new CardCountry(250);

        $this->assertEquals("250", (string)$country);
    }

    /**
     * @expectedException \LengthException
     */
    public function testIncorrectShouldThrowException()
    {
        new CardCountry("4");
    }

    /**
     * @dataProvider invalidValues
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidValueShouldThrowException($value)
    {
        new CardCountry($value);
    }

    public function invalidValues()
    {
        return array(
            array("lorem"),
        );
    }
}
