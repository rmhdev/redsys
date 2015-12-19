<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Transaction\Webservice\Other;

use Redsys\Transaction\ParameterBagInterface;
use Redsys\Transaction\Webservice\Other\ParameterBag;
use Redsys\Tests\ParameterBag\AbstractTest;

class ParameterBagTest extends AbstractTest
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

    protected function getDefaultExpectedEncode()
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

        return $expected;
    }
}
