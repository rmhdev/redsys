<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\ParameterBag\Webservice;

use Redsys\ParameterBag\Webservice\TypeRequest as Request;
use Redsys\Tests\ParameterBag\AbstractTest;

class TypeRequestTest extends AbstractTest
{
    /**
     * @param array $parameters
     * @return Request
     */
    protected function create($parameters = array())
    {
        return new Request($parameters);
    }

    protected function getDefaultFieldsWithValues()
    {
        return array(
            "Ds_Merchant_Amount" => "10025",
            "Ds_Merchant_AuthorisationCode" => "123456",
            "Ds_Merchant_Currency" => "978",
            "Ds_Merchant_MerchantCode" => "1234abcde",
            "Ds_Merchant_Order" => "1234qwerty",
            "Ds_Merchant_Terminal" => "001",
            "Ds_Merchant_TransactionType" => "0",
        );
    }

    protected function getOrderFieldName()
    {
        return "Ds_Merchant_Order";
    }

    public function testEncodeShouldReturnCodifiedString()
    {
        $expected = "<DATOSENTRADA>";
        $expected .= "<Ds_Merchant_Amount>10025</Ds_Merchant_Amount>";
        $expected .= "<Ds_Merchant_AuthorisationCode>123456</Ds_Merchant_AuthorisationCode>";
        $expected .= "<Ds_Merchant_Currency>978</Ds_Merchant_Currency>";
        $expected .= "<Ds_Merchant_MerchantCode>1234abcde</Ds_Merchant_MerchantCode>";
        $expected .= "<Ds_Merchant_Order>1234qwerty</Ds_Merchant_Order>";
        $expected .= "<Ds_Merchant_Terminal>001</Ds_Merchant_Terminal>";
        $expected .= "<Ds_Merchant_TransactionType>0</Ds_Merchant_TransactionType>";
        $expected .= "</DATOSENTRADA>";

        $parameterBag = $this->create($this->getDefaultFieldsWithValues());

        $this->assertEquals($expected, $parameterBag->encode());
    }
}
