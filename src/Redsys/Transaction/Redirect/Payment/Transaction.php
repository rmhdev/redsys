<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Redirect\Payment;

use Redsys\Transaction\AbstractTransaction;
use Redsys\Transaction\TransactionInterface;

final class Transaction extends AbstractTransaction implements TransactionInterface
{
    const PARAMETERS = "Ds_MerchantParameters";

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return array(
            self::VERSION => $this->getAuthentication()->getName(),
            self::PARAMETERS => $this->getParameterBag()->encode(),
            self::SIGNATURE => $this->getAuthentication()->hash($this->getParameterBag()),
        );
    }
}
