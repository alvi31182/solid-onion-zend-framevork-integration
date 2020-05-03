<?php

namespace Application\Controller;

use App\Domain\Repository\InvoiceRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;

class InvoicesController extends AbstractActionController
{
    public InvoiceRepositoryInterface $invoiceRepository;
    public OrderRepositoryInterface $orderRepository;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->orderRepository = $orderRepository;
    }

    public function indexAction()
    {
        $invoice = $this->invoiceRepository->getAll();

        return [
            'invoices' => $invoice
        ];
    }

    public function generateAction()
    {
        return [
            'orders' => $this->orderRepository->getUninvoicedOrders()
        ];
    }
}