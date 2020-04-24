<?php
declare(strict_types=1);

namespace Application\Controller;

use App\Domain\Entity\Customer;
use App\Domain\Repository\CustomerRepositoryInterface;
use App\Domain\Service\InputFilter\CustomerInputFilter;
use Laminas\Hydrator\HydratorInterface;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\View\Model\ViewModel;

class CustomersController extends AbstractActionController
{
    public CustomerRepositoryInterface $customersRepository;
    public CustomerInputFilter $inputFilter;
    public HydratorInterface $hydrator;

    public function __construct
    (
        CustomerRepositoryInterface $customerRepository,
        CustomerInputFilter $inputFilter,
        HydratorInterface $hydrator
    )
    {
        $this->customersRepository = $customerRepository;
        $this->inputFilter = $inputFilter;
        $this->hydrator = $hydrator;
    }

    public function indexAction()
    {
        return [
            'customers' => $this->customersRepository->getAll()
        ];
    }

    public function newOrEditAction()
    {
        $viewModel = new ViewModel();
        $id = $this->params()->fromRoute('id');
        $customer = $id ? $this->customersRepository->getById($id) : new Customer();

        if($this->getRequest()->isPost()){
            $this->inputFilter->setData($this->params()->fromPost());

            if($this->inputFilter->isValid()){
                $customer = $this->hydrator->hydrate(
                    $this->inputFilter->getValues(),
                    $customer
                );
                $this->customersRepository->begin()
                    ->persist($customer)
                    ->commit();
                $flash = new FlashMessenger();
                $flash->addSuccessMessage('Customer saved!');
            }else{
                $this->hydrator->hydrate(
                    $this->params()->fromPost(),
                    $customer
                );
                $viewModel->setVariable('errors', $this->inputFilter->getMessages());
            }
        }
        $viewModel->setVariable('customer', $customer);
        return $viewModel;
    }


}