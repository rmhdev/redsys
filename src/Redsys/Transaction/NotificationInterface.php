<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Transaction;

use Redsys\Security\Authentication\AuthenticationInterface;

interface NotificationInterface
{
    /**
     * @return mixed
     */
    public function getResponse();

    /**
     * @return string
     */
    public function getResponseCode();

    /**
     * @return array
     */
    public function toArray();

    /**
     * @return AuthenticationInterface
     */
    public function getAuthentication();

    /**
     * @return ParameterBagInterface
     */
    public function getParameterBag();

    /**
     * @return bool
     */
    public function hasCorrectSignature();
}
