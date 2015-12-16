<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment\Redirect;

abstract class AbstractRedirect
{
    const VERSION = "Ds_SignatureVersion";
    const PARAMETERS = "Ds_MerchantParameters";
    const SIGNATURE = "Ds_Signature";
}
