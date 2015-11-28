<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\CardType;

class CardTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider availableValues
     */
    public function testGetValueShouldReturnValue($value)
    {
        $type = new CardType($value);

        $this->assertEquals($value, $type->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $type = new CardType("D");

        $this->assertEquals("D", (string)$type);
    }

    /**
     * @dataProvider invalidValues
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidUrlShouldThrowException($value)
    {
        new CardType($value);
    }

    public function invalidValues()
    {
        return array(
            array("B"),
            array("lorem"),
        );
    }

    public function availableValues()
    {
        return array(
            array("C"),
            array("D"),
        );
    }

    public function testAvailableValuesShouldReturnList()
    {
        $values = array_map(function ($item) {
            return $item[0];
        }, $this->availableValues());

        $this->assertEquals($values, CardType::availableValues());
    }
}
