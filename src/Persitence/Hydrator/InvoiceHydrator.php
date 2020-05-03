<?php

namespace App\Persitence\Hydrator;

use App\Domain\Entity\Order;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Persitence\Hydrator\Strategy\DateStrategy;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorInterface;

class InvoiceHydrator implements HydratorInterface
{
    public OrderRepositoryInterface $invoiceRepository;
    public ClassMethodsHydrator $wrappeHydrator;

    public function __construct (
        ClassMethodsHydrator $hydrator,
        OrderRepositoryInterface $invoiceRepository
    )
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->wrappeHydrator = $hydrator;
        $this->wrappeHydrator->addStrategy(
            'invoice_date',
            new DateStrategy()
        );
    }

    public function extract(object $object): array
    {
        $data = $this->wrappeHydrator->extract($object);
        if(array_key_exists('order', $data) && !empty($data['order'])){
            $data['order'] = $data['order_id']->getId();
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
        }

        $invoice = $this->wrappeHydrator->hydrate($data, $object);

        if($order){
            $invoice->setOrder($order);
        }

        return $order;
    }
}