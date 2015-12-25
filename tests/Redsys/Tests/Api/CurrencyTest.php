<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\Currency;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnGivenNumber()
    {
        $currency = new Currency(978);

        $this->assertEquals(978, $currency->getValue());
    }

    /**
     * @dataProvider incorrectValues()
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrectValueShouldThrowException($value)
    {
        new Currency($value);
    }

    public function incorrectValues()
    {
        return array(
            array("test"),
            array(1.12),
            array(0),
            array(10000),
        );
    }
}
