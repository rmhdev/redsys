<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Transaction\Webservice;

use Redsys\Transaction\ParameterBagInterface;
use Redsys\Transaction\Webservice\ParameterBag;
use Redsys\Tests\Transaction\AbstractParameterBagTest;

class ParameterBagTest extends AbstractParameterBagTest
{
    /**
     * @param array $parameters
     * @return ParameterBagInterface
     */
    protected function create($parameters = array())
    {
        return new ParameterBag($parameters);
    }

    protected function getDefaultFieldsWithValues()
    {
        return array(
            "Ds_Amount" => "10025",
            "Ds_AuthorisationCode" => "123456",
            "Ds_Language" => "001",
            "Ds_Currency" => "978",
            "Ds_MerchantCode" => "1234abcde",
            "Ds_Order" => "1234qwerty",
            "Ds_Response" => "80",
            "Ds_SecurePayment" => "1",
            "Ds_Signature" => "loremipsum",
            "Ds_TransactionType" => "0",
            "Ds_Terminal" => "001",
        );
    }

    protected function getOrderFieldName()
    {
        return "Ds_Order";
    }

    protected function getDefaultExpectedEncode()
    {
        return implode(
            array(
                "10025",        // amount
                "1234qwerty",   // order
                "1234abcde",    // merchant code
                "978",          // currency
                "80",           // response
                "0",            // transaction type
                "1",            // secure payment
            )
        );
    }

    public function testCreateFromEncodedShouldReturnNewObject()
    {
        $expected = $this->create($this->getDefaultFieldsWithValues());

        $this->assertEquals($expected, $expected::createFromEncoded($this->getDefaultResponseXml()));
    }

    private function getDefaultResponseXml()
    {
        $xml = "<RETORNOXML>";
        $xml .= "<CODIGO>0</CODIGO>";
        $xml .= "<OPERACION>";
        $xml .= "<Ds_Amount>10025</Ds_Amount>";
        $xml .= "<Ds_AuthorisationCode>123456</Ds_AuthorisationCode>";
        $xml .= "<Ds_Currency>978</Ds_Currency>";
        $xml .= "<Ds_Language>001</Ds_Language>";
        $xml .= "<Ds_MerchantCode>1234abcde</Ds_MerchantCode>";
        $xml .= "<Ds_Order>1234qwerty</Ds_Order>";
        $xml .= "<Ds_Response>80</Ds_Response>";
        $xml .= "<Ds_SecurePayment>1</Ds_SecurePayment>";
        $xml .= "<Ds_Signature>loremipsum</Ds_Signature>";
        $xml .= "<Ds_Terminal>001</Ds_Terminal>";
        $xml .= "<Ds_TransactionType>0</Ds_TransactionType>";
        $xml .= "</OPERACION>";
        $xml .= "</RETORNOXML>";

        return $xml;
    }
}
