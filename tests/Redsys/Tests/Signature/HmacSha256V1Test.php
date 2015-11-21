<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Signature;

use Redsys\Signature\HmacSha256V1;

class HmacSha256V1Test extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnString()
    {
        $signature = new HmacSha256V1();

        $this->assertEquals("HMAC_SHA256_V1", $signature->getName());
    }

    public function testParseParametersShouldReturnCodifiedString()
    {
        $signature = new HmacSha256V1();

        $parameters = array(
            "DS_MERCHANT_AMOUNT" => "145",
            "DS_MERCHANT_ORDER" => "1234qwerty",
            "DS_MERCHANT_MERCHANTCODE" => "999008881",
            "DS_MERCHANT_CURRENCY" => "978",
            "DS_MERCHANT_TRANSACTIONTYPE" => "0",
            "DS_MERCHANT_TERMINAL" => "871",
            "DS_MERCHANT_MERCHANTURL" => "",
            "DS_MERCHANT_URLOK" => "",
            "DS_MERCHANT_URLKO" => "",
        );

        $this->assertEquals(
            base64_encode(json_encode($parameters)),
            $signature->parseParameters($parameters)
        );
    }
}
