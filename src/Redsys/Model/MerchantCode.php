<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

final class MerchantCode
{
    const MAX_LENGTH = 9;

    /**
     * @var string
     */
    private $code;

    public function __construct($code)
    {
        $code = str_replace(" ", "", trim($code));
        if (self::MAX_LENGTH < strlen($code)) {
            throw new \LengthException(
                sprintf('Max merchant code length is %d, but "%s" code is %d', self::MAX_LENGTH, $code, strlen($code))
            );
        }
        $this->code = (string)$code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCode();
    }
}
