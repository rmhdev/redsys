<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Security\Signature;

use Redsys\Security\Signature\HmacSha256V1;

class HmacSha256V1Test extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnString()
    {
        $signature = new HmacSha256V1();

        $this->assertEquals("HMAC_SHA256_V1", $signature->getName());
    }

    public function testEncodeShouldReturnCodifiedString()
    {
        $signature = new HmacSha256V1();
        $parameters = $this->getParameters();

        $this->assertEquals(
            $this->rawEncode($parameters),
            $signature->encode($parameters)
        );
    }

    private function getParameters()
    {
        return array(
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
    }

    private function rawEncode($parameters = array())
    {
        return base64_encode(json_encode($parameters));
    }

    public function testDecodeShouldReturnArray()
    {
        $signature = new HmacSha256V1();
        $parameters = $this->getParameters();
        $encoded = $this->rawEncode($parameters);

        $this->assertEquals($parameters, $signature->decode($encoded));
    }

    public function testEncodeShouldReturnSameResultWithDifferentSecretKeys()
    {
        $parameters = $this->getParameters();
        $signatureA = new HmacSha256V1();
        $signatureB = new HmacSha256V1("loremipsum");

        $this->assertEquals(
            $signatureA->encode($parameters),
            $signatureB->encode($parameters)
        );
    }

    public function testDecodeShouldReturnSameResultWithDifferentSecretKeys()
    {
        $encoded = $this->rawEncode($this->getParameters());
        $signatureA = new HmacSha256V1();
        $signatureB = new HmacSha256V1("loremipsum");

        $this->assertEquals(
            $signatureA->decode($encoded),
            $signatureB->decode($encoded)
        );
    }

    public function testHashShouldReturnString()
    {
        $signature = new HmacSha256V1($this->secretKey());
        $parameters = $this->getParameters();
        $encoded = $signature->encode($this->getParameters());


        //$this->assertEquals("j5o68y9T6XrmOWRhTHWW6RDkiMiJjUSqpUHpH5bh008=", $signature->hash($encoded));
    }

    /**
     * value taken from documentation
     * @return string
     */
    protected function secretKey()
    {
        return "Mk9m98IfEblmPfrpsawt7BmxObt98Jev";
    }
}
