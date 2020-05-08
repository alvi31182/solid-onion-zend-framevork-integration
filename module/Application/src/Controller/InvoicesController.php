<?php

namespace Application\Controller;

use App\Domain\Repository\InvoiceRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Domain\Service\InvoicingService;
use Laminas\Mvc\Controller\AbstractActionController;

class InvoicesController extends AbstractActionController
{
    public InvoiceRepositoryInterface $invoiceRepository;
    public OrderRepositoryInterface $orderRepository;
    public InvoicingService $invocing;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        OrderRepositoryInterface $orderRepository,
        InvoicingService $invocing
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->orderRepository = $orderRepository;
        $this->invocing = $invocing;
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

    public function generateProcessAction()
    {
        $invoices = $this->invocing->generateInvoces();

        $this->invoiceRepository->begin();

        foreach ($invoices as $invoice) {
          //  var_dump($invoice);
            $this->orderRepository->persist($invoice);
        }

        $this->orderRepository->commit();

        return [
            'invoices' => $invoices
        ];
    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');
        $invoice = $this->invoiceRepository->getById($id);

        if (!$invoice) {
            $this->getResponse()->setStatusCode(404);
            return null;
        }

        return [
            'invoice' => $invoice,
            'order' => $invoice->getOrder()
        ];
    }
}