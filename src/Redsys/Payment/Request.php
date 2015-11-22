<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment;

final class Request
{
    const AMOUNT = "Ds_Merchant_Amount";
    const AUTHORISATION_CODE = "Ds_Merchant_AuthorisationCode";
    const CHARGE_EXPIRY_DATE = "Ds_Merchant_ChargeExpiryDate";
    const CONSUMER_LANGUAGE = "Ds_Merchant_ConsumerLanguage";
    const CURRENCY = "Ds_Merchant_Currency";
    const DATE_FREQUENCY = "Ds_Merchant_DateFrecuency";
    const MERCHANT_CODE = "Ds_Merchant_MerchantCode";
    const MERCHANT_DATA = "Ds_Merchant_MerchantData";
    const MERCHANT_NAME = "Ds_Merchant_MerchantName";
    const MERCHANT_URL = "Ds_Merchant_MerchantURL";
    const ORDER = "Ds_Merchant_Order";
    const PRODUCT_DESCRIPTION = "Ds_Merchant_ProductDescription";
    const SUM_TOTAL = "Ds_Merchant_SumTotal";
    const TERMINAL = "Ds_Merchant_Terminal";
    const TRANSACTION_DATE = "Ds_Merchant_TransactionDate";
    const TRANSACTION_TYPE = "Ds_Merchant_TransactionType";
    const TITULAR = "Ds_Merchant_Titular";
    const URL_OK = "Ds_Merchant_UrlOK";
    const URL_KO = "Ds_Merchant_UrlKO";

    /**
     * @var array
     */
    private $parameters;

    /**
     * @param array $parameters
     */
    public function __construct($parameters = array())
    {
        $this->parameters = $this->processParameters($parameters);
    }

    private function processParameters($parameters = array())
    {
        $processed = array();
        foreach ($parameters as $field => $value) {
            if (!$this->isAvailableField($field)) {
                throw new \UnexpectedValueException(
                    sprintf('Field "%s" is not available', $field)
                );
            }
            $processed[$this->getNormalizedFieldName($field)] = $value;
        }

        return $processed;
    }

    private function isAvailableField($field)
    {
        return ("" !== $this->getPublicFieldName($field));
    }

    private function getPublicFieldName($field)
    {
        $fields = array_change_key_case(
            array_combine(self::availableFields(), self::availableFields()),
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
     * @param string $name
     * @param mixed $default
     * @return string|null
     */
    public function get($name, $default = null)
    {
        $name = strtolower($name);
        if (!array_key_exists($name, $this->parameters)) {
            return $default;
        }

        return $this->parameters[$name];
    }

    public static function availableFields()
    {
        return array(
            self::AMOUNT,
            self::AUTHORISATION_CODE,
            self::CHARGE_EXPIRY_DATE,
            self::CONSUMER_LANGUAGE,
            self::CURRENCY,
            self::DATE_FREQUENCY,
            self::MERCHANT_CODE,
            self::MERCHANT_DATA,
            self::MERCHANT_NAME,
            self::MERCHANT_URL,
            self::ORDER,
            self::PRODUCT_DESCRIPTION,
            self::SUM_TOTAL,
            self::TERMINAL,
            self::TITULAR,
            self::TRANSACTION_DATE,
            self::TRANSACTION_TYPE,
            self::URL_OK,
            self::URL_KO,
        );
    }
}
