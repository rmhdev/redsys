<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\MerchantName;

class MerchantNameTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $titular = new MerchantName("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", $titular->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $titular = new MerchantName("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", (string)$titular);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new MerchantName(str_repeat("abcde", 5) . "z");
    }
}
