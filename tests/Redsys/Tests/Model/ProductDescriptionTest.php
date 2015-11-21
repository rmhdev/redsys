<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\ProductDescription;

class ProductDescriptionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueShouldReturnValue()
    {
        $description = new ProductDescription("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", $description->getValue());
    }

    public function testToStringShouldReturnString()
    {
        $description = new ProductDescription("Lorem ipsum");

        $this->assertEquals("Lorem ipsum", (string)$description);
    }

    /**
     * @expectedException \LengthException
     */
    public function testTooLongValueShouldThrowException()
    {
        new ProductDescription(str_repeat("abcdefghij", 15) . "z");
    }
}
