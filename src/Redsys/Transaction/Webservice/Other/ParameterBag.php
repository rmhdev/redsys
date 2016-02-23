<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Webservice\Other;

use Redsys\Transaction\AbstractParameterBag;
use Redsys\Transaction\ParameterBagInterface;

final class ParameterBag extends AbstractParameterBag implements ParameterBagInterface
{
    const AMOUNT = "Ds_Merchant_Amount";
    const AUTHORISATION_CODE = "Ds_Merchant_AuthorisationCode";
    const CURRENCY = "Ds_Merchant_Currency";
    const MERCHANT_CODE = "Ds_Merchant_MerchantCode";
    const ORDER = "Ds_Merchant_Order";
    const TERMINAL = "Ds_Merchant_Terminal";
    const TRANSACTION_TYPE = "Ds_Merchant_TransactionType";

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

    /**
     * @inheritdoc
     */
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
            self::AUTHORISATION_CODE,
            self::CURRENCY,
            self::MERCHANT_CODE,
            self::ORDER,
            self::TERMINAL,
            self::TRANSACTION_TYPE,
        );
    }
}
