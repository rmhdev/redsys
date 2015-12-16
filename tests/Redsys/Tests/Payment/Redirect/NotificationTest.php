<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment\Redirect;

use Redsys\ParameterBag\Response;
use Redsys\Payment\Redirect\Notification;
use Redsys\Security\Authentication\AuthenticationFactory;
use Redsys\Security\Authentication\HmacSha256V1;

class NotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayOnEmptyNotificationShouldReturnEmptyArray()
    {
        $notification = new Notification();

        $this->assertEquals(array(), $notification->toArray());
    }

    public function testToArrayShouldReturnGivenArray()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test",
            "Custom_Value" => "1234"
        );
        $notification = new Notification($parameters);

        $this->assertEquals($parameters, $notification->toArray());
    }

    public function testToArrayWithStringShouldReturnGivenArray()
    {
        $notification = new Notification("test");

        $this->assertEquals(array("test"), $notification->toArray());
    }

    public function testGetAuthenticationShouldReturnObject()
    {
        $expected = $this->createAuthentication();
        $notificationValues = array(
            "Ds_SignatureVersion" => $expected->getName(),
            "Ds_MerchantParameters" => "lorem_ipsum",
            "Ds_Signature" => "1234",
        );
        $notification = new Notification($notificationValues, $this->secretKey());

        $this->assertEquals($expected, $notification->getAuthentication());
    }

    private function createAuthentication()
    {
        return AuthenticationFactory::create(HmacSha256V1::NAME, $this->secretKey());
    }

    private function secretKey()
    {
        return "Mk9m98IfEblmPfrpsawt7BmxObt98Jev";
    }

    public function testGetParameterBagShouldReturnObject()
    {
        $authentication = $this->createAuthentication();
        $parameterBag = new Response($this->getNotificationParameters());
        $notificationValues = array(
            "Ds_SignatureVersion" => $authentication->getName(),
            "Ds_MerchantParameters" => $authentication->encode($parameterBag->all()),
            "Ds_Signature" => "1234",
        );
        $notification = new Notification($notificationValues);

        $this->assertEquals($parameterBag, $notification->getParameterBag());
    }

    private function getNotificationParameters()
    {
        return array(
            "Ds_Amount" => "10025",
            "Ds_AuthorisationCode" => "123456",
            "Ds_Card_Country" => "724",
            "Ds_Card_Type" => "D",
            "Ds_ConsumerLanguage" => "001",
            "Ds_Currency" => "978",
            "Ds_Date" => "25/11/2015",
            "Ds_Hour" => "19:30",
            "Ds_MerchantCode" => "1234abcde",
            "Ds_MerchantData" => "Lorem Ipsum",
            "Ds_Order" => "1234qwerty",
            "Ds_Response" => "80",
            "Ds_SecurePayment" => "1",
            "Ds_TransactionType" => "0",
            "Ds_Terminal" => "001",
        );
    }

    public function testHasCorrectSignatureWithCorrectResponseShouldReturnTrue()
    {
        $authentication = $this->createAuthentication();
        $parameterBag = new Response($this->getNotificationParameters());
        $notificationValues = array(
            "Ds_SignatureVersion" => $authentication->getName(),
            "Ds_MerchantParameters" => $authentication->encode($parameterBag->all()),
            "Ds_Signature" => $authentication->hash($parameterBag),
        );
        $notification = new Notification($notificationValues, $this->secretKey());

        $this->assertTrue($notification->hasCorrectSignature());
    }

    public function testHasCorrectSignatureWithIncorrectResponseShouldReturnFalse()
    {
        $authentication = $this->createAuthentication();
        $parameterBag = new Response($this->getNotificationParameters());
        $notificationValues = array(
            "Ds_SignatureVersion" => $authentication->getName(),
            "Ds_MerchantParameters" => $authentication->encode($parameterBag->all()),
            "Ds_Signature" => "loremipsum123456",
        );
        $notification = new Notification($notificationValues, $this->secretKey());

        $this->assertFalse($notification->hasCorrectSignature());
    }
}
