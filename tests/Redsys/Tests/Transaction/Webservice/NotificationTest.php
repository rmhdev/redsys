<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Transaction\Webservice;

use Redsys\Transaction\Webservice\Notification;

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
        $notification = new Notification($this->secretKey(), $xml);

        $this->assertEquals($xml, $notification->getResponse());
    }

    public function testToArrayOnEmptyNotificationShouldReturnEmptyArray()
    {
        $notification = new Notification($this->secretKey());

        $this->assertEquals(array(), $notification->toArray());
    }
}
