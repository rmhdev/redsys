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
    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     * @param string $message
     */
    public function __construct($key, $message)
    {
        $this->key = $key;
        $this->message = $message;
    }

    /**
     * @return string
     */
    private function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function encrypt()
    {
        $iv = str_repeat(chr(0), 8);

        return mcrypt_encrypt(MCRYPT_3DES, $this->getKey(), $this->getMessage(), MCRYPT_MODE_CBC, $iv);
    }
}
