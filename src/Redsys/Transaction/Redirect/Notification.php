<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Redirect;

use Redsys\Security\Authentication\AuthenticationFactory;
use Redsys\Transaction\AbstractNotification;
use Redsys\Transaction\NotificationInterface;

final class Notification extends AbstractNotification implements NotificationInterface
{
    const VERSION = "Ds_SignatureVersion";
    const PARAMETERS = "Ds_MerchantParameters";
    const SIGNATURE = "Ds_Signature";

    /**
     * @return array
     */
    public function toArray()
    {
        if (!$this->getResponse()) {
            return array();
        }

        return is_array($this->getResponse()) ? $this->getResponse() : (array)$this->getResponse();
    }

    /**
     * @inheritdoc
     */
    public function getAuthentication()
    {
        $version = $this->getValue(self::VERSION);

        return AuthenticationFactory::create($version, $this->getKey());
    }

    private function getValue($name, $default = null)
    {
        if (!array_key_exists($name, $this->toArray())) {
            return $default;
        }

        return $this->toArray()[$name];
    }

    /**
     * @inheritdoc
     * @return ParameterBag
     */
    public function getParameterBag()
    {
        return ParameterBag::createFromEncoded($this->getValue(self::PARAMETERS, ""));
    }

    /**
     * @inheritdoc
     */
    public function hasCorrectSignature()
    {
        return $this->getValue(self::SIGNATURE, "") === $this->getAuthentication()->hash($this->getParameterBag());
    }

    /**
     * @inheritdoc
     */
    public function getResponseCode()
    {
        $parameterBag = $this->getParameterBag();

        return $parameterBag->get($parameterBag::RESPONSE, "");
    }
}
