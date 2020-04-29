<?php

namespace Application\Controller;

use App\Domain\Entity\Customer;
use App\Domain\Entity\Order;
use App\Domain\Repository\CustomerRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\InputFilter\InputFilter;
use App\Persitence\Hydrator\OrderHydrator;

class OrdersController extends AbstractActionController
{
    public OrderRepositoryInterface $orderRepository;
    public CustomerRepositoryInterface $customerRepository;
    public InputFilter $inputFilter;
    public OrderHydrator $hydrator;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CustomerRepositoryInterface $customerRepository,
        InputFilter $inputFilter,
        OrderHydrator $hydrator
    )
    {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->inputFilter = $inputFilter;
        $this->hydrator = $hydrator;
    }

    public function indexAction() {
        return [
            'orders' => $this->orderRepository->getAll()
        ];
    }

    public function viewAction() {
        $id = $this->params()->fromPost('id');
        $order = $this->orderRepository->getById($id);

        if(!$order){
            $this->getResponse()->setStatusCode('404');
            return null;
        }

        return [
            'order' => $order
        ];
    }

    public function newAction() {
        $viewModel = new ViewModel();
        $order = new Order();
        $viewModel->setVariable(
            'customers',
            $this->customerRepository->getAll()
        );
        $viewModel->setVariable('order', $order);
        return $viewModel;
    }
}