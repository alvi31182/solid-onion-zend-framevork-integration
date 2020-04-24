<?php


namespace Application\Controller;


use App\Domain\Repository\OrderRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;

class OrdersController extends AbstractActionController
{
    public OrderRepositoryInterface $orderRepository;

    public function __construct
    (
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->orderRepository = $orderRepository;
    }

    public function indexAction()
    {
        return [
            'orders' => $this->orderRepository->getAll()
        ];
    }
}