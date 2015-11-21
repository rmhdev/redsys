<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Model;

use Redsys\Model\MerchantCode;

class MerchantCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCodeShouldReturnStringValue()
    {
        $code = "qwertyuio";
        $merchantCode = new MerchantCode($code);

        $this->assertEquals($code, $merchantCode->getCode());
    }

    public function testToStringShouldReturnStringValue()
    {
        $code = "qwertyuio";
        $merchantCode = new MerchantCode($code);

        $this->assertEquals($code, (string)$merchantCode);
    }
}
