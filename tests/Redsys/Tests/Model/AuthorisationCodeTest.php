<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\AuthorisationCode;

class AuthorisationCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnStringValue()
    {
        $code = new AuthorisationCode("qwerty");

        $this->assertEquals("qwerty", $code->getValue());
    }

    public function testToStringShouldReturnStringValue()
    {
        $code = new AuthorisationCode("qwerty");

        $this->assertEquals("qwerty", (string)$code);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongCodeShouldThrowException()
    {
        new AuthorisationCode("1234567");
    }
}
