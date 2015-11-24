<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment;

use Redsys\Payment\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayEmptyRequestShouldReturnEmptyArray()
    {
        $request = new Response();

        $this->assertEquals(array(), $request->toArray());
    }
}
