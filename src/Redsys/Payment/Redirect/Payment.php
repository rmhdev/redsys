<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment\Redirect;

use Redsys\ParameterBag\ParameterBagInterface;
use Redsys\Security\Authentication\AuthenticationInterface;

final class Payment
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
     * @return AuthenticationInterface
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * @return ParameterBagInterface
     */
    public function getParameterBag()
    {
        return $this->parameterBag;
    }

    public function toArray()
    {
        return array(
            self::VERSION => $this->getAuthentication()->getName(),
            self::PARAMETERS => $this->getAuthentication()->encode($this->getParameterBag()->all()),
            self::SIGNATURE => $this->getAuthentication()->hash($this->getParameterBag()),
        );
    }
}
