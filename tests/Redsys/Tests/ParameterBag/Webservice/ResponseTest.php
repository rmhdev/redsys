<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\ParameterBag\Webservice;

use Redsys\ParameterBag\Webservice\Response;
use Redsys\Tests\ParameterBag\AbstractTest;

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

    protected function getDefaultFieldsWithValues()
    {
        return array(
            "CODIGO" => "0",
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
}
