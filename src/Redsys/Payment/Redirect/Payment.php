<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Payment\Redirect;

use Redsys\Security\Authentication\AuthenticationInterface;

final class Payment
{
    /**
     * @var AuthenticationInterface
     */
    private $authentication;

    public function __construct(AuthenticationInterface $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @return AuthenticationInterface
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }
}
