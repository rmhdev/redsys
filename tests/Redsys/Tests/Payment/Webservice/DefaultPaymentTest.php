<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment\Webservice;

use Redsys\ParameterBag\Webservice\Request as ParameterBag;
use Redsys\Payment\Webservice\DefaultPayment as Payment;
use Redsys\Security\Authentication\AuthenticationFactory;

class DefaultPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAuthenticationShouldReturnObject()
    {
        $parameterBag = $this->createParameterBag();
        $authentication = $this->createAuthentication();
        $request = new Payment($authentication, $parameterBag);

        $this->assertEquals($authentication, $request->getAuthentication());
    }

    public function testGetParameterBagShouldReturnObject()
    {
        $authentication = $this->createAuthentication();
        $parameterBag = $this->createParameterBag();
        $request = new Payment($authentication, $parameterBag);

        $this->assertEquals($parameterBag, $request->getParameterBag());
    }

    protected function createAuthentication()
    {
        return AuthenticationFactory::create("HMAC_SHA256_V1", $this->secretKey());
    }

    protected function createParameterBag()
    {
        return new ParameterBag(array(
            "Ds_Merchant_Amount" => "10025",
            "Ds_Merchant_Currency" => "978",
            "Ds_Merchant_MerchantCode" => "1234abcde",
            "Ds_Merchant_Order" => "1234qwerty",
            "Ds_Merchant_Terminal" => "001",
            "Ds_Merchant_TransactionType" => "0",
            "Ds_Merchant_Pan" => "4444111122223333",
            "Ds_Merchant_ExpiryDate" => "1709",
            "Ds_Merchant_Cvv2" => "123",
        ));
    }

    protected function secretKey()
    {
        return "Mk9m98IfEblmPfrpsawt7BmxObt98Jev";
    }

    public function testToArrayShouldReturnFormattedArray()
    {
        $authentication = $this->createAuthentication();
        $parameterBag = $this->createParameterBag();
        $expected = array(
            "Ds_SignatureVersion" => $authentication->getName(),
            "DatosEntrada" => $parameterBag->all(),
            "Ds_Signature" => $authentication->hash($parameterBag),
        );
        $request = new Payment($authentication, $parameterBag);

        $this->assertEquals($expected, $request->toArray());
    }
}
