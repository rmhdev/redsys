<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment;

use Redsys\Payment\Response;

class ResponseTest extends AbstractTest
{
    /**
     * @param array $parameters
     * @return Response
     */
    protected function create($parameters = array())
    {
        return new Response($parameters);
    }

    /**
     * @inheritdoc
     */
    public function validParameters()
    {
        return array(
            array(
                array(
                    "Ds_MerchantCode" => "123456789"
                ),
            ),
            array(
                array(
                    "Ds_MerchantCode" => "123456789",
                    "Ds_Terminal" => "001",
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
                    "Ds_MerchantCode" => "12345abCd"
                ),
                array(
                    "DS_MERCHANTCODE" => "12345abCd"
                )
            ),
            array(
                array(
                    "Ds_MerchantCode" => "12345abCd",
                    "Ds_Terminal" => "001",
                ),
                array(
                    "Ds_MerchantCODE" => "12345abCd",
                    "ds_terminal" => "001",
                ),
            )
        );
    }

    public function testWithAllDefaultCorrectParmetersShouldReturnAllParameters()
    {
        $parameters = $this->getDefaultFieldsWithValues();
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }

    protected function getDefaultFieldsWithValues()
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
}
