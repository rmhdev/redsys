<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Security\Authentication;

class AuthenticationFactory
{
    /**
     * @param string $name
     * @param string $key
     * @return AuthenticationInterface
     */
    public static function create($name, $key)
    {
        $className = str_replace(" ", "", mb_convert_case(str_replace("_", " ", $name), MB_CASE_TITLE));
        if ("AuthenticationFactory" === $className) {
            throw new \UnexpectedValueException('AuthenticationFactory is not a valid Authentication Class');
        }
        $fullClassName = sprintf('%s\%s', __NAMESPACE__, $className);
        if (!class_exists($fullClassName)) {
            throw new \UnexpectedValueException(
                sprintf('Class "%s" does not exist for given name "%s"', $fullClassName, $name)
            );
        }

        return new $fullClassName($key);
    }
}
