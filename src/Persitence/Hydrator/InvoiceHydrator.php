<?php

namespace App\Persitence\Hydrator;

use App\Domain\Entity\Order;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Persitence\Hydrator\Strategy\DateStrategy;
use Laminas\Hydrator\AbstractHydrator;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorInterface;

class InvoiceHydrator implements HydratorInterface
{
    private OrderRepositoryInterface $orderRepository;
    private AbstractHydrator $wrappeHydrator;

    public function __construct (
        AbstractHydrator $hydrator,
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->wrappeHydrator = $hydrator;
        $this->wrappeHydrator->addStrategy(
            'invoice_date',
            new DateStrategy()
        );
        $this->orderRepository = $orderRepository;
    }

    public function extract(object $object): array
    {
        $data = $this->wrappeHydrator->extract($object);

        if(array_key_exists('order', $data) && !empty($data['order'])){
            $data['order_id'] = $data['order']->getId();
            unset($data['order']);
        }
        return $data;
    }

    public function hydrate(array $data, object $object)
    {
        $order = null;

        if(isset($data['order'])){
            $order = $this->wrappeHydrator->hydrate(
                $data['order'],
                new Order()
            );
            unset($data['order']);
        }

        if(isset($data['order_id'])){
            $order = $this->orderRepository->getById($data['order_id']);
        }
        var_dump($object);
        $invoice = $this->wrappeHydrator->hydrate($data, $object);

        if($order){
            $invoice->setOrder($order);
        }

        return $invoice;
    }
}