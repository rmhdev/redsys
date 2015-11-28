<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Api;

use Redsys\Api\MerchantData;

class MerchantDataTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $data = new MerchantData("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", $data->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $data = new MerchantData("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", (string)$data);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new MerchantData(str_repeat("abcdefghij", 102) . "zzzzz");
    }
}
