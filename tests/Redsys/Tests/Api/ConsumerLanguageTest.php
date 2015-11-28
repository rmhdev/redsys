<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\ConsumerLanguage;

class ConsumerLanguageTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $lang = new ConsumerLanguage();

        $this->assertEquals(0, $lang->getValue());
    }

    /**
     * @dataProvider availableValues
     */
    public function testGetValueShouldReturnValue($value)
    {
        $lang = new ConsumerLanguage($value);

        $this->assertEquals($value, $lang->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $lang = new ConsumerLanguage("011");

        $this->assertEquals("011", (string)$lang);
    }

    public function availableValues()
    {
        return array(
            array("001"),
            array("002"),
            array("003"),
            array("004"),
            array("005"),
            array("006"),
            array("007"),
            array("008"),
            array("009"),
            array("010"),
            array("011"),
            array("012"),
            array("013"),
        );
    }

    public function testAvailableValuesShouldReturnList()
    {
        $values = array_map(function ($item) {
            return $item[0];
        }, $this->availableValues());

        $this->assertEquals($values, ConsumerLanguage::availableValues());
    }

    /**
     * @dataProvider invalidValues
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidValueShouldThrowException($value)
    {
        new ConsumerLanguage($value);
    }

    public function invalidValues()
    {
        return array(
            array("014"),
            array(1),
            array("lorem"),
        );
    }
}
