<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Security\Signature;

use Redsys\ParameterBag\Request;
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
            "Ds_Merchant_Amount" => "145",
            "Ds_Merchant_Order" => "1234qwerty",
            "Ds_Merchant_MerchantCode" => "999008881",
            "Ds_Merchant_Currency" => "978",
            "Ds_Merchant_TransactionType" => "0",
            "Ds_Merchant_Terminal" => "871",
            "Ds_Merchant_MerchantURL" => "",
            "Ds_Merchant_UrlOK" => "",
            "Ds_Merchant_UrlKO" => "",
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
        $parameterBag = new Request($this->getParameters());

        $this->assertEquals("92PEXmdhI3TXMAYDW/ZG1Q594NirKIWaUmWUO9DcC8U=", $signature->hash($parameterBag));
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
