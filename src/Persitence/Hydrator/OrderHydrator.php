<?php


namespace App\Persitence\Hydrator;


use App\Domain\Repository\CustomerRepositoryInterface;
use App\Domain\Repository\ReposytoryRead;
use Laminas\Hydrator\HydratorInterface;

class OrderHydrator implements HydratorInterface
{
    private HydratorInterface $wrappeHydrator;
    private ReposytoryRead $customerRepository;

    public function __construct(
        HydratorInterface $hydrator,
        ReposytoryRead $customerRepository
    )
    {
        $this->wrappeHydrator  = $hydrator;
        $this->customerRepository = $customerRepository;
    }

    public function extract(object $object): array
    {
    }

    public function hydrate(array $data, $order)
    {
        $this->wrappeHydrator->hydrate($data, $order);

        if(isset($data['customer_id'])){
            $order->setCustomer(
                $this->customerRepository->getById($data['customer_id'])
            );
        }
        return $this;

    }
}