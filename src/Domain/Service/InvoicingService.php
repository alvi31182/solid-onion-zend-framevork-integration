<?php


namespace App\Domain\Service;

use App\Domain\Factory\InvoiceFactory;
use App\Domain\Repository\OrderRepositoryInterface;

class InvoicingService
{
    protected $orderRepository;
    protected $invoiceFacotory;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        InvoiceFactory $invoiceFactory
    )
    {
        $this->orderRepository = $orderRepository;
        $this->invoiceFacotory = $invoiceFactory;
    }

    public function generateInvoces()
    {
        $orders = $this->orderRepository->getUninvoicedOrders();

        $invoices = [];

        foreach ($orders as $order){
            $invoices[] = $this->invoiceFacotory->createFromOrder($order);
        }

        return$invoices;
    }

}