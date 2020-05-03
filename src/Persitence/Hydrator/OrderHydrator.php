<?php

namespace App\Persitence\Hydrator;

use App\Domain\Entity\Customer;
use App\Domain\Repository\CustomerRepositoryInterface;
use Laminas\Hydrator\HydratorInterface;

class OrderHydrator implements HydratorInterface
{
    private HydratorInterface $wrappeHydrator;
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(
        HydratorInterface $hydrator,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->wrappeHydrator = $hydrator;
        $this->customerRepository = $customerRepository;
    }

    public function extract(object $object): array
    {
        $data = $this->wrappeHydrator->extract($object);

        if(array_key_exists('customer', $data) && !empty($data['customer'])){
            $data['customer_id'] = $data['customer']->getId();
            unset($data['customer']);
        }
        return $data;
    }

    public function hydrate(array $data, object $order)
    {
        $customer = null;

        if (isset($data['customer'])) {
            $customer = $this->wrappeHydrator->hydrate(
                $data['customer'],
                new Customer()
            );
            unset($data['customer']);
        }

        if (isset($data['customer_id'])) {
            $order->setCustomer(
               $customer = $this->customerRepository->getById($data['customer_id'])
            );
        }

        $this->wrappeHydrator->hydrate($data, $order);

        if ($customer) {
            $order->setCustomer($customer);
        }

        return $order;
    }
}