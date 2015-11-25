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
     * @dataProvider unfixedValidParameters
     */
    public function testToArrayShouldReturnParametersWithFixedFieldNames($expected, $values)
    {
        $request = $this->create($values);

        $this->assertEquals($expected, $request->toArray());
    }

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
}
