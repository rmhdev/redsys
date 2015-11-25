<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment;

use Redsys\Payment\Request;

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

    /**
     * @inheritdoc
     */
    public function validParameters()
    {
        return array(
            array(
                array(
                    "Ds_Merchant_MerchantCode" => "123456789"
                ),
            ),
            array(
                array(
                    "Ds_Merchant_MerchantCode" => "123456789",
                    "Ds_Merchant_Terminal" => "001",
                ),
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function unfixedValidParameters()
    {
        return array(
            array(
                array(
                    "Ds_Merchant_MerchantCode" => "12345abCd"
                ),
                array(
                    "DS_MERCHANT_MERCHANTCODE" => "12345abCd"
                )
            ),
            array(
                array(
                    "Ds_Merchant_MerchantCode" => "12345abCd",
                    "Ds_Merchant_Terminal" => "001",
                ),
                array(
                    "Ds_MERCHANT_MerchantCODE" => "12345abCd",
                    "ds_merchant_terminal" => "001",
                ),
            )
        );
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

    public function testGetForUndefinedFieldShouldReturnDefaultValue()
    {
        $request = new Request(array(
            "Ds_Merchant_Order" => "1234qwerty",
        ));

        $this->assertNull($request->get("Lorem_Ipsum", null));
        $this->assertEquals("hi!", $request->get("Adispicing", "hi!"));
    }

    public function testGetForDefinedFieldShouldReturnValue()
    {
        $request = new Request(array(
            "Ds_Merchant_Order" => "1234qwerty",
        ));

        $this->assertEquals("1234qwerty", $request->get("Ds_Merchant_Order"));
        $this->assertEquals("1234qwerty", $request->get("DS_MERCHANT_ORDER"));
        $this->assertEquals("1234qwerty", $request->get("Ds_merchant_ORDER"));
    }

    public function testDefaultFieldsShouldReturnListOfAcceptedFieldNames()
    {
        $this->assertEquals(
            array_keys($this->getDefaultFieldsWithValues()),
            Request::defaultFields()
        );
    }

    public function testGetCustomParametersWithOnlyCorrectFieldsShouldReturnEmptyList()
    {
        $request = new Request(array(
            "Ds_Merchant_MerchantCode" => "123456789"
        ));

        $this->assertEquals(array(), $request->customParameters());
    }

    public function testGetWithCustomParametersShouldReturnAddedCustomParameters()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test"
        );
        $request = new Request($parameters);

        $this->assertEquals($parameters, $request->customParameters());
    }

    public function testGetWithCustomParameterWithShouldReturnValue()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test"
        );
        $request = new Request($parameters);

        $this->assertEquals("test", $request->get("Lorem_Ipsum"));
    }

    public function testToArrayWithCustomParametersShouldReturnAllParameters()
    {
        $parameters = array(
            "Ds_Merchant_MerchantCode" => "123456789",
            "Lorem_Ipsum" => "test"
        );
        $request = new Request($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }

    public function customParameters()
    {
        return array(
            array(
                array(
                    "Lorem_Ipsum" => "test"
                )
            ),
        );
    }

    public function testHasCustomParametersWithNoCustomParametersShouldReturnFalse()
    {
        $request = new Request(array(
            "Ds_Merchant_MerchantCode" => "123456789",
        ));

        $this->assertFalse($request->hasCustomParameters());
    }

    public function testHasCustomParametersWithCustomParametersShouldReturnTrue()
    {
        $request = new Request(array(
            "Ds_Merchant_MerchantCode" => "123456789",
            "Lorem_Ipsum" => "test"
        ));

        $this->assertTrue($request->hasCustomParameters());
    }
}
