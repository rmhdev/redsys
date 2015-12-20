<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Transaction\Webservice;

use Redsys\Security\Authentication\AuthenticationFactory;
use Redsys\Security\Authentication\HmacSha256V1;
use Redsys\Transaction\Webservice\Notification;
use Redsys\Transaction\Webservice\ParameterBag;

class NotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResponseOnEmptyNotificationShouldReturnEmpty()
    {
        $notification = new Notification($this->secretKey());

        $this->assertEmpty($notification->getResponse());
    }

    protected function secretKey()
    {
        return "Mk9m98IfEblmPfrpsawt7BmxObt98Jev";
    }

    public function testGetResponseShouldReturnGivenResponse()
    {
        $xml = $this->getDefaultXml();
        $notification = new Notification($this->secretKey(), $xml);

        $this->assertEquals($xml, $notification->getResponse());
    }

    private function getDefaultXml()
    {
        $xml = "<RETORNOXML>";
        $xml .= "<CODIGO>0</CODIGO>";
        $xml .= "<OPERACION>";
        $xml .= "<Ds_Amount>145</Ds_Amount>";
        $xml .= "<Ds_Currency>978</Ds_Currency>";
        $xml .= "<Ds_Order>1444912789</Ds_Order>";
        $xml .= "<Ds_Signature>bAuiQOymGvYzqHi7dEeuWrRYFeUjtFH6NyOoWSl0vHU=</Ds_Signature>";
        $xml .= "<Ds_MerchantCode>999008881</Ds_MerchantCode>";
        $xml .= "<Ds_Terminal>871</Ds_Terminal>";
        $xml .= "<Ds_Response>0000</Ds_Response>";
        $xml .= "<Ds_AuthorisationCode>050372</Ds_AuthorisationCode>";
        $xml .= "<Ds_TransactionType>0</Ds_TransactionType>";
        $xml .= "<Ds_SecurePayment>0</Ds_SecurePayment>";
        $xml .= "<Ds_Language>1</Ds_Language>";
        $xml .= "<Ds_Card_Type>D</Ds_Card_Type>";
        $xml .= "<Ds_MerchantData></Ds_MerchantData>";
        $xml .= "<Ds_Card_Country>724</Ds_Card_Country>";
        $xml .= "</OPERACION>";
        $xml .= "</RETORNOXML>";

        return $xml;
    }

    public function testToArrayOnEmptyNotificationShouldReturnEmptyArray()
    {
        $notification = new Notification($this->secretKey());

        $this->assertEquals(array(), $notification->toArray());
    }

    public function testToArrayShouldReturnArray()
    {
        $notification = new Notification($this->secretKey(), $this->getDefaultXml());

        $this->assertEquals($this->getDefaultArray(), $notification->toArray());
    }

    private function getDefaultArray()
    {
        return array(
            "CODIGO" => 0,
            "OPERACION" => array(
                "Ds_Amount" => "145",
                "Ds_Currency" => "978",
                "Ds_Order" => "1444912789",
                "Ds_Signature" => "bAuiQOymGvYzqHi7dEeuWrRYFeUjtFH6NyOoWSl0vHU=",
                "Ds_MerchantCode" => "999008881",
                "Ds_Terminal" => "871",
                "Ds_Response" => "0000",
                "Ds_AuthorisationCode" => "050372",
                "Ds_TransactionType" => "0",
                "Ds_SecurePayment" => "0",
                "Ds_Language" => "1",
                "Ds_Card_Type" => "D",
                "Ds_MerchantData" => "",
                "Ds_Card_Country" => "724",
            )
        );
    }

    public function testGetAuthenticationShouldReturnObject()
    {
        $expected = $this->createAuthentication();
        $notification = new Notification($this->secretKey(), "");

        $this->assertEquals($expected, $notification->getAuthentication());
    }

    private function createAuthentication()
    {
        return AuthenticationFactory::create(HmacSha256V1::NAME, $this->secretKey());
    }

    public function testGetParameterBagShouldReturnObject()
    {
        $notification = new Notification($this->secretKey(), $this->getDefaultXml());
        $parameters = $this->getDefaultArray();
        $parameterBag = new ParameterBag($parameters["OPERACION"]);

        $this->assertEquals($parameterBag, $notification->getParameterBag());
    }

    public function testHasCorrectSignatureWithCorrectResponseShouldReturnTrue()
    {
        $notification = new Notification($this->secretKey(), $this->getDefaultXml());

        $this->assertTrue(
            $notification->hasCorrectSignature(),
            sprintf('Expected "%s"', $notification->getAuthentication()->hash($notification->getParameterBag()))
        );
    }

    public function testHasCorrectSignatureWithIncorrectResponseShouldReturnFalse()
    {
        $notification = new Notification($this->secretKey(), $this->getIncorrectSignatureXml());

        $this->assertFalse(
            $notification->hasCorrectSignature(),
            sprintf('Expected "%s"', $notification->getAuthentication()->hash($notification->getParameterBag()))
        );
    }

    private function getIncorrectSignatureXml()
    {
        $xml = "<RETORNOXML>";
        $xml .= "<CODIGO>101</CODIGO>";
        $xml .= "<OPERACION>";
        $xml .= "<Ds_Amount>145</Ds_Amount>";
        $xml .= "<Ds_Currency>978</Ds_Currency>";
        $xml .= "<Ds_Order>1444912789</Ds_Order>";
        $xml .= "<Ds_Signature>lorem_ipsum_123456</Ds_Signature>";
        $xml .= "<Ds_MerchantCode>999008881</Ds_MerchantCode>";
        $xml .= "<Ds_Terminal>871</Ds_Terminal>";
        $xml .= "<Ds_Response>0000</Ds_Response>";
        $xml .= "<Ds_AuthorisationCode>050372</Ds_AuthorisationCode>";
        $xml .= "<Ds_TransactionType>0</Ds_TransactionType>";
        $xml .= "<Ds_SecurePayment>0</Ds_SecurePayment>";
        $xml .= "<Ds_Language>1</Ds_Language>";
        $xml .= "<Ds_Card_Type>D</Ds_Card_Type>";
        $xml .= "<Ds_MerchantData></Ds_MerchantData>";
        $xml .= "<Ds_Card_Country>724</Ds_Card_Country>";
        $xml .= "</OPERACION>";
        $xml .= "</RETORNOXML>";

        return $xml;
    }

    public function testGetResponseCodeOnEmptyResponseCodeShouldReturnEmpty()
    {
        $notification = new Notification($this->secretKey());

        $this->assertEquals("", $notification->getResponseCode());
    }

    public function testGetResponseCodeShouldReturnReceivedCode()
    {
        $notification = new Notification($this->secretKey(), $this->getIncorrectSignatureXml());

        $this->assertEquals("101", $notification->getResponseCode());
    }
}
