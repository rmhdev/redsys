<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\Titular;

class TitularTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $titular = new Titular("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", $titular->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $titular = new Titular("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", (string)$titular);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new Titular(str_repeat("abcdefghij", 6) . "z");
    }
}
