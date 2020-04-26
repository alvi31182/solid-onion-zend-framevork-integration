<?php


namespace App\Persitence\Hydrator;


use App\Domain\Repository\CustomerRepositoryInterface;
use Laminas\Hydrator\HydratorInterface;

class OrderHydrator implements HydratorInterface
{
    private HydratorInterface $wrappeHydrator;
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(
        HydratorInterface $hydrator,
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->wrappeHydrator  = $hydrator;
        $this->customerRepository = $customerRepository;
    }

    public function extract(object $object): array
    {
        return $this->wrappeHydrator->extract($object);
    }

    public function hydrate(array $data, object $object)
    {

    }
}