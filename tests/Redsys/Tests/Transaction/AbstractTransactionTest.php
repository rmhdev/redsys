<?php

/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Tests\Transaction;

use Redsys\ParameterBag\ParameterBagInterface;
use Redsys\Security\Authentication\AuthenticationInterface;
use Redsys\Security\Authentication\HmacSha256V1;
use Redsys\Transaction\TransactionInterface;

abstract class AbstractTransactionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAuthenticationShouldReturnObject()
    {
        $parameterBag = $this->createParameterBag();
        $authentication = $this->createAuthentication();
        $transaction = $this->createTransaction($authentication, $parameterBag);

        $this->assertEquals($authentication, $transaction->getAuthentication());
    }

    /**
     * @param AuthenticationInterface $authentication
     * @param ParameterBagInterface $parameterBag
     * @return TransactionInterface
     */
    abstract protected function createTransaction(
        AuthenticationInterface $authentication,
        ParameterBagInterface $parameterBag
    );

    public function testGetParameterBagShouldReturnObject()
    {
        $authentication = $this->createAuthentication();
        $parameterBag = $this->createParameterBag();
        $transaction = $this->createTransaction($authentication, $parameterBag);

        $this->assertEquals($parameterBag, $transaction->getParameterBag());
    }

    protected function createAuthentication()
    {
        return new HmacSha256V1($this->secretKey());
    }

    /**
     * @return ParameterBagInterface
     */
    abstract protected function createParameterBag();

    protected function secretKey()
    {
        return "Mk9m98IfEblmPfrpsawt7BmxObt98Jev";
    }

    public function testToArrayShouldReturnFormattedArray()
    {
        $authentication = $this->createAuthentication();
        $parameterBag = $this->createParameterBag();
        $transaction = $this->createTransaction($authentication, $parameterBag);
        $expected = array(
            "Ds_SignatureVersion" => $authentication->getName(),
            "Ds_MerchantParameters" => $this->expectedTransactionValue($parameterBag),
            "Ds_Signature" => $authentication->hash($parameterBag),
        );

        $this->assertEquals($expected, $transaction->toArray(), get_class($transaction));
    }

    abstract protected function expectedTransactionValue(ParameterBagInterface $parameterBag);
}
