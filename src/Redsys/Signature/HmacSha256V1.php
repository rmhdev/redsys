<?php
/**
 * This file is part of the redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Signature;

class HmacSha256V1
{
    const NAME = "HMAC_SHA256_V1";

    private $secret;

    public function __construct($secret = "")
    {
        $this->secret = $secret;
    }

    public function getName()
    {
        return self::NAME;
    }

    public function parseParameters($parameters = array())
    {
        return base64_encode(json_encode($parameters));
    }
}
