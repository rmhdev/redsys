<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\ParameterBag;

use Redsys\ParameterBag\Request;

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
            "Ds_Merchant_AuthorisationCode" => "123456",
            "Ds_Merchant_ChargeExpiryDate" => "2015-11-22",
            "Ds_Merchant_ConsumerLanguage" => "001",
            "Ds_Merchant_Currency" => "978",
            "Ds_Merchant_DateFrecuency" => "10",
            "Ds_Merchant_MerchantCode" => "1234abcde",
            "Ds_Merchant_MerchantData" => "Lorem ipsum",
            "Ds_Merchant_MerchantName" => "Name",
            "Ds_Merchant_MerchantURL" => "http://www.example.com",
            "Ds_Merchant_Order" => "1234qwerty",
            "Ds_Merchant_ProductDescription" => "Lorem ipsum",
            "Ds_Merchant_SumTotal" => "10025",
            "Ds_Merchant_Terminal" => "001",
            "Ds_Merchant_Titular" => "Acme Inc",
            "Ds_Merchant_TransactionDate" => "2015-11-22",
            "Ds_Merchant_TransactionType" => "0",
            "Ds_Merchant_UrlOK" => "http://www.example.com/ok",
            "Ds_Merchant_UrlKO" => "http://www.example.com/ko",
        );
    }

    protected function getOrderFieldName()
    {
        return "Ds_Merchant_Order";
    }

    protected function getDefaultExpectedEncode()
    {
        return base64_encode(json_encode($this->getDefaultFieldsWithValues()));
    }
}
