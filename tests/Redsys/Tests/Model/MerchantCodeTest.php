<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\MerchantCode;

class MerchantCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCodeShouldReturnStringValue()
    {
        $code = "qwertyuio";
        $merchantCode = new MerchantCode($code);

        $this->assertEquals($code, $merchantCode->getCode());
    }

    public function testToStringShouldReturnStringValue()
    {
        $code = "abcdefghi";
        $merchantCode = new MerchantCode($code);

        $this->assertEquals($code, (string)$merchantCode);
    }

    /**
     * @dataProvider merchantCodes
     */
    public function testMerchantCodeShouldCleanReceivedCode($expected, $code)
    {
        $merchantCode = new MerchantCode($code);

        $this->assertEquals($expected, (string)$merchantCode);
    }

    public function merchantCodes()
    {
        return array(
            array("123456789", "123 456 789"),
            array("123456789", "\t123456789\n"),
        );
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongCodeShouldThrowException()
    {
        new MerchantCode("1234567890");
    }
}
