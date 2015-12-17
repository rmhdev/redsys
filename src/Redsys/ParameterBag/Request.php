<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\ParameterBag;

final class Request extends AbstractParameterBag implements ParameterBagInterface
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
     * @inheritdoc
     */
    protected function getDefaultFields()
    {
        return self::defaultFields();
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return $this->get(self::ORDER, "");
    }

    public function encode()
    {
        return base64_encode(json_encode($this->all()));
    }

    /**
     * @inheritdoc
     */
    public static function createFromEncoded($encoded)
    {
        return new self(json_decode(base64_decode($encoded), true));
    }

    /**
     * @return array
     */
    public static function defaultFields()
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
