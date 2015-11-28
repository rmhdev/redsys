<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Api;

final class AuthorisationCode implements ApiInterface
{
    const MAX_LENGTH = 6;

    /**
     * @var string
     */
    private $code;

    public function __construct($code)
    {
        $length = strlen($code);
        if (self::MAX_LENGTH < $length) {
            throw new \LengthException(
                sprintf('Authorisation code length (%d) exceeds max (%d)', $length, self::MAX_LENGTH)
            );
        }
        $this->code = (string)$code;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
