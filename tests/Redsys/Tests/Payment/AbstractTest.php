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

    public function testWithAllDefaultCorrectParametersShouldReturnAllParameters()
    {
        $parameters = $this->getDefaultFieldsWithValues();
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }

    /**
     * @return array
     */
    abstract protected function getDefaultFieldsWithValues();

    public function testToArrayShouldReturnParametersWithCorrectedFieldNames()
    {
        $parameters = $this->getDefaultFieldsWithValues();
        $keys = array_map(function ($key) {
            return strtoupper($key);
        }, array_keys($parameters));

        $request = $this->create(array_combine($keys, array_values($parameters)));

        $this->assertEquals($parameters, $request->toArray());
    }
}
