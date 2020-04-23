<?php
declare(strict_types=1);

namespace Application\Controller;

use App\Domain\Repository\CustomerRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;

class CustomersController extends AbstractActionController
{
    public CustomerRepositoryInterface $customersRepository;

    public function __construct
    (
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customersRepository = $customerRepository;
    }

    public function indexAction()
    {
        return [
            'customers' => $this->customersRepository->getAll()
        ];
    }

    public function newAction()
    {

    }
}