<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Redirect;

use Redsys\Transaction\AbstractParameterBag;
use Redsys\Transaction\ParameterBagInterface;

final class ParameterBag extends AbstractParameterBag implements ParameterBagInterface
{
    const AMOUNT = "Ds_Amount";
    const AUTHORISATION_CODE = "Ds_AuthorisationCode";
    const CARD_COUNTRY = "Ds_Card_Country";
    const CARD_TYPE = "Ds_Card_Type";
    const CONSUMER_LANGUAGE = "Ds_ConsumerLanguage";
    const CURRENCY = "Ds_Currency";
    const DATE = "Ds_Date";
    const HOUR = "Ds_Hour";
    const MERCHANT_CODE = "Ds_MerchantCode";
    const MERCHANT_DATA = "Ds_MerchantData";
    const ORDER = "Ds_Order";
    const RESPONSE = "Ds_Response";
    const SECURE_PAYMENT = "Ds_SecurePayment";
    const TRANSACTION_TYPE = "Ds_TransactionType";
    const TERMINAL = "Ds_Terminal";

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
     * @inheritdoc
     */
    public static function defaultFields()
    {
        return array(
            self::AMOUNT,
            self::AUTHORISATION_CODE,
            self::CARD_COUNTRY,
            self::CARD_TYPE,
            self::CONSUMER_LANGUAGE,
            self::CURRENCY,
            self::DATE,
            self::HOUR,
            self::MERCHANT_CODE,
            self::MERCHANT_DATA,
            self::ORDER,
            self::RESPONSE,
            self::SECURE_PAYMENT,
            self::TRANSACTION_TYPE,
            self::TERMINAL,
        );
    }
}
