<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Payment\Redirect;

use Redsys\Payment\Redirect\Notification;

class NotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayOnEmptyNotificationShouldReturnEmptyArray()
    {
        $notification = new Notification();

        $this->assertEquals(array(), $notification->toArray());
    }

    public function testToArrayShouldReturnGivenArray()
    {
        $parameters = array(
            "Lorem_Ipsum" => "test",
            "Custom_Value" => "1234"
        );
        $notification = new Notification($parameters);

        $this->assertEquals($parameters, $notification->toArray());
    }

    public function testToArrayWithStringShouldReturnGivenArray()
    {
        $notification = new Notification("test");

        $this->assertEquals(array("test"), $notification->toArray());
    }
}
