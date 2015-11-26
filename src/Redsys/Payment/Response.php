<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment;

final class Response implements PaymentInterface
{
    /**
     * @var array
     */
    private $parameters;

    public function __construct($parameters = array())
    {
        $this->parameters = $this->processParameters($parameters);
    }

    private function processParameters($parameters = array())
    {
        $processed = array();
        foreach ($parameters as $field => $value) {
            if ($this->isCustomField($field)) {
                continue;
            }
            $processed[$this->getNormalizedFieldName($field)] = $value;
        }

        return $processed;
    }

    private function isCustomField($field)
    {
        return ("" === $this->getPublicFieldName($field));
    }

    private function getPublicFieldName($field)
    {
        $fields = array_change_key_case(
            array_combine(self::defaultFields(), self::defaultFields()),
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
     * @inheritdoc
     */
    public function toArray()
    {
        $processed = array();
        foreach ($this->parameters as $field => $value) {
            $publicFieldName = $this->getPublicFieldName($field);
            $processed[$publicFieldName] = $value;
        }

        return $processed;
    }

    /**
     * @inheritdoc
     */
    public function get($name, $default = null)
    {
        $name = strtolower($name);
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }

        return $default;
    }

    public static function defaultFields()
    {
        return array(
            "Ds_Amount",
            "Ds_AuthorisationCode",
            "Ds_Card_Country",
            "Ds_Card_Type",
            "Ds_ConsumerLanguage",
            "Ds_Currency",
            "Ds_Date",
            "Ds_Hour",
            "Ds_MerchantCode",
            "Ds_MerchantData",
            "Ds_Order",
            "Ds_Response",
            "Ds_SecurePayment",
            "Ds_TransactionType",
            "Ds_Terminal",
        );
    }
}
