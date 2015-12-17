<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\ParameterBag\Webservice;

use Redsys\ParameterBag\AbstractParameterBag;
use Redsys\ParameterBag\ParameterBagInterface;

final class Response extends AbstractParameterBag implements ParameterBagInterface
{
    const CODE = "CODIGO";
    const AMOUNT = "Ds_Amount";
    const AUTHORISATION_CODE = "Ds_AuthorisationCode";
    const LANGUAGE = "Ds_Language";
    const CURRENCY = "Ds_Currency";
    const MERCHANT_CODE = "Ds_MerchantCode";
    const ORDER = "Ds_Order";
    const RESPONSE = "Ds_Response";
    const SECURE_PAYMENT = "Ds_SecurePayment";
    const SIGNATURE = "Ds_Signature";
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
    public static function defaultFields()
    {
        return array(
            self::CODE,
            self::AMOUNT,
            self::AUTHORISATION_CODE,
            self::LANGUAGE,
            self::CURRENCY,
            self::MERCHANT_CODE,
            self::ORDER,
            self::RESPONSE,
            self::SECURE_PAYMENT,
            self::SIGNATURE,
            self::TRANSACTION_TYPE,
            self::TERMINAL,
        );
    }
}
