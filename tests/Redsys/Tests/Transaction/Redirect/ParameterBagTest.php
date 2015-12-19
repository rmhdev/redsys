<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Transaction\Redirect;

use Redsys\Transaction\Redirect\ParameterBag;
use Redsys\Tests\Transaction\AbstractParameterBagTest;
use Redsys\Transaction\ParameterBagInterface;

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

    protected function getOrderFieldName()
    {
        return "Ds_Order";
    }

    protected function getDefaultExpectedEncode()
    {
        return base64_encode(json_encode($this->getDefaultFieldsWithValues()));
    }
}
