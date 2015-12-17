<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Security\Authentication;

use Redsys\ParameterBag\ParameterBagInterface;

interface AuthenticationInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param ParameterBagInterface $parameterBag
     * @return string
     */
    public function hash(ParameterBagInterface $parameterBag);
}
