<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment;

use Redsys\Payment\PaymentInterface;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayEmptyShouldReturnEmptyArray()
    {
        $request = $this->create();

        $this->assertEquals(array(), $request->toArray());
    }

    /**
     * @param array $parameters
     * @return PaymentInterface
     */
    abstract protected function create($parameters = array());

    /**
     * @dataProvider validParameters
     * @param array $parameters
     */
    public function testToArrayShouldReturnParametersDefinedInConstructor($parameters)
    {
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }

    /**
     * @return array
     */
    abstract public function validParameters();

    /**
     * @dataProvider unfixedValidParameters
     * @param array $expected
     * @param array $values
     */
    public function testToArrayShouldReturnParametersWithFixedFieldNames($expected, $values)
    {
        $request = $this->create($values);

        $this->assertEquals($expected, $request->toArray());
    }

    /**
     * @return array
     */
    abstract public function unfixedValidParameters();
}
