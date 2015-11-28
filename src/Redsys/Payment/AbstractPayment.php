<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment;

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
    public function customParameters()
    {
        return $this->customParameters;
    }

    /**
     * @return bool
     */
    public function hasCustomParameters()
    {
        return !empty($this->customParameters());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $processed = array();
        foreach ($this->parameters as $field => $value) {
            $publicFieldName = $this->getPublicFieldName($field);
            $processed[$publicFieldName] = $value;
        }
        $processed = array_merge($processed, $this->customParameters());

        return $processed;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return string|null
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
     * @return array
     */
    abstract protected function getDefaultFields();

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->toArray());
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->toArray());
    }
}
