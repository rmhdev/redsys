<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\TransactionType;

class TransactionTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $transactionType = new TransactionType("0");

        $this->assertEquals("0", $transactionType->getValue());
    }

    public function testToStringShouldReturnStringValue()
    {
        $transactionType = new TransactionType(2);

        $this->assertEquals("2", (string)$transactionType);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new TransactionType("ab");
    }
}
