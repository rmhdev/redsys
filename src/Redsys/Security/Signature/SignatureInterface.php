<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Security\Signature;

interface SignatureInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param array $parameters
     * @return string
     */
    public function encode($parameters = array());

    /**
     * @param string $text
     * @return array
     */
    public function decode($text);

    /**
     * @param string $text
     * @return string
     */
    public function hash($text);
}
