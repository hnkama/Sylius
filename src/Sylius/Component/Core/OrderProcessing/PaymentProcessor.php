<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Core\OrderProcessing;

use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Payment processor.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class PaymentProcessor implements PaymentProcessorInterface
{
    /**
     * Payment repository.
     *
     * @var RepositoryInterface
     */
    protected $paymentRepository;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $paymentRepository
     */
    public function __construct(RepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function createPayment(OrderInterface $order)
    {
        /** @var $payment PaymentInterface */
        $payment = $this->paymentRepository->createNew();
        $payment->setCurrency($order->getCurrency());
        $payment->setAmount($order->getTotal());

        $order->addPayment($payment);

        return $payment;
    }
}
