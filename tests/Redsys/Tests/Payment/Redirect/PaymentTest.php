<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment\Redirect;

use Redsys\Payment\Redirect\Payment;
use Redsys\Security\Authentication\HmacSha256V1;

class PaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAuthenticationShouldReturnObject()
    {
        $authentication = new HmacSha256V1($this->secretKey());
        $request = new Payment($authentication);

        $this->assertEquals($authentication, $request->getAuthentication());
    }

    protected function secretKey()
    {
        return "Mk9m98IfEblmPfrpsawt7BmxObt98Jev";
    }
}
