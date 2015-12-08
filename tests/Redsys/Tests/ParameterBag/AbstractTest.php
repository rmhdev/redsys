<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\ParameterBag;

use Redsys\ParameterBag\ParameterBagInterface;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayEmptyShouldReturnEmptyArray()
    {
        $request = $this->create();

        $this->assertEquals(array(), $request->all());
    }

    /**
     * @param array $parameters
     * @return ParameterBagInterface
     */
    abstract protected function create($parameters = array());

    public function testWithAllDefaultCorrectParametersShouldReturnAllParameters()
    {
        $parameters = $this->getDefaultFieldsWithValues();
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->all());
    }

    /**
     * @return array
     */
    abstract protected function getDefaultFieldsWithValues();

    public function testAllShouldReturnParametersWithCorrectedFieldNames()
    {
        $parameters = $this->getDefaultFieldsWithValues();
        $keys = array_map(function ($key) {
            return strtoupper($key);
        }, array_keys($parameters));

        $request = $this->create(array_combine($keys, array_values($parameters)));

        $this->assertEquals($parameters, $request->all());
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

    public function testHasForUndefinedFieldShouldReturnFalse()
    {
        $request = $this->create($this->getDefaultFieldsWithValues());

        $this->assertFalse($request->has("Lorem_Ipsum"));
    }

    public function testHasForDefinedFieldShouldReturnTrue()
    {
        $parameter = $this->getFirstDefaultParameter();
        $key = array_keys($parameter)[0];
        $request = $this->create($parameter);

        $text = 'has value from existing field "%s"';
        $this->assertTrue($request->has($key), sprintf($text, $key));
        $this->assertTrue($request->has(strtoupper($key)), sprintf($text, strtoupper($key)));
        $this->assertTrue($request->has(strtolower($key)), sprintf($text, strtolower($key)));
    }

    public function testHasForCustomDefinedFieldShouldReturnTrue()
    {
        $request = $this->create(array("Lorem_Ipsum" => "test"));

        $this->assertTrue($request->has("Lorem_Ipsum"));
    }

    public function testHasForCustomDefinedFieldShouldBeCaseSensitive()
    {
        $request = $this->create(array("Lorem_Ipsum" => "test"));

        $this->assertFalse($request->has("LOREM_IPSUM"));
    }

    public function testGetForDefinedCustomFieldShouldBeCaseSensitive()
    {
        $request = $this->create(array("Lorem_Ipsum" => "test"));

        $this->assertNull($request->get("LOREM_IPSUM"));
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

        $this->assertEquals(array(), $request->custom());
    }

    public function testGetWithCustomParametersShouldReturnAddedCustomParameters()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test"
        );
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->custom());
    }

    public function testGetWithCustomParameterWithShouldReturnValue()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test"
        );
        $request = $this->create($parameters);

        $this->assertEquals("test", $request->get("Lorem_Ipsum"));
    }

    public function testAllWithCustomParametersShouldReturnAllParameters()
    {
        $parameters = array_merge(
            $this->getFirstDefaultParameter(),
            array("Lorem_Ipsum" => "test")
        );
        $request = $this->create($parameters);

        $this->assertEquals($parameters, $request->all());
    }

    public function testHasCustomParametersWithNoCustomParametersShouldReturnFalse()
    {
        $request = $this->create($this->getDefaultFieldsWithValues());

        $this->assertFalse($request->hasCustom());
    }

    public function testHasCustomParametersWithCustomParametersShouldReturnTrue()
    {
        $request = $this->create(array(
            "Lorem_Ipsum" => "test"
        ));

        $this->assertTrue($request->hasCustom());
    }

    public function testDefaultFieldsShouldReturnListOfAcceptedFieldNames()
    {
        $request = $this->create();
        $this->assertEquals(
            array_keys($this->getDefaultFieldsWithValues()),
            $request::defaultFields()
        );
    }

    public function testKeysShouldReturnListOfAllDefinedKeys()
    {
        $parameters = array_merge(
            $this->getDefaultFieldsWithValues(),
            array("Lorem_Ipsum" => "test")
        );
        $request = $this->create($parameters);

        $this->assertEquals(array_keys($parameters), $request->keys());
    }

    public function testObjectShouldBeTraversable()
    {
        $request = $this->create();

        $this->assertTrue($request instanceof \Traversable);
    }

    public function testObjectShouldBeCountable()
    {
        $request = $this->create();

        $this->assertTrue($request instanceof \Countable);
    }

    public function testGerOrderWithEmptyObjectShouldReturnNull()
    {
        $request = $this->create();

        $this->assertNull($request->getOrder());
    }

    public function testGerOrderWithShouldReturnString()
    {
        $parameters = $this->getDefaultFieldsWithValues();
        $request = $this->create($parameters);

        $this->assertEquals($parameters[$this->getOrderFieldName()], $request->getOrder());
    }

    /**
     * @return string
     */
    abstract protected function getOrderFieldName();
}
