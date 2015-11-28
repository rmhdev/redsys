<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\ParameterBag;

abstract class AbstractPayment implements PaymentInterface
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $customParameters;

    /**
     * @param array $parameters
     */
    public function __construct($parameters = array())
    {
        list($default, $custom) = $this->processParameters($parameters);
        $this->parameters = $default;
        $this->customParameters = $custom;
    }

    private function processParameters($parameters = array())
    {
        $processed = array();
        $custom = array();
        foreach ($parameters as $field => $value) {
            if ($this->isCustomField($field)) {
                $custom[$field] = $value;
                continue;
            }
            $processed[$this->getNormalizedFieldName($field)] = $value;
        }

        return array($processed, $custom);
    }

    private function isCustomField($field)
    {
        return ("" === $this->getPublicFieldName($field));
    }

    private function getPublicFieldName($field)
    {
        $fields = array_change_key_case(
            array_combine($this->getDefaultFields(), $this->getDefaultFields()),
            CASE_LOWER
        );
        $field = strtolower($field);

        return array_key_exists($field, $fields) ? $fields[$field] : "";
    }

    private function getNormalizedFieldName($field)
    {
        return strtolower($field);
    }

    /**
     * @return array
     */
    public function custom()
    {
        return $this->customParameters;
    }

    /**
     * @return bool
     */
    public function hasCustom()
    {
        return !empty($this->custom());
    }

    /**
     * @return array
     */
    public function all()
    {
        $processed = array();
        foreach ($this->parameters as $field => $value) {
            $publicFieldName = $this->getPublicFieldName($field);
            $processed[$publicFieldName] = $value;
        }
        $processed = array_merge($processed, $this->custom());

        return $processed;
    }

    /**
     * @inheritdoc
     */
    public function keys()
    {
        return array_keys($this->all());
    }

    /**
     * @inheritdoc
     */
    public function get($name, $default = null)
    {
        if (array_key_exists($name, $this->customParameters)) {
            return $this->customParameters[$name];
        }
        $name = strtolower($name);
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }

        return $default;
    }

    /**
     * @inheritdoc
     */
    public function has($name)
    {
        if (array_key_exists($name, $this->customParameters)) {
            return true;
        }
        $name = strtolower($name);

        return array_key_exists($name, $this->parameters);
    }


    /**
     * @return array
     */
    abstract protected function getDefaultFields();

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->all());
    }
}
