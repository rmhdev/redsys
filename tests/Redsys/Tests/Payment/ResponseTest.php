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

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayEmptyRequestShouldReturnEmptyArray()
    {
        $request = new Response();

        $this->assertEquals(array(), $request->toArray());
    }

    /**
     * @dataProvider validParameters
     */
    public function testToArrayShouldReturnParametersDefinedInConstructor($parameters)
    {
        $request = new Response($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }

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
}
