<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\ParameterBag\Webservice;

use Redsys\ParameterBag\Webservice\Request;
use Redsys\Tests\ParameterBag\AbstractTest;

class RequestTest extends AbstractTest
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
            "Ds_Merchant_Currency" => "978",
            "Ds_Merchant_MerchantCode" => "1234abcde",
            "Ds_Merchant_Order" => "1234qwerty",
            "Ds_Merchant_Terminal" => "001",
            "Ds_Merchant_TransactionType" => "0",
            "Ds_Merchant_Pan" => "4444111122223333",
            "Ds_Merchant_ExpiryDate" => "1709",
            "Ds_Merchant_Cvv2" => "123",
        );
    }

    protected function getOrderFieldName()
    {
        return "Ds_Merchant_Order";
    }

    protected function getDefaultExpectedEncode()
    {
        $expected = "<DATOSENTRADA>";
        $expected .= "<Ds_Merchant_Amount>10025</Ds_Merchant_Amount>";
        $expected .= "<Ds_Merchant_Currency>978</Ds_Merchant_Currency>";
        $expected .= "<Ds_Merchant_MerchantCode>1234abcde</Ds_Merchant_MerchantCode>";
        $expected .= "<Ds_Merchant_Order>1234qwerty</Ds_Merchant_Order>";
        $expected .= "<Ds_Merchant_Terminal>001</Ds_Merchant_Terminal>";
        $expected .= "<Ds_Merchant_TransactionType>0</Ds_Merchant_TransactionType>";
        $expected .= "<Ds_Merchant_Pan>4444111122223333</Ds_Merchant_Pan>";
        $expected .= "<Ds_Merchant_ExpiryDate>1709</Ds_Merchant_ExpiryDate>";
        $expected .= "<Ds_Merchant_Cvv2>123</Ds_Merchant_Cvv2>";
        $expected .= "</DATOSENTRADA>";

        return $expected;
    }
}
