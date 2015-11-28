<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\DateFrequency;

class DateFrequencyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $frequency = new DateFrequency("7");

        $this->assertEquals("7", $frequency->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $frequency = new DateFrequency("5");

        $this->assertEquals("5", (string)$frequency);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new DateFrequency(123456);
    }

    // TODO: only numeric values?
}
