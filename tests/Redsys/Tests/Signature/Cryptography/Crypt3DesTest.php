<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Signature\Cryptography;

use Redsys\Signature\Cryptography\Crypt3Des;

class Crypt3DesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMessageShouldReturnMessage()
    {
        $crypt = new Crypt3Des("lorem ipsum", "qwerty");

        $this->assertEquals("lorem ipsum", $crypt->getMessage());
    }

    public function testEncryptShouldReturnEncryptedMessage()
    {
        $crypt = new Crypt3Des("lorem ipsum", $this->getSecretKey());

        $this->assertEquals($this->expectedEncrypt("lorem ipsum", $this->getSecretKey()), $crypt->encrypt());
    }

    private function expectedEncrypt($message, $key)
    {
        $bytes = array(0,0,0,0,0,0,0,0);
        $iv = implode(array_map("chr", $bytes));

        return mcrypt_encrypt(MCRYPT_3DES, $key, $message, MCRYPT_MODE_CBC, $iv);
    }

    private function getSecretKey()
    {
        return "Mk9m98IfEblmPfrpsawt7Bmx";
    }
}
