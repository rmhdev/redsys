<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction;

use Redsys\ParameterBag\ParameterBagInterface;
use Redsys\Security\Authentication\AuthenticationInterface;

abstract class AbstractTransaction implements TransactionInterface
{
    const VERSION = "Ds_SignatureVersion";
    const PARAMETERS = "Ds_MerchantParameters";
    const SIGNATURE = "Ds_Signature";

    /**
     * @var AuthenticationInterface
     */
    private $authentication;

    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;

    /**
     * @param AuthenticationInterface $authentication
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(AuthenticationInterface $authentication, ParameterBagInterface $parameterBag)
    {
        $this->authentication = $authentication;
        $this->parameterBag = $parameterBag;
    }

    /**
     * @inheritdoc
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * @inheritdoc
     */
    public function getParameterBag()
    {
        return $this->parameterBag;
    }
}
