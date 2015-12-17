<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Security\authentication;

use Redsys\ParameterBag\Request;
use Redsys\Security\Authentication\HmacSha256V1;

class HmacSha256V1Test extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnString()
    {
        $authentication = new HmacSha256V1();

        $this->assertEquals("HMAC_SHA256_V1", $authentication->getName());
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

    public function testHashShouldReturnString()
    {
        $authentication = new HmacSha256V1($this->secretKey());
        $parameterBag = new Request($this->getParameters());

        $this->assertEquals("92PEXmdhI3TXMAYDW/ZG1Q594NirKIWaUmWUO9DcC8U=", $authentication->hash($parameterBag));
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
