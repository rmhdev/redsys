<?php

namespace Redsys\Tests\Request;

use Redsys\Request\Payment;

class PaymentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testEmptyPaymentShouldThrowException()
    {
        new Payment();
    }
}
