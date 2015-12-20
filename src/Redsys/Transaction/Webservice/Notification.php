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

class Notification
{
    const CODE = "CODIGO";
    const OPERATION = "OPERACION";
    const DEFAULT_AUTHENTICATION = HmacSha256V1::NAME;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $response;

    /**
     * @param string $key
     * @param string $response
     */
    public function __construct($key, $response = "")
    {
        $this->key = $key;
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

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

    public function getAuthentication()
    {
        return AuthenticationFactory::create(self::DEFAULT_AUTHENTICATION, $this->key);
    }

    public function getParameterBag()
    {
        $raw = $this->toArray();
        $parameters = array();
        if (array_key_exists(self::OPERATION, $raw)) {
            $parameters = $raw[self::OPERATION];
        }

        return new ParameterBag($parameters);
    }

    public function hasCorrectSignature()
    {
        $parameterBag = $this->getParameterBag();

        return ($parameterBag->get($parameterBag::SIGNATURE) === $this->getAuthentication()->hash($parameterBag));
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
