<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Redirect;

use Redsys\ParameterBag\Response;
use Redsys\Security\Authentication\AuthenticationFactory;
use Redsys\Security\Authentication\AuthenticationInterface;

class Notification
{
    const VERSION = "Ds_SignatureVersion";
    const PARAMETERS = "Ds_MerchantParameters";
    const SIGNATURE = "Ds_Signature";

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     * @param array $parameters
     */
    public function __construct($key, $parameters = array())
    {
        $this->parameters = is_array($parameters) ? $parameters : (array)$parameters;
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->parameters;
    }

    /**
     * @return AuthenticationInterface
     */
    public function getAuthentication()
    {
        $version = $this->getValue(self::VERSION);

        return AuthenticationFactory::create($version, $this->key);
    }

    private function getValue($name, $default = null)
    {
        if (!array_key_exists($name, $this->parameters)) {
            return $default;
        }

        return $this->parameters[$name];
    }

    /**
     * @return Response
     */
    public function getParameterBag()
    {
        return Response::createFromEncoded($this->getValue(self::PARAMETERS, ""));
    }

    /**
     * @return bool
     */
    public function hasCorrectSignature()
    {
        return $this->getValue(self::SIGNATURE, "") === $this->getAuthentication()->hash($this->getParameterBag());
    }
}
