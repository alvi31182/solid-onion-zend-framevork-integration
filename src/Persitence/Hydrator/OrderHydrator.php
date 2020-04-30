<?php

namespace App\Persitence\Hydrator;

use App\Domain\Entity\Customer;
use App\Domain\Repository\RepositoryInteface;
use Laminas\Hydrator\HydratorInterface;

class OrderHydrator implements HydratorInterface
{
    private HydratorInterface $wrappeHydrator;
    private RepositoryInteface $customerRepository;

    public function __construct(
        HydratorInterface $hydrator,
        RepositoryInteface $customerRepository
    )
    {
        $this->wrappeHydrator  = $hydrator;
        $this->customerRepository = $customerRepository;
    }

    public function extract(object $object): array
    {
        return $this->wrappeHydrator->extract($object);
    }

    public function hydrate(array $data, $order)
    {
        $customer = null;

        if (isset($data['customer'])) {
            $customer = $this->wrappeHydrator->hydrate(
                $data['customer'],
                new Customer()
            );
            unset($data['customer']);
        }

        if(isset($data['customer_id'])){
            $order->setCustomer(
                $this->customerRepository->getById($data['customer_id'])
            );
        }

        $this->wrappeHydrator->hydrate($data, $order);
        if ($customer) {
            $order->setCustomer($customer);
        }
        return $order;

    }
}