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

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayEmptyRequestShouldReturnEmptyArray()
    {
        $request = new Request();

        $this->assertEquals(array(), $request->toArray());
    }

    /**
     * @dataProvider validParameters
     */
    public function testToArrayShouldReturnParametersDefinedInConstructor($parameters)
    {
        $request = new Request($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }

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
     * @dataProvider invalidParameters
     * @expectedException \UnexpectedValueException
     */
    public function testCreatingRequestWithUnknownFieldsShouldThrowException($parameters)
    {
        new Request($parameters);
    }

    public function invalidParameters()
    {
        return array(
            array(
                array(
                    "Lorem_Ipsum" => "test"
                )
            ),
        );
    }

    /**
     * @dataProvider unfixedValidParameters
     */
    public function testToArrayShouldReturnParametersWithFixedFieldNames($expected, $values)
    {
        $request = new Request($values);

        $this->assertEquals($expected, $request->toArray());
    }

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

    public function testCreatingRequestWithAllAvailableFields()
    {
        $parameters = array(
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
            "Ds_Merchant_TransactionDate" => "2015-11-22",
            "Ds_Merchant_TransactionType" => "0",
            "Ds_Merchant_Titular" => "Acme Inc",
            "Ds_Merchant_UrlOK" => "http://www.example.com/ok",
            "Ds_Merchant_UrlKO" => "http://www.example.com/ko",
        );
        $request = new Request($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }
}
