<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Security\Cryptography;

class Crypt3Des
{
    private $message;

    private $key;

    public function __construct($message, $key)
    {
        $this->message = $message;
        $this->key = $key;
    }

    public function getMessage()
    {
        return $this->message;
    }

    private function getKey()
    {
        return $this->key;
    }

    public function encrypt()
    {
        $iv = str_repeat(chr(0), 8);

        return mcrypt_encrypt(MCRYPT_3DES, $this->getKey(), $this->getMessage(), MCRYPT_MODE_CBC, $iv);
    }
}
