<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\Terminal;

class TerminalTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnStringValue()
    {
        $terminal = new Terminal("123");

        $this->assertEquals("123", $terminal->getValue());
    }

    /**
     * @dataProvider terminalValues
     */
    public function testTerminalShouldCleanReceivedValue($expected, $code)
    {
        $merchantCode = new Terminal($code);

        $this->assertEquals($expected, $merchantCode->getValue());
    }

    public function terminalValues()
    {
        return array(
            array("123", " 1 2 3 "),
            array("987", "\t987\n"),
        );
    }

    public function testToStringShouldReturnStringValue()
    {
        $merchantCode = new Terminal(456);

        $this->assertEquals("456", (string)$merchantCode);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new Terminal("1234");
    }
}
