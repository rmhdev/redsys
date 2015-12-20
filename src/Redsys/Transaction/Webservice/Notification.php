<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction\Webservice;

use Redsys\Security\Authentication\AuthenticationFactory;
use Redsys\Security\Authentication\HmacSha256V1;
use Redsys\Transaction\AbstractNotification;
use Redsys\Transaction\NotificationInterface;

final class Notification extends AbstractNotification implements NotificationInterface
{
    const CODE = "CODIGO";
    const OPERATION = "OPERACION";
    const DEFAULT_AUTHENTICATION = HmacSha256V1::NAME;

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        if (!$this->getResponse()) {
            return array();
        }
        $simpleXml = simplexml_load_string($this->getResponse());
        $result = array(
            self::CODE => (string)$simpleXml->xpath(self::CODE)[0],
            self::OPERATION => array()
        );
        $parameters = (array)$simpleXml->xpath(self::OPERATION)[0];
        foreach ($parameters as $name => $value) {
            $result[self::OPERATION][$name] = (string)$value;
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getAuthentication()
    {
        return AuthenticationFactory::create(self::DEFAULT_AUTHENTICATION, $this->getKey());
    }

    /**
     * @inheritdoc
     * @return ParameterBag
     */
    public function getParameterBag()
    {
        $raw = $this->toArray();
        $parameters = array();
        if (array_key_exists(self::OPERATION, $raw)) {
            $parameters = $raw[self::OPERATION];
        }

        return new ParameterBag($parameters);
    }

    /**
     * @inheritdoc
     */
    public function hasCorrectSignature()
    {
        $parameterBag = $this->getParameterBag();

        return ($parameterBag->get(ParameterBag::SIGNATURE) === $this->getAuthentication()->hash($parameterBag));
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        $data = $this->toArray();

        return array_key_exists(self::CODE, $data) ? $data[self::CODE] : "";
    }
}
