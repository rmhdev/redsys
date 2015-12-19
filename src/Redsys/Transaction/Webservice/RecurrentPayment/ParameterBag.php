<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Webservice\RecurrentPayment;

use Redsys\Transaction\AbstractParameterBag;
use Redsys\Transaction\ParameterBagInterface;

final class ParameterBag extends AbstractParameterBag implements ParameterBagInterface
{
    const AMOUNT = "Ds_Merchant_Amount";
    const CHARGE_EXPIRY_DATE = "Ds_Merchant_ChargeExpiryDate";
    const CURRENCY = "Ds_Merchant_Currency";
    const CVV2 = "Ds_Merchant_Cvv2";
    const DATE_FREQUENCY = "Ds_Merchant_DateFrecuency";
    const EXPIRY_DATE = "Ds_Merchant_ExpiryDate";
    const MERCHANT_CODE = "Ds_Merchant_MerchantCode";
    const ORDER = "Ds_Merchant_Order";
    const PAN = "Ds_Merchant_Pan";
    const TERMINAL = "Ds_Merchant_Terminal";
    const TRANSACTION_DATE = "Ds_Merchant_TransactionDate";
    const TRANSACTION_TYPE = "Ds_Merchant_TransactionType";
    const SUM_TOTAL = "Ds_Merchant_SumTotal";

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
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startElement("DATOSENTRADA");
        foreach ($this->all() as $name => $value) {
            $writer->startElement($name);
            $writer->text($value);
            $writer->endElement();
        }
        $writer->endElement();

        return $writer->outputMemory(true);
    }

    /**
     * @inheritdoc
     */
    public static function createFromEncoded($encoded)
    {
        $simpleXml = simplexml_load_string($encoded);
        $result = array();
        foreach ($simpleXml as $name => $value) {
            $result[$name] = $value;
        }

        return new self($result);
    }

    /**
     * @return array
     */
    public static function defaultFields()
    {
        return array(
            self::AMOUNT,
            self::CHARGE_EXPIRY_DATE,
            self::CURRENCY,
            self::CVV2,
            self::DATE_FREQUENCY,
            self::EXPIRY_DATE,
            self::MERCHANT_CODE,
            self::ORDER,
            self::PAN,
            self::SUM_TOTAL,
            self::TERMINAL,
            self::TRANSACTION_DATE,
            self::TRANSACTION_TYPE,
        );
    }
}
