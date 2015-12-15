<?php
/**
 * This file is part of the redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Security\Authentication;

use Redsys\ParameterBag\ParameterBagInterface;
use Redsys\Security\Cryptography\Crypt3Des;

class HmacSha256V1 implements AuthenticationInterface
{
    const NAME = "HMAC_SHA256_V1";

    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     */
    public function __construct($key = "")
    {
        $this->key = $key;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @inheritdoc
     */
    public function encode($parameters = array())
    {
        return base64_encode(json_encode($parameters));
    }

    /**
     * @inheritdoc
     */
    public function decode($text)
    {
        return json_decode(base64_decode($text), true);
    }

    /**
     * @inheritdoc
     */
    public function hash(ParameterBagInterface $parameterBag)
    {
        $ent = $this->encode($parameterBag->all());
        $crypt = new Crypt3Des(base64_decode($this->key), $parameterBag->getOrder());
        $res = hash_hmac('sha256', $ent, $crypt->encrypt(), true);

        return base64_encode($res);
    }
}
