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

    public function testGetForUndefinedFieldShouldReturnDefaultValue()
    {
        $request = $this->create($this->getDefaultFieldsWithValues());

        $this->assertNull($request->get("Lorem_Ipsum", null));
        $this->assertEquals("hi!", $request->get("Adispicing", "hi!"));
    }

    public function testGetForDefinedFieldShouldReturnValue()
    {
        $parameter = $this->getFirstDefaultParameter();
        $key = array_keys($parameter)[0];
        $value = array_values($parameter)[0];
        $request = $this->create($parameter);

        $text = 'get value from existing field "%s"';
        $this->assertEquals($value, $request->get($key), sprintf($text, $key));
        $this->assertEquals($value, $request->get(strtoupper($key)), sprintf($text, strtoupper($key)));
        $this->assertEquals($value, $request->get(strtolower($key)), sprintf($text, strtolower($key)));
    }

    protected function getFirstDefaultParameter()
    {
        foreach ($this->getDefaultFieldsWithValues() as $name => $value) {
            return array($name => $value);
        }

        throw new \InvalidArgumentException("Default parameters list must have elements");
    }

    public function testGetCustomParametersWithOnlyCorrectFieldsShouldReturnEmptyList()
    {
        $request = $this->create($this->getDefaultFieldsWithValues());

        $this->assertEquals(array(), $request->customParameters());
    }

    public function testGetWithCustomParametersShouldReturnAddedCustomParameters()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test"
        );
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->customParameters());
    }

    public function testGetWithCustomParameterWithShouldReturnValue()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test"
        );
        $request = $this->create($parameters);

        $this->assertEquals("test", $request->get("Lorem_Ipsum"));
    }

    public function testToArrayWithCustomParametersShouldReturnAllParameters()
    {
        $parameters = array_merge(
            $this->getFirstDefaultParameter(),
            array("Lorem_Ipsum" => "test")
        );
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->toArray());
    }

    public function testHasCustomParametersWithNoCustomParametersShouldReturnFalse()
    {
        $request = $this->create($this->getDefaultFieldsWithValues());

        $this->assertFalse($request->hasCustomParameters());
    }

    public function testHasCustomParametersWithCustomParametersShouldReturnTrue()
    {
        $request = $this->create(array(
            "Lorem_Ipsum" => "test"
        ));

        $this->assertTrue($request->hasCustomParameters());
    }

    public function testDefaultFieldsShouldReturnListOfAcceptedFieldNames()
    {
        $request = $this->create();
        $this->assertEquals(
            array_keys($this->getDefaultFieldsWithValues()),
            $request::defaultFields()
        );
    }

    public function testObjectShouldBeIterateable()
    {
        $request = $this->create();

        $this->assertTrue($request instanceof \Traversable);
    }

    public function testObjectShouldBeCountable()
    {
        $request = $this->create();

        $this->assertTrue($request instanceof \Countable);
    }
}
