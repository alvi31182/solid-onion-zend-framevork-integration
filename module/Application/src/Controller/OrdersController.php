<?php

namespace Application\Controller;

use App\Domain\Entity\Order;
use App\Domain\Repository\CustomerRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
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
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->inputFilter = $inputFilter;
        $this->hydrator = $hydrator;
    }

    public function indexAction()
    {
        return [
            'orders' => $this->orderRepository->getAll()
        ];
    }

    public function viewAction()
    {

        $id = $this->params()->fromPost('id');
        $order = $this->orderRepository->getById($id);

        if (!$order) {
            $this->getResponse()->setStatusCode('404');
            return null;
        }

        return [
            'order' => $order
        ];
    }

    public function newAction()
    {
        $viewModel = new ViewModel();
        $order = new Order();

        if ($this->getRequest()->isPost()) {
            $this->inputFilter->setData($this->params()->fromPost());
            if ($this->inputFilter->isValid()) {
                $this->hydrator->hydrate(
                    $this->inputFilter->getValues(),
                    $order
                );

                $this->orderRepository->begin()
                    ->persist($order)
                    ->commit();

                $this->redirect()->toUrl('/orders/view/' . $order->getId());
            } else {
                $this->hydrator->hydrate(
                    $this->params()->fromPost(),
                    $order
                );
                $viewModel->setVariable('errors', $this->inputFilter->getMessages());
            }
        }

        $viewModel->setVariable(
            'customers',
            $this->customerRepository->getAll()
        );
        $viewModel->setVariable('order', $order);
        return $viewModel;
    }


}