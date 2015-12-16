<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Security\authentication;

use Redsys\Security\Authentication\AuthenticationFactory;
use Redsys\Security\Authentication\HmacSha256V1;

class AuthenticationFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateHmacSha256V1ShouldReturnAuthentication()
    {
        $key = "Mk9m98IfEblmPfrpsawt7BmxObt98Jev";
        $expected = new HmacSha256V1($key);

        $this->assertEquals($expected, AuthenticationFactory::create("HMAC_SHA256_V1", $key));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testCreateUndefinedAuthenticationShouldThrowException()
    {
        AuthenticationFactory::create("Lorem_Ipsum", "my_key");
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testCreateAuthenticationFactoryShouldThrowException()
    {
        AuthenticationFactory::create("Authentication_Factory", "my_key");
    }
}
